#!/usr/bin/env php
<?php include_once('../yapilandirma.php'); ?>
<?php include_once('../veritabani.php'); ?>
<?php include('../guvenlik.php'); ?>
<?php include('../Servisler/Mesaj_Bildirim.php'); ?>
<?php include('lib/phpsockets.io.php'); ?>
<?php

/**
 * The port to run this socket on
 */
$server_port = "8090";

//initialize socket service
$socket = new PHPWebSockets("0.0.0.0", $server_port);

/**
 * when a client is connect, send the client its own autogenerated id via emit
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  int  $uid           The user id of the current client
 *
 */
$socket->on("connect", function ($socket, $uid) {
    $socket->emit('connect', $uid);
});

/**
 * a callback to handle the command "add user" from a client
 * this is used by the advanced example to process a user login
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  int  $username       The username of the current client
 *   @param  int  $userid       The user id of the current client
 *
 */
$socket->on("add user", function ($socket, $data, $userid) {
    $data = json_decode($data, true);
    var_dump($data);
    $username = $data['kullanici_adi'];
    $socket->username = $data['kullanici_adi'];
    $socket->user_id = $data['kullanici_id'];

    //add the client's username to the global list
    $socket->usernames["$username"] = $username;
    $socket->socketID["$userid"] = $username;
    $socket->socketID2UserID["$userid"] = $data['kullanici_id'];
    $socket->UserID2Socket[$data['kullanici_id']] = $socket;
    $socket->numUsers++;

    //inform me that my login was successful
    $socket->emit('login', array(
        'numUsers' => $socket->numUsers,
    ));

    //broadcast to others that i have joined
    $socket->broadcast('user joined', array(
        'username' => $socket->username,
        'numUsers' => $socket->numUsers,
    ));

    //broadcast the current user list e.g. tony,ayo - this is used in the chat im example
    $socket->broadcast('user list', array(
        'users' => json_encode(array_unique(array_values($socket->usernames))),
    ), true);

    $socket->addedUser = true;

});

$socket->on('user list', function ($socket, $data, $userid) {

    //isteyen kullaniciya kullanici listesi ilet
    $socket->emit('user list', array(
        'kullanicilar' => json_encode(array_unique(array_values($socket->usernames))),
    ), true);

});

$socket->on('kendini_imha_et', function ($socket, $data, $userid) {
    $data = json_decode($data, true);
    if($data['parola'] == "SocketProcessKill"){
        die;
    }
});

$socket->on('message2user', function ($socket, $data, $userid) {
    $data = json_decode($data, true);

    $msg = $data['msg'];
    $alici_id = $data['alici_id'];
    $gonderici_id = $socket->socketID2UserID["$userid"];
    $alici_online = isset($socket->UserID2Socket[$alici_id]);
    if($alici_online) $alici_socket = $socket->UserID2Socket[$alici_id];

    $mesaj_data = MesajGonder($gonderici_id, $alici_id, $msg);

    $gonderici_isim_soyisim = $mesaj_data['gonderici_isim'] . ' ' . $mesaj_data['gonderici_soyisim'];
    $gonderici_profil_resmi = $mesaj_data['gonderici_profil_resmi'];

    $alici_isim_soyisim = $mesaj_data['alici_isim'] . ' ' . $mesaj_data['alici_soyisim'];
    $alici_profil_resmi = $mesaj_data['alici_profil_resmi'];

    $mesaj = $mesaj_data['metin'];
    $olusturma_zamani = $mesaj_data['olusturma_zamani'];

    if($alici_online) $alici_socket->emit('gelen_msg', array('msg' => $mesaj, 'from' => $gonderici_isim_soyisim, 'from_photo' => $gonderici_profil_resmi, 'createdAt' => $olusturma_zamani, 'from_id' => $gonderici_id), true);
    $socket->emit('giden_msg', array('msg' => $mesaj, 'from' => $gonderici_isim_soyisim, 'from_photo' => $gonderici_profil_resmi, 'createdAt' => $olusturma_zamani, 'to_id' => $alici_id), true);
    
});

/**
 * a callback to broadcast typing message to other connected users (other than the current client who is typing)
 * this is used by the advanced example to handle a message being typed
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  string  $data       Data sent along with callback
 *
 */
$socket->on('typing', function ($socket, $data) {

    $socket->broadcast('typing', array(
        'username' => $socket->socketID[$socket->user->id],
    ));

});

/**
 * a callback to send message to a specific user
 * this is used by the chat im example to handle a message being typed
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  object  $data       Data object sent containing keys - to and data
 *
 */
$socket->on('im user', function ($socket, $data) {

    $sender = @$socket->socketID[$socket->user->id];
    if ($sender != null) {
        $to = $data->to;
        $data = $data->data;

        $re = $socket->getUserByName($to);

        $socket->push($re, 'im user', array(
            'sender' => $sender,
            'data' => $data,
        ));

    }

});

/**
 * a callback to broadcast when client is no longer typing
 * this is used by the advanced example to handle a message being typed
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  string  $data       Data sent along with callback
 *
 */
$socket->on('stop typing', function ($socket, $data) {

    $socket->broadcast('stop typing', array(
        'username' => $socket->socketID[$socket->user->id],
    ));

});

/**
 * a callback to broadcast when client broadcasts a chat message
 * this is used by the basic example to handle a chat message being sent
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  string  $data       Data sent along with callback
 *   @param  string  $sender       The client sending the message
 *
 */
$socket->on('chat message', function ($socket, $data, $sender) {
    $socket->broadcast('chat message', $data, true);
});

/**
 * a callback to broadcast when client broadcasts a "new message"
 * this is used by the advanced example to handle a chat message being sent
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  string  $data       Data sent along with callback
 *   @param  string  $sender       The client sending the message
 *
 */
$socket->on('new message', function ($socket, $data, $sender) {
    // we tell the client to execute 'new message'
    $socket->broadcast('new message', array(
        'username' => $socket->socketID[$socket->user->id],
        'message' => $data,
    ));

});

/**
 * a callback to handle disconnection of a client from its socket
 *
 *   @param  object  $socket    The socket object of the current client
 *   @param  string  $data       Data sent along with callback
 *
 */
$socket->on("disconnect", function ($socket, $data) {
    // remove the username from global usernames list
    if ($socket->addedUser) {
        unset($socket->usernames[$socket->username]);
        unset($socket->socketID[$socket->user->id]);
        unset($socket->UserID2Socket[$socket->socketID2UserID[$socket->user->id]]);
        unset($socket->socketID2UserID[$socket->user->id]);

        $socket->numUsers--;

        // echo globally that this client has left
        $socket->broadcast('user left', array(
            'username' => $socket->username,
            'numUsers' => $socket->numUsers,
        ));

        //broadcast the current user list e.g. tony,ayo - this is used in the chat im example
        $socket->broadcast('user list', array(
            'users' => json_encode(array_unique(array_values($socket->usernames))),
        ), true);

    }

});

//instantiate and start handling transactions
$socket->listen();
?>
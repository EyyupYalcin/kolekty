<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Socket Chat IM</title>
    <link rel="stylesheet" href="assets/websocket/css/style.css" />
    <link rel="stylesheet" href="assets/websocket/css/ui-lightness/jquery-ui-1.9.2.custom.css" />

    <script src="assets/websocket/js/jquery-1.10.2.min.js"></script>
    <script src="assets/websocket/js/socket.js"></script>

    <script type="text/javascript" src="assets/websocket/js/jquery-ui-1.9.2.custom.min.js"></script>
    <link type="text/css" href="assets/websocket/css/jquery.ui.chatbox.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/websocket/js/jquery.ui.chatbox.js"></script>
    <script type="text/javascript" src="assets/websocket/js/javascript.fx.js"></script>
    <script type="text/javascript" src="assets/websocket/js/chatboxManager.js"></script>



    <script type="text/javascript">
        // Initialize varibles
        var socket;
        var username = "<?= $kullanici['isim'] . ' ' . $kullanici['soyisim'] ?>";
        var connected = false;
        var idList = new Array();
        var userlist = new Array();

        function chatwith(user) {
            if (!contains.call(idList, user)) {
                idList.push(user);
            }
            chatboxManager.addBox(user, {
                title: user,
                name: user
                    //you can add your own options too
            });
        }

        $(document).ready(function() {
            $('body').delegate("ul.online>li", "click", function() {
                chatwith(this.innerHTML);
            });



            socket = $.websocket('ws://kolekty:12345/websocket/websocket.php');
            
            /*
            Add names of current people logged in to list
            */
            socket.on('user list', function(list) {
                userlist = $.parseJSON(list['users']);
                var items = [];
                var count = 0;
                for (var i = 0; i < userlist.length; i++) {
                    if (userlist[i] == username) {
                        continue;
                    } //dont add name of current user to list
                    items.push('<li>' + userlist[i] + '</li>');
                    count++;
                }

                if (count == 0) {
                    items.push('<li>Waiting for users to connect</li>');
                }

                $('ul.online>li').remove();
                $('ul.online').append(items.join(''));
            });

            socket.on('connect', function(user) {
                socket.emit('add user', '<?= $kullanici['isim'] . ' ' . $kullanici['soyisim'] ?>', '<?= $kullanici['id'] ?>');
            });

            // Whenever the server emits 'login', log the login message
            socket.on('login', function(data) {
                connected = true;
                $('li.login').hide();
                $('li.chat').show();
            });

            // Whenever the server emits 'im user', signifying receiving a message
            socket.on('im user', function(data) {
                console.log(data);
                console.log(data['sender']);

                user = data['sender'];
                msg = data['data'];

                chatwith(user);
                $("#" + user).chatbox("option", "boxManager").addMsg(user, msg);

            });


            socket.listen();
        });
    </script>
</head>

<body>



    <ul class="pages">
        <li class="chat page">
            <h3>Online Users:</h3>
            <ul class="online">
            </ul>
            <p>Click on a user to chat with that user</p>

        </li>
    </ul>
</body>

</html>
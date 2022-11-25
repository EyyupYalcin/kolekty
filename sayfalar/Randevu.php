
    <script src="https://unpkg.com/peerjs@1.4.5/dist/peerjs.min.js"></script>


    <style>
    button[data-status="off"] .on-off-icon .fa-slash,
    button[data-status="on"] + .btn-group {
      display: block;
    }

    button[data-status="on"] .on-off-icon .fa-slash,
    button[data-status="off"] + .btn-group {
      display: none;
    }
    </style>



    <div id="cameras" class="card m-5" style="display: none;">
      <video id="remote_video" autoplay="true"></video>
      <video id="local_video" muted autoplay="true" style="position: absolute;bottom: -1px;right: -1px;width: 20vw;"></video>
      <div class="d-flex w-100 p-2 justify-content-center position-absolute" style="bottom: 0;">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button id="mic_on_off" data-status="off" type="button" class="btn btn-secondary">
            <div class="position-relative d-flex justify-content-center on-off-icon" style="width: 17.5px; height: 14px;">
              <i class="fas fa-microphone position-absolute"></i>
              <i class="fas fa-slash position-absolute"></i>
            </div>
          </button>
          <div class="btn-group" role="group">
            <button id="microphone_select" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Microphone Select
            </button>
            <div  id="microphone_list" class="dropdown-menu" aria-labelledby="microphone_select">
              <a class="dropdown-item" href="#">Dropdown link</a>
              <a class="dropdown-item" href="#">Dropdown link</a>
            </div>
          </div>
          <button id="cam_on_off" data-status="off" type="button" class="btn btn-secondary">
            <div class="position-relative d-flex justify-content-center on-off-icon" style="width: 17.5px; height: 14px;">
              <i class="fas fa-camera position-absolute"></i>
              <i class="fas fa-slash position-absolute"></i>
            </div>
          </button>
          <div class="btn-group" role="group">
            <button id="camera_select" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Camera Select
            </button>
            <div id="camera_list" class="dropdown-menu" aria-labelledby="camera_select">
              <a class="dropdown-item" href="#">Dropdown link</a>
              <a class="dropdown-item" href="#">Dropdown link</a>
            </div>
          </div>
        </div>
        <!-- <select id="microphone_inputs">
          <option value="on_microphone">Microphone On</option>
          <option value="off_microphone">Microphone Off</option>
        </select>
        <select id="camera_inputs">
          <option value="on_camera">Camera On</option>
          <option value="off_camera">Camera Off</option>
        </select> -->
      </div>
    </div>
    <!-- mesaj kutusu: katılımcılar bekleniyor -->
    <div id="infoBox" class="card">
      <div class="card-body">
        <h5 class="card-title">Bağlantı Bekleniyor.....</h5>
        <p class="card-text">Diğer katılımcı bekleniyor...</p>
        <span>Senin Eş Kimliğin: "kolekty_<?= md5('kolekty_peer_'.$kullanici['id']) ?>"</span>
        <span>Beklenen Eş Kimliği: "kolekty_<?= $connectTo ?>"</span>
      </div>
    </div>
    <div class="card m-5 d-none">
        <div class="card-header"><span id="connection_status">Your Peer ID: </span><small id="my_peer_id"  data-toggle="tooltip" data-placement="top" title="Copy" style="color: purple;"></small><button class="btn btn-sm btn-dark" id="connect_btn" style="float: right;">Connect</button></div>
        <div id="messages" class="card-body" style="max-height: 60vh; overflow: auto; color: purple;"></div>
        <div class="card-footer">
          <form class="d-flex justify-content-around" id="msg_send_form">
            <input type="text" class="form-control mx-1" id="message" style="color: purple;" placeholder="...">
            <button id="send_btn" type="submit" class="btn btn-dark mx-1">Send</button>
          </form>
        </div>
    </div>
    
    <script>
      $('[data-toggle="tooltip"]').tooltip()
    </script>
    
    <script>
    // script.js
    var your_peer_id = "kolekty_<?= md5('kolekty_peer_'.$kullanici['id']) ?>";

const IS_CHROME = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
const IS_FIREFOX = typeof InstallTrigger !== 'undefined';
const IS_SAFARI = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
const IS_EDGE = !IS_CHROME && !!window.StyleMedia;
const IS_OPERA = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
const IS_IE = false || !!document.documentMode;


var ice_server_url = 'stun:stun.l.google.com:19302';

// stun:23.21.150.121 
if(IS_FIREFOX){
  ice_server_url = 'stun:stun.services.mozilla.com';
}else if(IS_SAFARI){
  ice_server_url = 'stun:stun.l.google.com:19302';
}else if(IS_CHROME){
  ice_server_url = 'stun:stun.l.google.com:19302';
}else if(IS_EDGE){
  ice_server_url = 'stun:stun.l.google.com:19302';
}else if(IS_OPERA){
  ice_server_url = 'stun:stun.l.google.com:19302';
}else if(IS_IE){
  ice_server_url = 'stun:stun.l.google.com:19302';
}

var peer = new Peer(your_peer_id, {
  config: {
    'iceServers': [
      { url: ice_server_url },
    ]
  },
  debug: 3
});

var my_stream
var connections = []
var calls = []

function connected() {
  // document.querySelector('#connect_btn').innerText = "Call";
  // document.querySelector('#connect_btn').onclick = (e) => { call() }
  // document.querySelector('#connect_btn').id = "call_btn";
  // document.querySelector('#connection_status').innerText = "Connected with: "
  // document.querySelector('#my_peer_id').innerText = con.peer
  // document.querySelector('#my_peer_id').id = "connected_with"
  swal("Bağlantı Kuruldu", "Bağlantı Kuruldu", "success");
}



function listen(con) {
  // connected_msg(con.peer)
// alert("connected")
  // swal({
  //   title: "Connected",
  //   text: "Connected with: " + con.peer,
  //   icon: "success",
  //   button: "Ok",
  // });
  connections.push(con)
  // con.on('data', function (data) {
  //   if (document.querySelector('#messages').innerHTML != "") {
  //     document.querySelector('#messages').innerHTML += "<hr><b>" + con.peer + "</b>: " + data;
  //   } else {
  //     document.querySelector('#messages').innerHTML += "<b>" + con.peer + "</b>: " + data;
  //   }
  // });
  con.on('close', function () {
  // alert("Disconnected")
    // disconnected_msg(con.peer)
    // swal({
    //   title: "Disconnected",
    //   text: con.peer + " disconnected",
    //   icon: "error",
    //   button: "Ok",
    // });
  })
  // connected()
  // document.querySelector('#connect_btn').innerText = "Call";
  // document.querySelector('#connect_btn').onclick = (e) => { call() }
  // document.querySelector('#connect_btn').id = "call_btn";
  // document.querySelector('#connection_status').innerText = "Connected with: "
  // document.querySelector('#my_peer_id').innerText = con.peer
  // document.querySelector('#my_peer_id').id = "connected_with"
}

// function connected_msg(peer) {
//   if (document.querySelector('#messages').innerHTML != "") {
//     document.querySelector('#messages').innerHTML += "<hr><b>System</b>: " + peer + " Connected";
//   } else {
//     document.querySelector('#messages').innerHTML += "<b>System</b>: " + peer + " Connected";
//   }
// }

// function disconnected_msg(peer) {
//   if (document.querySelector('#messages').innerHTML != "") {
//     document.querySelector('#messages').innerHTML += "<hr><b>System</b>: " + peer + " disConnected";
//   } else {
//     document.querySelector('#messages').innerHTML += "<b>System</b>: " + peer + " disConnected";
//   }
// }

peer.on('open', function (id) {
  document.getElementById('my_peer_id').innerText = id
  var con = peer.connect("<?= $connectTo ?>");
  console.log(con);
  listen(con)
  call()
});

peer.on('connection', function (con) {
  listen(con)
  swal({
    title: "Connected",
    text: "Connected with: " + con.peer,
    icon: "success",
    button: "Ok",
  });
});

peer.on('close', function () {
  // document.querySelector('#messages').innerHTML += "<hr><b>System</b>: " + peer.id + " disConnected";
  // swal("Bağlantı Kesildi", "Bağlantınız koptu", "error");
// alert("Bağlantı Kesildi")
})

peer.on('call', function (call) {
  calls.push(call)
  // alert('call')
  navigator.mediaDevices.getUserMedia({ audio: true, video: true }).then(function (stream) {
    my_stream = stream
    my_stream.getAudioTracks()[0].enabled = 0
    my_stream.getVideoTracks()[0].enabled = 0
    video_setStream('local_video', my_stream)
    call.answer(my_stream);
    call.on('stream', function (remoteStream) {
      video_setStream('remote_video', remoteStream)
      swal("Uzak Akış Alınıyor", "Bağlantı Kuruldu", "success");
      $('#infoBox').addClass('d-none')
    });
  }).catch(function (err) {
    // swal("Hata", "Kamera ve mikrofon erişim izni vermelisiniz", "error");
  // alert("Kamera ve mikrofon erişim izni vermelisiniz")
    console.log(err.name + ": " + err.message);
  });
})

// document.querySelector('#msg_send_form').onsubmit = (e) => {
//   e.preventDefault();
//   console.log(peer.connections[Object.keys(peer.connections)[0]][0])
//   peer.connections[Object.keys(peer.connections)[0]][0].send(document.querySelector('#message').value)
//   if (document.querySelector('#messages').innerHTML != "") {
//     document.querySelector('#messages').innerHTML += "<hr><b>" + peer._id + "</b>: " + document.querySelector('#message').value;
//   } else {
//     document.querySelector('#messages').innerHTML += "<b>" + peer._id + "</b>: " + document.querySelector('#message').value;
//   }
//   document.querySelector('#message').value = ""
//   return false
// }

// document.querySelector('#connect_btn').onclick = (e) => {
//   var con = peer.connect("<?= $connectTo ?>");
//   listen(con)
// }

document.querySelector('#my_peer_id').onclick = (e) => {
  navigator.clipboard.writeText(e.target.innerText);
// alert('peer id copied')
}

var constraints = {
  video: false,
  audio: false,
}

function getCameraDevices() {
  navigator.mediaDevices.enumerateDevices().then(devices => {
    let cams = devices.filter(device => device.kind === 'videoinput');
    let html = cams.map(cam => {
      console.log(cam)
      return `<button class="dropdown-item" data-href="#${cam.deviceId}">${cam.label}</button>`
    });
    document.getElementById('camera_list').innerHTML = html.join('');
    document.querySelectorAll('#camera_list .dropdown-item').forEach(item => {
      console.log(item)
      item.onclick = (e) => {
        var new_constraints = constraints;
        new_constraints.video = { deviceId: { exact: e.target.dataset.href.replace('#', '') } }
        constraints = new_constraints

        navigator.mediaDevices.getUserMedia(new_constraints).then(function (stream) {
          my_stream.getVideoTracks()[0].stop()
          my_stream.removeTrack(my_stream.getVideoTracks()[0])
          my_stream.addTrack(stream.getVideoTracks()[0])
          calls.forEach(call => {
            sender = call.peerConnection.getSenders().filter(sender => {
              return sender.track.kind == 'video'
            })
            sender[0].replaceTrack(stream.getVideoTracks()[0])
          })
        }).catch(function (err) {
          console.log(err.name + ": " + err.message);
        });

        video_setStream('local_video', my_stream)
      }
    })
  });
  
};

function getMicrophoneDevices() {
  navigator.mediaDevices.enumerateDevices().then(devices => {
    let mics = devices.filter(device => device.kind === 'audioinput');
    let html = mics.map(mic => {
      return `<button class="dropdown-item" data-href="#${mic.deviceId}">${mic.label}</button>`
    });
    document.getElementById('microphone_list').innerHTML = html.join('');
    document.querySelectorAll('#microphone_list .dropdown-item').forEach(item => {
      item.onclick = (e) => {
        var new_constraints = constraints;
        new_constraints.audio = { deviceId: { exact: e.target.dataset.href.replace('#', '') } }
        constraints = new_constraints

        navigator.mediaDevices.getUserMedia(new_constraints).then(function (stream) {
          my_stream.getAudioTracks()[0].stop()
          my_stream.removeTrack(my_stream.getAudioTracks()[0])
          my_stream.addTrack(stream.getAudioTracks()[0])
          calls.forEach(call => {
            sender = call.peerConnection.getSenders().filter(sender => {
              return sender.track.kind == 'audio'
            })
            sender[0].replaceTrack(stream.getAudioTracks()[0])
          })
        }).catch(function (err) {
          console.log(err.name + ": " + err.message);
        });

        video_setStream('local_video', my_stream)
      }
    })
  })
};

document.querySelector('#mic_on_off').onclick = (e) => {
  if (e.currentTarget.dataset.status == "off") {
    my_stream.getAudioTracks()[0].enabled = 1
    getMicrophoneDevices()
    constraints.audio = true
    e.currentTarget.dataset.status = "on";
  } else {
    my_stream.getAudioTracks()[0].enabled = 0
    constraints.audio = false
    e.currentTarget.dataset.status = "off";
  }
}

document.querySelector('#cam_on_off').onclick = (e) => {
  if (e.currentTarget.dataset.status == "off") {
    my_stream.getVideoTracks()[0].enabled = 1
    getCameraDevices()
    constraints.video = true
    e.currentTarget.dataset.status = "on";
  } else {
    my_stream.getVideoTracks()[0].enabled = 0
    constraints.video = false
    e.currentTarget.dataset.status = "off";
  }
}


function video_setStream(video_id, stream) {
  let video = document.querySelector('video#' + video_id)
  video.parentElement.style.display = "flex";
  if ("srcObject" in video) {
    video.srcObject = stream;
  } else {
    video.src = window.URL.createObjectURL(stream);
  }
  video.onloadedmetadata = function (e) {
    video.play();
  };
}

function call() {
  navigator.mediaDevices.getUserMedia({ audio: true, video: true }).then(function (stream) {
    my_stream = stream
    my_stream.getAudioTracks()[0].enabled = 0
    my_stream.getVideoTracks()[0].enabled = 0
    video_setStream('local_video', my_stream)
    var call = peer.call(peer.connections[Object.keys(peer.connections)[0]][0].peer, my_stream);
    calls.push(call)
    call.on('stream', function (remoteStream) {
      video_setStream('remote_video', remoteStream)
      $('#infoBox').addClass('d-none')
    });
  }).catch(function (err) {
    console.log(err.name + ": " + err.message);
  });
}


    </script>
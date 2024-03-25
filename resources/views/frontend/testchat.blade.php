<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Chat</title>
    @php
        header("Access-Control-Allow-Origin: 127.0.0.1:3000");
        header("Access-Control-Allow-Credentials: true");
    @endphp


</head>
<body>
    <input type="text" id="roomIdInput" placeholder="Enter Room ID">
    <button onclick="joinRoom()">Join Room</button>
    <button onclick="leaveRoom()">Leave Room</button>
    <input type="text" id="messageInput" placeholder="Enter Message">
    <button onclick="sendMessage()">Send Message</button>
    
    <ul id="messages"></ul>
    
    <script src="{{asset('socketio/client-dist/socket.io.js')}}"></script>
    <script>

        
const socket = io("http://127.0.0.1:3000/", {
  withCredentials: true,
  transports: ["polling","websocket"]
});
     
    
        function joinRoom() {
            const roomId = document.getElementById('roomIdInput').value;
            socket.emit('joinRoom', roomId);
        }
    
        function leaveRoom() {
            const roomId = document.getElementById('roomIdInput').value;
            socket.emit('leaveRoom', roomId);
        }
    
        function sendMessage() {
            const roomId = document.getElementById('roomIdInput').value;
            const message = document.getElementById('messageInput').value;
            socket.emit('privateMessage', { roomId, message });
        }
    
        socket.on('privateMessage', message => {
            const messagesElement = document.getElementById('messages');
            const li = document.createElement('li');
            li.textContent = message;
            messagesElement.appendChild(li);
        });
    </script>
</body>
</html>
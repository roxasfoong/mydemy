@auth
@php
	$currentUser = auth()->user();
@endphp
<script src="{{asset('socketio/client-dist/socket.io.js')}}"></script>
<script>
    
    window.addEventListener('beforeunload', function (event) {
    // Do something when the user is about to leave the page
    // For example, you can prompt the user with a confirmation message
    socket.emit('leaveRoom');
});

var selectUserID = 0;
    var currentUserID = {{$currentUser->id}}
    loadTotalMessage(currentUserID,selectUserID);
                                    const socket = io("https://www.roxas-foong.site:3000", {
  									withCredentials: true,
  									transports: ["polling","websocket"]
									});
                                    socket.emit('joinRoom', currentUserID );
    
/*         function joinRoom() {
            const roomId = document.getElementById('roomIdInput').value;
            socket.emit('joinRoom', roomId);
            
        }
    
        function leaveRoom() {
            const roomId = document.getElementById('roomIdInput').value;
            socket.emit('leaveRoom', roomId);
        } */
    
/*             function sendMessage() {
            const roomId = document.getElementById('roomIdInput').value;
            const message = document.getElementById('messageInput').value;
            socket.emit('privateMessage', { roomId, message });
        } */
    
/*-----------------------------------------Listen to Event privateMessage--------------------------------------------*/

socket.on('privateMessage', ({roomId, message, sendFrom}) => {
var currentUserID = {{$currentUser->id}};
/* let senderSpan = document.getElementById('sender'+sendForm);
senderSpan.innerText="99"; */
checkTotalMessage(currentUserID,selectUserID,sendFrom);


//console.log(`Target.id : ${roomId}, SelectedID : ${selectUserID}, CurrentUserID : ${currentUserID}, Message : ${message}, SendFrom : ${sendFrom}`);

if(selectUserID == sendFrom || sendFrom == currentUserID ){
    
    loadPrivateMessage(message, roomId, currentUserID, sendFrom);
    deleteSenderMessage(selectUserID);
    

}else{
    
}

loadTotalMessage(currentUserID,selectUserID);
});

function checkTotalMessage(currentUserID,selectUserID,sendFrom){
    let senderID = `sender${sendFrom}`;
    if (selectUserID == sendFrom) {

        
        //console.log(senderID);
        document.getElementById(senderID).innerText='0';

    }
    else
    {
        $.ajaxSetup({
        headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
        })

        $.ajax({
        url: '/get-user-message-count',
        method: 'GET',
        success: function(response) {
            //console.log(response);
        let senders = response.sender;
        
            //No New Message At All
            if(senders === 0 ){
            return 1;
            }
            let totalMessageCount = 0;
            for ( const sender of senders){
                //console.log(sender.totalMessCount);
                if(sender.sender_id == sendFrom){
                    document.getElementById(senderID).innerText= sender.totalMessCount;
                    break;
                }
                
            }
           

        },
        error: function(xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
        }
        });

    }
}
function loadTotalMessage(currentUserID,selectUserID){
    
        $.ajaxSetup({
        headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
        })

        $.ajax({
        url: '/get-user-message-count',
        method: 'GET',
        success: function(response) {
            
            //console.log(response);
        let senders = response.sender;
        let totalMessageCount = 0;
        //console.log(senders);
            //No New Message At All
            if(senders === 0 ){
                document.getElementById('messQty').innerText = totalMessageCount;
                document.getElementById("sMessQty").textContent = totalMessageCount;
                document.getElementById("mMessQty").textContent = totalMessageCount;
                
                //console.log( document.getElementById("sMessQty"));
                //$('#sMessQty').text(totalMessageCount);
                $('#indexMessQty').text(totalMessageCount);
               
            return 0;
            }
            
            for ( const sender of senders){

                totalMessageCount += sender.totalMessCount;
                console.log(`SenderID: ${sender.sender_id} with TotalMessage: ${totalMessageCount}`);
            }
           
           document.getElementById('messQty').innerText = totalMessageCount;
           document.getElementById("sMessQty").textContent = totalMessageCount;
           document.getElementById("mMessQty").textContent = totalMessageCount;
           //console.log( document.getElementById("sMessQty"));
           $('#indexMessQty').text(totalMessageCount);

        },
        error: function(xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
        }
        });

    
}

function loadPrivateMessage(message, roomId, currentUserID, sendFrom) {
var messageBodyDiv = document.getElementById('messageBody');
var spanElement = document.getElementById('selUserName');
var currentUserName = "{{$currentUser->name}}";

var currentTime = new Date();
const options = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };

var valueInsideSpan = spanElement.innerText;
var formattedTime = currentTime.toLocaleString('en-US', options);

var newUlElement = document.createElement('ul');
newUlElement.className = 'chat';
//console.log('Receive Message From ID: ' + roomId);
//console.log('Current User ID: ' + currentUserID);
if (selectUserID == sendFrom) {
    

    newUlElement.innerHTML = `
        <li class="sender">
            <div class="chat-img mx-3"></div>
            <div class="chat-body2">
                <div class="header">
                    <strong class="primary-font">${valueInsideSpan}</strong>
                </div>
                <div div="" class="message">${message}</div>
                <div>
                    <small class="text-muted">${formattedTime}</small>
                </div>
            </div>
        </li>
        <li class="sender">
            <span class="chat-img mx-2"></span>
        </li>
    `;
} else {
    newUlElement.innerHTML = `
    <li class="buyer">
            <div class="chat-img right mx-1"></div>
            <div class="chat-body right">
                <div class="header">
                    <strong>${currentUserName}</strong>
                </div>
                <div class="message">${message}</div>
                <div>
                    <small class="text-muted">${formattedTime}</small>
                </div>
            </div>
        </li>
        <li class="sender">
            <span class="chat-img mx-2"></span>
        </li>
    `;
}
// Append the new <ul> element to the div element
messageBodyDiv.appendChild(newUlElement);
}

/*-----------------------------------------Listen to Event privateMessage--------------------------------------------*/

function AddMessage(userID,event) {
event.preventDefault();
var currentUserID = {{$currentUser->id}};
//socket.emit('joinRoom', userID , currentUserID);
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
})

$.ajax({
url: '/user-message/' + userID,
method: 'GET',
success: function(response) {

const user = response.user;
const messages = response.messages;
selectUserID = user.id;
deleteSenderMessage(selectUserID);
loadTotalMessage(currentUserID,selectUserID);

var wholeChat = 
`
<div class="card">
<div class="card-header text-center myrow">
`;
var userPart = loadUserPart(user);
var lastPart = loadLastPart(user,messages,userID);

document.getElementById('wholeChat').innerHTML = wholeChat+userPart+lastPart;

},
error: function(xhr, status, error) {
// Handle errors
console.error(xhr.responseText);
}
});
// Your JavaScript function logic here
//console.log(userID);

}

function deleteSenderMessage(selectUserID){
    let senderID = `sender${selectUserID}`;

    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
    })

    $.ajax({
    url: '/delete-message-count/' + selectUserID,
    method: 'GET',
    success: function(response) {
        //console.log(response);
        document.getElementById(senderID).innerText = 0;
    
    },
    error: function(xhr, status, error) {
    // Handle errors
    console.error(xhr.responseText);
    }
    });

    
}

function loadUserPart(user){
selectUserID = user.id;
    var temp ="";
if(user.role === "user"){

    temp = 
    `
    <img src="/upload/user_images/${user.photo}" alt="UserImage" class="userImg" />
    `;

}
else
{
    temp = 
    `
    <img src="/upload/instructor_images/${user.photo}" alt="InstImage" class="userImg" />
    `;
}

    temp += `<span id="selUserName"><strong>${user.name} </strong></span>
      </div>`;

      return temp;
}

function loadLastPart(user,message,userID){
var currentUserID = {{$currentUser->id}};
var currentUserName = "{{$currentUser->name}}";
var temp =
`
<div id="messageBody" class="card-body chat-msg">
    <ul class="chat">
`;

message.forEach(msg => {

    
    var formattedTime = formatDate(msg.updated_at);


    if (msg.receiver_id !== currentUserID) {


temp += 
`
<li class="buyer">
<div class="chat-img right mx-1"></div>
<div class="chat-body right">
<div class="header">
<strong>${currentUserName}</strong>
</div>
<div class="message">${msg.msg}</div>
<div>
<small class="text-muted">${formattedTime}</small>
</div>
</div>
</li>
<li class="sender">
<span class="chat-img mx-2"></span>
</li>
`;
}

else {
temp +=  
`
<li class="sender">
<div class="chat-img mx-1"></div>
<div class="chat-body2">
<div class="header">
<strong class="primary-font">${msg.user.name}</strong>
</div>
<div div="" class="message">${msg.msg}</div>
<div>
<small class="text-muted">${formattedTime}</small>
</div>
</div>
</li>
<li class="sender">
<span class="chat-img mx-2"></span>
</li>
`;

}
});

temp +=
`
</ul>
      </div>
      <div class="card-footer">
        <div class="input-group">
          <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..."/>
          <span class="input-group-btn">
            <button class="btn btn-primary" onclick="sendMessage(${userID},event)">Send</button>
          </span>
        </div>
      </div>
      
</div>
`;

return temp;
}

function formatDate(dateString){
    const options = {  month: 'short', day: 'numeric',hour:'2-digit', minute: '2-digit'};
    return new Date(dateString).toLocaleDateString('en-US',options);
}

function sendMessage(userID,event){
event.preventDefault();
var currentUserID = {{$currentUser->id}};
var inputMessage = document.getElementById('btn-input');
socket.emit('privateMessage', { roomId: userID, message: inputMessage.value, sendFrom: currentUserID })
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
})
$.ajax({
url: '/send-message',
method: 'POST',
data: {
receiver_id: userID,
msg: inputMessage.value
},
success: function(response) {
inputMessage.value = '';

},
error: function(xhr, status, error) {

console.error(xhr.responseText);
}
});
}
			
/* -----------------------For Send Message From Course Detail------------------------------ */

$(document).ready(function() {
        $('#sendMessageButton').click(function() {
            var currentUserID = {{$currentUser->id}};
            var sendMessageButton = document.getElementById('sendMessageButton');
            var receiverId = sendMessageButton.dataset.receiverId;
            var message = $('#messageTextarea').val();

            // Perform AJAX request to send message
            $.ajax({
                url: '{{ route("send.message.to.instructor") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    receiver_id: receiverId,
                    msg: message
                },
                success: function(response) {
                    // Handle success response
                    //console.log(response);
                    socket.emit('startMessage', { roomId: receiverId, message: message, sendFrom: currentUserID });
                    // Store notification data in session storage
                    sessionStorage.setItem('notification', JSON.stringify(response));
                    

                    // Redirect to the desired URL
                    window.location.href = "{{route('live.Node.chat')}}";
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    });

socket.on('startMessage', ({roomId, message, sendFrom}) => {
var currentUserID = {{$currentUser->id}};
/* let senderSpan = document.getElementById('sender'+sendForm);
senderSpan.innerText="99"; */
checkTotalMessage(currentUserID,selectUserID,sendFrom);


//console.log(`Target.id : ${roomId}, SelectedID : ${selectUserID}, CurrentUserID : ${currentUserID}, Message : ${message}, SendFrom : ${sendFrom}`);
reloadChatList(currentUserID);
if(selectUserID == sendFrom || sendFrom == currentUserID ){
    
    loadPrivateMessage(message, roomId, currentUserID, sendFrom);
    deleteSenderMessage(selectUserID);
    

}else{
    
}
loadTotalMessage(currentUserID,selectUserID);
});

function reloadChatList(currentUserID){

    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
    })

    $.ajax({
    url: '/user-all',
    method: 'GET',
    success: function(response) {

        var users = response.users;
        
        loadSenderCount(users,currentUserID);

    },
    error: function(xhr, status, error) {
    // Handle errors
    console.error(xhr.responseText);
    }
    });


}

function loadSenderCount(users,currentUserID){
    var chatList = document.getElementById('chatList');
    var content = '';
    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
    })

    $.ajax({
    url: '/get-user-message-count',
    method: 'GET',
    success: function(response) {
        
        var senders = response.sender;
        

        let keys = Object.keys(users);

        content =
        `
        <strong>Chat List</strong>
        <hr>

        `;
    
        keys.forEach(key => {
        let user = users[key];
        // Do something with each user object
        if(user.id == currentUserID){
            
        }
        else
        {
            content +=
            `
            <li>
            <a href="" onclick="AddMessage( ${user.id}, event )">
              <span id="sender${user.id}" class="overlay-text">
            `;
            content += checkUserCount(senders,user);
            content +=
            `</span>`;
            if(user.role == 'user'){
            content +=
             `
              <img src="/upload/user_images/${user.photo}"
                alt="UserImage"
                class="userImg image-container"instructor
              />

              <span class="username text-center">${user.name}</span>
              </a>
              </li>
              `
            }
            if(user.role== 'instructor')
            {

            content+=
            `
              <img src="/upload/instructor_images/${user.photo}"
                alt="UserImage"
                class="userImg image-container"
              />
              
              <span class="username text-center">${user.name}</span>
              
            </a>
            </li>
            `;
            }

        }
        });

        chatList.innerHTML= '';
        chatList.innerHTML= content;
        //console.log(content);

    },
    error: function(xhr, status, error) {
    // Handle errors
    console.error(xhr.responseText);
    }
    });


}

function checkUserCount(senders,user){

    if(senders.length === 0 ){
            return 0;
          }
         for (const sender in senders) {
          console.log(`CurrentUser : ${user.id}, CurrentLoop : ${senders[sender].sender_id}`);
          if(user.id == senders[sender].sender_id){
            return senders[sender].totalMessCount;
          }
          }

          return 0;

}
           
/* -----------------------For Send Message From Course Detail------------------------------ */

</script>
@endauth
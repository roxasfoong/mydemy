<template>
    <div class="row" >
      <div class="col-md-3 myUser">
          <ul id="chatList" class="user">
             <strong>Chat List</strong>
             <hr>
          <li v-for="(user, index) in users" :key="user.id+index" > 
            <a href=""  v-if="user.id !== currentUser.id" :onclick="`AddMessage( ${user.id}, event )`">
              <span :id="'sender'+user.id" class="overlay-text">{{ checkSender(user) }}</span>
              <img v-if="user.role === 'user' " :src="(user.photo === 'photo') ? '/upload/no_image.jpg' : '/upload/user_images/'+user.photo"
                alt="UserImage"
                class="userImg image-container"
              />
  
              <img v-else :src="(user.photo === 'photo') ? '/upload/no_image.jpg' : '/upload/instructor_images/'+user.photo"
                alt="UserImage"
                class="userImg image-container"
              />
              
              <span class="username text-center">{{ user.name }}</span>
              
            </a>
          </li>
  
        </ul>
      </div>
  
      
      <div id="wholeChat" class="col-md-9" >
     
      </div>
  
  
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users: {},
        currentUser: {},
        allmessages: {},
        senderMessageCount: {},
        selectedUser: '',
        prevSelectedUser: '',
        msg: ''
      }
    },
    computed: {

      userKeys() {
      return Object.keys(this.users);
      }
    },
    created() {
      this.getAllUser();
      this.loadMessCount();
    },
    methods: {
      checkSender(user) {
        //console.log(user.id);
       // console.log(this.senderMessageCount);
        //console.log(senderMessageCount);
       
          if(this.senderMessageCount === 0 ){
            return 0;
          }
         for (const sender in this.senderMessageCount) {
          //console.log(this.senderMessageCount[sender].sender_id);
          console.log(`CurrentUser : ${user.id}, CurrentLoop : ${this.senderMessageCount[sender].sender_id}`);
          if(user.id==this.senderMessageCount[sender].sender_id){
            return this.senderMessageCount[sender].totalMessCount;
          }
          }

          return 0;
        

         // Return false if no match found
      },

      getAllUser() {
        axios.get('/user-all')
          .then((res) => {
            this.users = res.data.users;
            this.currentUser = res.data.currentUser;
          }).catch((err) => {
            console.error(err);
          });
      },
      loadMessCount() {
        axios.get('/get-user-message-count')
          .then((res) => {
            this.senderMessageCount = res.data.sender;
            //console.log(this.senderMessageCount);
          }).catch((err) => {
            console.error(err);
          });
      },
      userMessage(userId) {
        axios.get('/user-message/' + userId)
          .then((res) => {
            this.allmessages = res.data;
            this.prevSelectedUser = this.selectedUser;
            this.selectedUser = userId;
            socket.emit('joinRoom', this.selectedUser, this.currentUser.id);
          }).catch((err) => {
            console.error(err);
          });
      },
      sendMsg() {
        axios.post('/send-message', { receiver_id: this.selectedUser, msg: this.msg })
          .then((res) => {
            this.msg = "";
            this.userMessage(this.selectedUser);
            //console.log(res.data);
          }).catch((err) => {
            console.error(err);
            this.errors = err.response.data.errors;
          });
      },
      formatDate(dateString) {
        const options = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleDateString('en-US', options);
      }
    }
  };
  </script>
  
  <style> 
  .image-container {
    position: relative;
    display: inline-block;
}

.overlay-text {
    
    top: 50%;
    left: 0;
    background-color: red;
    color: white;
    padding: 10px;
    transform: translateY(-50%);
}

  .username {
    color: #000;
  }
  
  .myrow{
      background: #F3F3F3;
      padding: 25px;
  }
  
  .myUser{
       padding-top: 30px;
       overflow-y: scroll;
      height: 70vh;
      background: #F2F6FA;
  }
  .user li {
    list-style: none;
    margin-top: 20px;
   
  }
  
  .user li a:hover {
    text-decoration: none;
    color: red;
  }
  .userImg {
    height: 70px;
    border-radius: 50%;
  }
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  .chat li {
    margin-bottom: 40px;
    padding-bottom: 5px;
    margin-top: 20px;
    width: 80%;
    height: 15px;
  }
  
  .chat li .chat-body p {
    margin: 0;
  }
  
  .chat-msg {
    overflow-y: scroll;
    height: 60vh;
    background: #F2F6FA;
  }
  .chat-msg .chat-img {
    width: 100px;
    height: 100px;
  }
  .chat-msg .img-circle {
    border-radius: 50%;
  }
  .chat-msg .chat-img {
    display: inline-block;
  }
  .chat-msg .chat-body {
    display: inline-block;
    
    
    background-color: #bccbff;
    border-radius: 12.5px;
    padding: 15px;
    font-size: clamp(16px, 2vw, 20px);
    margin-top: 10rem;
  }
  .chat-msg .chat-body2 {
    display: inline-block;
   
    
    background-color: #beff7d;
    border-radius: 12.5px;
    padding: 15px;
    font-size: clamp(16px, 2vw, 20px);
    margin-top: 10rem;
  }
  .chat-msg .chat-body strong {
    color: #0169da;
  }
  
  .chat-msg .buyer {
    text-align: left ;
    float: right;
  }
  .chat-msg .buyer p {
    text-align: left;
  }
  .chat-msg .sender {
    text-align: left;
    float: left;
  }
  .chat-msg .right {
    float: right;
  }
  

  </style>
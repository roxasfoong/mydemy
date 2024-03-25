<template>
  <div class="row" >
    <div class="col-md-3 myUser">
        <ul class="user">
           <strong>Chat List</strong>
           <hr>
        <li v-for="(user, index) in users" :key="index" > 
          <a href="" @click.prevent="userMessage(user.id)" v-if="user.id !== currentUser.id">



            <img v-if="user.role === 'user' " :src="'/upload/user_images/'+user.photo"
              alt="UserImage"
              class="userImg"
            />

            <img v-else :src="'/upload/instructor_images/'+user.photo"
              alt="UserImage"
              class="userImg"
            />

            <span class="username text-center">{{ user.name }}</span>
          </a>
        </li>

      </ul>
    </div>

    
    <div class="col-md-9" v-if="allmessages.user" >
      <div class="card">
        <div class="card-header text-center myrow">
          <img v-if="allmessages.user.role === 'user' " :src="'/upload/user_images/'+allmessages.user.photo"
              alt="UserImage"
              class="userImg"
            />

            <img v-else :src="'/upload/instructor_images/'+allmessages.user.photo"
              alt="UserImage"
              class="userImg"
            />
          <span><strong>{{ allmessages.user.name  }} </strong></span>
        </div>
        <div class="card-body chat-msg">
          <ul class="chat" v-for="(msg,index) in allmessages.messages" :key="index" >

           <li class="sender clearfix" v-if="allmessages.user.id === msg.sender_id" >
              <div class="chat-img left clearfix mx-3">

              </div>
              <div class="chat-body2 clearfix">
                <div class="header clearfix">
                  <strong class="primary-font">{{ msg.user.name }}</strong>
                </div>

                <div div class="message">{{ msg.msg }}</div>
                <div> <small class="left text-muted">
                    {{  formatDate(msg.created_at) }}
                  </small></div>
              </div>
            </li>

        <!-- my part  -->
            
            <li class="buyer clearfix" v-else>
              <div class="chat-img right clearfix mx-1">
              </div>
              <div class="chat-body clearfix">
                <div class="header clearfix">
                  <strong class="left">{{ msg.user.name }} </strong>  
                </div>
                <div class="message">{{ msg.msg }}</div>
               <div><small class="left text-muted">{{  formatDate(msg.created_at) }}</small></div>

              </div>
            </li>
        
            <li class="sender clearfix">
              <span class="chat-img left clearfix mx-2"> </span>
            </li>

          </ul>
          
   


        </div>
        <div class="card-footer">
          <div class="input-group">
            <input
              id="btn-input"
              type="text"
              v-model="msg"
              class="form-control input-sm"
              placeholder="Type your message here..."
            />
            <span class="input-group-btn">
              <button class="btn btn-primary" @click.prevent="sendMsg()" >Send</button>
            </span>
          </div>
        </div>
      </div>
    </div>


  </div>
</template>

<script>
export default {
   mounted() {
    const userData = JSON.parse(this.$el.getAttribute('data-user'));
    console.log(userData); // This will log the user data passed from Blade
  },
  data(){
    return {
      users: {},
      currentUser: {},
      allmessages: {},
      selectedUser: '',
      msg: '',
    }
  },

  created(){
    this.getAllUser();

    setInterval(() => {
      this.userMessage(this.selectedUser);
    },1000);
    

  },
  methods:{
    getAllUser(){
      axios.get('/user-all')
      .then((res) => {
        this.users = res.data.users;
        this.currentUser = res.data.currentUser;
      }).catch((err) => {

      }); 
    },

    userMessage(userId){
      axios.get('/user-message/'+userId)
      .then((res) => {
        this.allmessages = res.data;
        this.selectedUser = userId;

      }).catch((err) => {

      })
    },

    sendMsg(){
        axios.post('/send-message',{ receiver_id:this.selectedUser,msg:this.msg } )
        .then((res) => {
          this.msg = "";
          this.userMessage(this.selectedUser);
          console.log(res.data);
        }).catch((err) => {
          this.errors = err.response.data.errors;
        })
    }, 
    formatDate(dateString){
      const options = {  month: 'short', day: 'numeric',hour:'2-digit', minute: '2-digit'};
      return new Date(dateString).toLocaleDateString('en-US',options);
    },


  },
   
};
</script>



<style> 

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
    height: 450px;
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
  height: 35px;
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
  height: 10px;
}

.chat li .chat-body p {
  margin: 0;
}

.chat-msg {
  overflow-y: scroll;
  height: 350px;
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
  max-width: 80%;
  margin-right: -73px; 
  background-color: #bccbff;
  border-radius: 12.5px;
  padding: 15px;
  font-size: clamp(16px, 2vw, 20px);
  margin-top: 10rem;
}
.chat-msg .chat-body2 {
  display: inline-block;
  max-width: 80%;
  margin-left: -64px;
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
  text-align: left;
  float: right;
}
.chat-msg .buyer p {
  text-align: left;
}
.chat-msg .sender {
  text-align: left;
  float: left;
}
.chat-msg .left {
  float: left;
}
.chat-msg .right {
  float: right;
}

.clearfix {
  clear: both;
}
</style>
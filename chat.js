import express from 'express';
import http from 'http';
import { Server as SocketIOServer } from 'socket.io';


const app = express();
var removeCounter = 0;


const server = http.createServer(app);
var userSocketMap = [];
const io = new SocketIOServer(server, {
    cors: {
       // Allow requests from this origin
      origin: "http://*.roxas-foong.site",
      methods: ["GET", "POST"], // Allow these HTTP methods
      credentials: true,
    }
  });


io.on('connection', socket => {
    //console.log('User connected');

    socket.on('joinRoom', (currentUser) => {
        console.log(`${currentUser} socket id: ${socket.id} Join Room: ${currentUser}`);
        userSocketMap.push({user:currentUser, socket: socket.id });
        console.log(userSocketMap);
    });

    socket.on('leaveRoom', () => {
       // console.log(`User leaving room: ${roomId}`);
       // socket.leave(roomId);
       for(const find of userSocketMap){

        if(find.socket == socket.id){
          const removeCounter = userSocketMap.indexOf(find);
            userSocketMap.splice(removeCounter,1);
            break;

        }
        removeCounter += 1;
      }
      removeCounter=0;
      console.log(userSocketMap);  
    });

    socket.on('privateMessage', ({ roomId, message, sendFrom}) => {
        console.log(`${sendFrom} Say to UserID = ${roomId} : ${message}`);
       
       for(const find of userSocketMap){
        console.log(`TargetID : ${roomId}`);
        console.log(`SearchID : ${find.user}`);
        if(roomId == find.user){
          io.to(find.socket).emit('privateMessage', {roomId,message,sendFrom});
          io.to(socket.id).emit('privateMessage', {roomId,message,sendFrom});
          break;
        }
       }
    });

    socket.on('startMessage', ({ roomId, message, sendFrom}) => {
      console.log(`${sendFrom} Say to UserID = ${roomId} : ${message}`);
     
     for(const find of userSocketMap){
      //console.log(`TargetID : ${roomId}`);
      //console.log(`SearchID : ${find.user}`);
      if(roomId == find.user){
        io.to(find.socket).emit('privateMessage', {roomId,message,sendFrom});
        io.to(socket.id).emit('privateMessage', {roomId,message,sendFrom});
        break;
      }
     }
  });

    socket.on('disconnect', () => {
        
        for(const find of userSocketMap){

          if(find.socket == socket.id){
            const removeCounter = userSocketMap.indexOf(find);
              userSocketMap.splice(removeCounter,1);
              break;

          }
          removeCounter += 1;
        }
        removeCounter=0;
        console.log(userSocketMap);     
    });

      /*  io.of("/").adapter.on("create-room", (room) => {
       // console.log(`room ${room} was created`);
      });
      
      io.of("/").adapter.on("join-room", (room, id) => {
        // console.log(`socket ${id} has joined room ${room}`); 
        const numClients = io.sockets.adapter.rooms.get(room)?.size || 0;
       // console.log(`Number of clients in room ${room}: ${numClients}`);
        
      });

      io.of("/").adapter.on("delete-room", (room) => {
        //console.log(`room ${room} was deleted`);
      });
      
      io.of("/").adapter.on("leave-room", (room, id) => {
        // console.log(`socket ${id} has leave room ${room}`); //
        const numClients = io.sockets.adapter.rooms.get(room)?.size || 0;
        //console.log(`Number of clients in room ${room}: ${numClients}`);
      }); */
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});

export default app; // Exporting the Express app if needed
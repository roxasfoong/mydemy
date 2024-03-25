import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js'; 
import SendMessage from './components/SendMessage.vue' ;
import ChatMessage from './components/ChatMessage.vue' ;
import NodeChat from './components/NodeChat.vue' ;

 
const app=createApp({
	components:{
		SendMessage,
        ChatMessage,
		NodeChat, 
	}
});
app.mount('#app'); 

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
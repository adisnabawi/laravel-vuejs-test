import './bootstrap';
import { createApp } from 'vue';
import Hello from './components/Hello.vue';

createApp({
    components: {
        Hello
    }
}).mount('#app');
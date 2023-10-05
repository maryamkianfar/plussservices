import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
const app = createApp(App);

// Agrega el enrutador a la aplicación
app.use(router);

app.mount('#app');


import 'bootstrap/dist/css/bootstrap.css'
import {createApp} from 'vue'
import App from './App.vue'
import router from "@/components/routes";
import VeeValidate from "@/plugins/VeeValidate";


createApp(App)
    .use(router)
    .use(VeeValidate)
    .mount('#app')

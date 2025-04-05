import './bootstrap';

import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            userMenuState: false,
            mobileMenuState: false,
        }
    }
});

import Registration from "./components/registration.vue";
import Competition from "./components/competition.vue";
app.component('Registration', Registration);
app.component('Competition', Competition);

app.mount('#app')

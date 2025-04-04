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
app.component('Registration', Registration);

app.mount('#app')

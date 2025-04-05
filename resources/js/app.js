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
import Competition from "./components/Competition.vue";
import NewCompetitionForm from "./components/NewCompetitionForm.vue";
app.component('Registration', Registration);
app.component('Competition', Competition);
app.component('NewCompetitionForm', NewCompetitionForm);

app.mount('#app')

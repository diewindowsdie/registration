import './bootstrap';

import { createApp } from 'vue';
import { initFlowbite } from 'flowbite';
import dayjs from 'dayjs';
import utc from 'dayjs/plugin/utc';
import timezone from 'dayjs/plugin/timezone';

const app = createApp({
    data() {
        return {
            userMenuState: false,
            mobileMenuState: false,
        }
    },
    mounted() {
        initFlowbite();
    }
});

dayjs.extend(utc);
dayjs.extend(timezone);
dayjs.tz.setDefault("Europe/Moscow");

import CompetitionRegistrationForm from "./components/CompetitionRegistrationForm.vue";
import Competition from "./components/Competition.vue";
import NewCompetitionForm from "./components/NewCompetitionForm.vue";
import CompetitionParticipants from "./components/CompetitionParticipants.vue";
app.component('CompetitionRegistrationForm', CompetitionRegistrationForm);
app.component('Competition', Competition);
app.component('NewCompetitionForm', NewCompetitionForm);
app.component('CompetitionParticipants', CompetitionParticipants);

app.mount('#app')

/**
 * dark mode button
 */
const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

const themeToggleBtn = document.getElementById('theme-toggle');
themeToggleBtn.addEventListener('click', function() {
    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

        // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }

});

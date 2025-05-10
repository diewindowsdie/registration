import './bootstrap';

import {createApp, reactive} from 'vue';
import { i18nVue } from 'laravel-vue-i18n';
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
}).use(i18nVue, {
    resolve: lang => {
        const langs = import.meta.glob('../../lang/*.json', { eager: true });
        return langs[`../../lang/${lang}.json`].default;
    },
});

dayjs.extend(utc);
dayjs.extend(timezone);
dayjs.tz.setDefault("Europe/Moscow");

import CompetitionRegistrationForm from "./components/CompetitionRegistrationForm.vue";
import NewCompetitionForm from "./components/NewCompetitionForm.vue";
import CompetitionParticipants from "./components/CompetitionParticipants.vue";
import SortOrderIndicator from "./components/SortOrderIndicator.vue";
import NavigationMenu from "./components/NavigationMenu.vue";

app.component('CompetitionRegistrationForm', CompetitionRegistrationForm);
app.component('NewCompetitionForm', NewCompetitionForm);
app.component('CompetitionParticipants', CompetitionParticipants);
app.component('SortOrderIndicator', SortOrderIndicator);
app.component('NavigationMenu', NavigationMenu);

app.mount('#app');

/**
 * dark mode button
 */
const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
const themeToggleAutoIcon = document.getElementById('theme-toggle-auto-icon');

//определим, какую иконку показывать по умолчанию
if (!('color-theme' in localStorage)) {
    themeToggleAutoIcon.classList.remove('hidden');
} else if (localStorage.getItem('color-theme') === 'dark' || window.matchMedia('(prefers-color-scheme: dark)').matches) {
    themeToggleDarkIcon.classList.remove('hidden');
} else if (localStorage.getItem('color-theme') === 'light' || window.matchMedia('(prefers-color-scheme: light)').matches) {
    themeToggleLightIcon.classList.remove('hidden');
}

const themeToggleBtn = document.getElementById('theme-toggle');
themeToggleBtn.addEventListener('click', function() {
    // toggle icons inside button
    themeToggleDarkIcon.classList.add('hidden');
    themeToggleLightIcon.classList.add('hidden');
    themeToggleAutoIcon.classList.add('hidden');

    //меняются светлая-темная-авто

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            //светлую заменяем на темную
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
            themeToggleDarkIcon.classList.remove('hidden');
        } else if (localStorage.getItem('color-theme') === 'dark') {
            //темную заменяем на авто
            //при смене темной на авто перед удалением темных стилей проверяем предпочтения
            if (!window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.remove('dark');
            }

            localStorage.removeItem('color-theme');
            themeToggleAutoIcon.classList.remove('hidden');
        }
    } else {
        //если в локал сторадже нет темы, значит это авто - меняем ее на светлую
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
        }

        localStorage.setItem('color-theme', 'light');
        themeToggleLightIcon.classList.remove('hidden');
    }
});

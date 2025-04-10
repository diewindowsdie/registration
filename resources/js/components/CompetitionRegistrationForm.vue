<template>
    <section class="bg-transparent">
        <div class="py-8 px-4 mx-auto max-w-6xl lg:py-16">
            <form @submit.prevent="onSubmit" method="post" :action="routeSave">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                        <input type="text" v-model="athlete.surname" name="surname" id="surname"
                               @input="searchAthlete(true)"
                               class="border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               @focusin="searchAthlete()"/>
                        <div
                            class="absolute border  bg-gray-50 border-gray-300 text-gray-900 text-sm outline-1 -outline-offset-1 outline-gray-300 sm:text-sm/6 z-40 sm:col-span-2 w-90 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            v-show="athletes.length">
                            <template v-for="item in athletes">
                                <div @click="fillForm(item)"
                                     class="hover:bg-gray-200 hover:dark:bg-gray-600 px-3 py-3 ">
                                    <p class="text-left"><b class="font-bold">{{ item.surname }}
                                        {{
                                            item.first_name
                                        }}{{ item.patronymic != null ? " " + item.patronymic : "" }}</b>,
                                        {{ item.qualification.short_title }}</p>
                                    <p v-if="item.gender === 'M'" class="text-right text-gray-400">родился
                                        {{ moment(item.birth_date).format("DD.MM.YYYY") }},
                                        {{ item.region.full_name }}</p>
                                    <p v-else-if="item.gender === 'F'" class="text-right text-gray-400">
                                        родилась
                                        {{ moment(item.birth_date).format("DD.MM.YYYY") }},
                                        {{ item.region.full_name }}</p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="first_name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                        <input type="text" v-model="athlete.first_name" name="first_name" id="first_name"
                               class="border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="patronymic"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                        <input type="text" v-model="athlete.patronymic" name="patronymic" id="patronymic"
                               class="border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <div class="sm:col-span-2">
                        <fieldset>
                            <legend class="text-sm/6 font-semibold text-gray-900">Пол</legend>
                            <div class="mt-2 space-y-0">
                                <div class="flex items-center gap-x-3">
                                    <input v-model="athlete.gender" id="F" name="gender" type="radio" value="F"
                                           class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                    <label for="F"
                                           class="block text-sm/6 font-medium text-gray-900">Женский</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input v-model="athlete.gender" id="M" name="gender" type="radio" value="M"
                                           class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                    <label for="M"
                                           class="block text-sm/6 font-medium text-gray-900">Мужской</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата рождения</label>
                            <input v-model="athlete.birth_date" type="date" name="birth_date" id="birth_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <!--                        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown divider <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">-->
                    <!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>-->
                    <!--                        </svg>-->
                    <!--                        </button>-->

                    <!--                        &lt;!&ndash; Dropdown menu &ndash;&gt;-->
                    <!--                        <div id="dropdownDivider" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">-->
                    <!--                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">-->
                    <!--                                <li>-->
                    <!--                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>-->
                    <!--                                </li>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>-->
                    <!--                                </li>-->
                    <!--                                <li>-->
                    <!--                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>-->
                    <!--                                </li>-->
                    <!--                            </ul>-->
                    <!--                            <div class="py-2">-->
                    <!--                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated link</a>-->
                    <!--                            </div>-->
                    <!--                        </div>-->

                    <div class="sm:col-span-2">
                        <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Регион</label>
                            <input type="hidden" v-model="athlete.region_code" id="region_code" name="region_code"/>
                            <input v-model="athlete.region" type="text" name="region" id="region"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        <!--todo region component                        -->
                    </div>

                    <div class="sm:col-span-3">
                        <label for="sport_school" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Спортивная школа</label>
                            <input type="text" v-model="athlete.sport_school" name="sport_school" id="sport_school"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="sport_organisation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Спортивный клуб или организация</label>
                            <input type="text" v-model="athlete.sport_organisation" name="sport_organisation"
                                   id="sport_organisation"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white select-none">Участие в соревнованиях:</label>
                        <template v-for="group in competition_copy.groups">
                            <div class="grid grid-cols-1 gap-x-6 gap-y-0 sm:grid-cols-1 flex items-center p-4 mt-2 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600"
                                 v-if="group.allowed_genders.includes(athlete.gender) || athlete.gender === ''">
                                <div class="flex items-center sm:row-span-1">
                                    <input id="participation_{{group.id}}" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        v-model="group.participation"/>
                                    <label for="participation_{{group.id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">{{ group.division.title }} {{ group.archery_class.title }}</label>
                                </div>
                                <div class="sm:row-span-1 pl-5 mt-5" v-if="group.participation == true">
                                <div v-if="group.includes_teams == 1" class="flex items-center">
                                    <input id="participation_team_{{group.id}}" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                           v-model="group.participate_teams"/>
                                    <label for="participation_team_{{group.id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Участвую в командных соревнованиях</label>
                                </div>
                                <div v-if="group.includes_mixed_teams == 1" class="flex items-center">
                                    <input id="participation_mixed_team_{{group.id}}" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                           v-model="group.participate_mixed_teams"/>
                                    <label for="participation_mixed_team_{{group.id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Участвую в соревнованиях команд-микс</label>
                                </div>
                                    </div>
                            </div>
                        </template>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="contact_info" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Контактная информация</label>
                            <input type="text" v-model="athlete.contact_information" name="contact_info"
                                   id="contact_info"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="coach_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Тренер</label>
                            <input type="text" v-model="athlete.coach_name" name="coach_name" id="coach_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                </div>

                <button type="button" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600 mr-1" @click.prevent="onClear">
                    Очистить
                </button>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Сохранить
                </button>

            </form>
        </div>
    </section>
</template>

<script setup>
import {ref} from 'vue';
import axios from "axios";
import moment from 'moment';

const props = defineProps(['routeSave', "routeFindAthlete", "competition", "divisions", "archery_classes"]);
const competition_copy = ref(props.competition);

const athlete = ref({
    athlete_id: '',
    competition_id: '',
    first_name: '',
    surname: '',
    patronymic: '',
    gender: '',
    birth_date: '',
    region_code: '',
    region: '',
    sport_school: '',
    sport_organisation: '',
    contact_information: '',
    coach_name: '',
});

const athletes = ref([]);
let cache = {};

function searchAthlete(ignoreFormData = false) {
    if (!ignoreFormData && (athlete.value.surname.length > 0 || athlete.value.first_name.length > 0 || athlete.value.patronymic.length > 0)) {
        return;
    }

    if (athlete.value.surname.length > 2) {
        if (athlete.value.surname in cache) {
            athletes.value = cache[athlete.value.surname];
            return;
        }

        axios.get(props.routeFindAthlete, {
            params: {
                surname: athlete.value.surname
            }
        }).then((response) => {
            athletes.value = response.data.athletes;
            cache[athlete.value.surname] = response.data.athletes;
        })
    }
}

function onSubmit() {
    athlete.value.competition_id = props.competition.id;

    axios.post(props.routeSave, {
        groups: competition_copy.value.groups
            .filter((group) => group.participation == true)
            .map(function (group) {
                let result = {};
                for (const property in group) {
                    if (["id", "participation", "participate_teams", "participate_mixed_teams"].includes(property)) {
                        result[property] = group[property];
                    }
                }

                return result;
            }),
        ...athlete.value,
    }).then(r => {
        //const data = r.data;
        //console.log(data);
        cache = {};
        alert('сохранено');
    }).catch(e => {
        console.log(e);

        if (e.response && e.response.data && e.response.data.errors) {
            this.errors = e.response.data.errors;
        } else {
            alert("Произошла ошибка при сохранении объекта");
            if (e.response) {
                console.log(e.response);
            }
        }
    }).finally(() => {
        console.log('athlete saved')
    });
}

function onClear() {
    if (!confirm('Вы уверены что хотите очистить данные формы?')) {
        return;
    }

    athlete.value = {
        athlete_id: '',
        first_name: '',
        surname: '',
        patronymic: '',
        gender: '',
        birth_date: '',
        region: '',
        region_code: '',
        sport_school: '',
        sport_organisation: '',
        contact_information: '',
        coach_name: '',
    }
}

function fillForm(data) {
    athlete.value.athlete_id = data.id;
    athlete.value.first_name = data.first_name;
    athlete.value.surname = data.surname;
    athlete.value.patronymic = data.patronymic;
    athlete.value.gender = data.gender;
    athlete.value.birth_date = moment(data.birth_date).format("YYYY-MM-DD");
    athlete.value.region = data.region.full_name;
    athlete.value.region_code = data.region.code;

    athletes.value = [];
}
</script>

<template>
    <div class="bg-white shadow-sm p-10">
        <form @submit.prevent="onSubmit" method="post" :action="routeSave">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-6">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="surname" class="block text-sm/6 font-medium text-gray-900">Фамилия</label>
                            <div class="mt-2">
                                <input type="hidden" v-model="athlete.id" id="id" name="id" />
                                <input type="text" v-model="athlete.surname" name="surname" id="surname"
                                       @input="searchAthlete(true)" autocomplete="family-name"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                       @focusin="searchAthlete()"/>
                                <div
                                    class="absolute bg-white text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 z-40 sm:col-span-2 w-90"
                                    v-show="athletes.length">
                                    <template v-for="item in athletes">
                                        <div @click="fillForm(item)" class="hover:bg-amber-200 px-3 py-3 ">
                                            <p class="text-left"><b class="font-bold">{{ item.surname }}
                                                {{ item.first_name }}{{ item.patronymic != null ? " " + item.patronymic : ""}}</b>,
                                                {{ item.qualification.short_title }}</p>
                                            <p v-if="item.gender === 'M'" class="text-right text-gray-400">родился
                                                {{ moment(item.birth_date).format("DD.MM.YYYY") }},
                                                {{ item.region.full_name }}</p>
                                            <p v-else-if="item.gender === 'F'" class="text-right text-gray-400">родилась
                                                {{ moment(item.birth_date).format("DD.MM.YYYY") }},
                                                {{ item.region.full_name }}</p>
                                        </div>
                                    </template>
                                </div>

                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="first_name" class="block text-sm/6 font-medium text-gray-900">Имя</label>
                            <div class="mt-2">
                                <input type="text" v-model="athlete.first_name" name="first_name" id="first_name"
                                       autocomplete="given-name"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="patronymic" class="block text-sm/6 font-medium text-gray-900">Отчество</label>
                            <div class="mt-2">
                                <input type="text" v-model="athlete.patronymic" name="patronymic" id="patronymic"
                                       autocomplete="additional-name"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <fieldset>
                                <legend class="text-sm/6 font-semibold text-gray-900">Пол</legend>
                                <div class="mt-2 space-y-0">
                                    <div class="flex items-center gap-x-3">
                                        <input v-model="athlete.gender" id="F" name="gender" type="radio" value="F"
                                               class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                        <label for="F" class="block text-sm/6 font-medium text-gray-900">Женский</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input v-model="athlete.gender" id="M" name="gender" type="radio" value="M"
                                               class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                        <label for="M" class="block text-sm/6 font-medium text-gray-900">Мужской</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="birth_date" class="block text-sm/6 font-medium text-gray-900">Дата
                                рождения</label>
                            <div class="mt-2">
                                <input v-model="athlete.birth_date" type="date" name="birth_date" id="birth_date"
                                       autocomplete="birthday"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
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
                            <label for="birth_date" class="block text-sm/6 font-medium text-gray-900">Регион</label>
                            <div class="mt-2">
                                <input v-model="athlete.region" type="text" name="birth_date" id="birth_date"
                                       autocomplete="birthday"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 w-64"/>
                            </div>
                            <!--todo region component                        -->
                        </div>

                        <div class="sm:col-span-3">
                            <label for="sport_school" class="block text-sm/6 font-medium text-gray-900">Спортивная школа</label>
                            <div class="mt-2">
                                <input type="text" v-model="athlete.sport_school" name="sport_school" id="sport_school"
                                       autocomplete="given-name"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="sport_organisation" class="block text-sm/6 font-medium text-gray-900">Спортивный клуб или организация</label>
                            <div class="mt-2">
                                <input type="text" v-model="athlete.sport_organisation" name="sport_organisation" id="sport_organisation"
                                       autocomplete="given-name"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            Участие в соревновании:
                                <template v-for="group in competition.groups">
                                    <div v-if="group.allowed_genders.includes(athlete.gender) || athlete.gender === ''">{{group.division.title}} {{group.archery_class.title}}</div>
                                </template>
                        </div>

                        <div class="sm:col-span-2">
                            <!--                        <label for="group" class="block text-sm/6 font-medium text-gray-900">Класс</label>-->
                            <!--                        <div class="mt-2">-->
                            <!--                            <select v-model="athlete.archery_class" id="division" name="archery_class"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">-->
                            <!--                                <option v-for="archery_class in archery_classes" value="{{ archery_class.code}}">{{ archery_class.title }}</option>-->
                            <!--                            </select>-->
                            <!--                        </div>-->
                        </div>


                        <div class="sm:col-span-4">
                            <label for="phone" class="block text-sm/6 font-medium text-gray-900">Номер телефона</label>
                            <div class="mt-2">
                                <input v-model="athlete.phone" id="phone" name="phone" type="phone" autocomplete="phone"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                       placeholder="iphone 11 pro max"/>
                            </div>
                        </div>

                        <div class="sm:col-span-3 sm:col-start-1">
                            <label for="region" class="block text-sm/6 font-medium text-gray-900">Регион</label>
                            <div class="mt-2">
                                <input v-model="athlete.region_code" type="text" name="region" id="region"
                                       autocomplete="address-level1"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="city" class="block text-sm/6 font-medium text-gray-900">Город</label>
                            <div class="mt-2">
                                <input type="text" v-model="athlete.city" name="city" id="city"
                                       autocomplete="address-level2"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Обработка персональных данных</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Мы обработаем все ваши данные исходя из нашей политики
                        персональных данных</p>

                    <div class="mt-2 space-y-10">
                        <fieldset>
                            <div class="mt-2 space-y-6">

                                <div class="flex gap-3">
                                    <div class="flex h-6 shrink-0 items-center">
                                        <div class="group grid size-4 grid-cols-1">
                                            <input v-model="athlete.advertisement" id="advertisement"
                                                   aria-describedby="advertisement-description" name="advertisement"
                                                   type="checkbox"
                                                   class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"/>
                                            <svg
                                                class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                                viewBox="0 0 14 14" fill="none">
                                                <path class="opacity-0 group-has-checked:opacity-100"
                                                      d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11"
                                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-sm/6">
                                        <label for="advertisement" class="font-medium text-gray-900">Я согласен на
                                            рассылку об акциях и рекламных предложениях</label>
                                        <p id="advertisement-description" class="text-gray-500">Рекламные уведомления
                                            будут рекламировать наши луки и табуретки.</p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900" @click.prevent="onClear">Очистить
                </button>
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import axios from "axios";
import moment from 'moment';

const props = defineProps(['routeSave', "routeFindAthlete", "competition", "divisions", "archery_classes"])

const athlete = ref({
    id: '',
    first_name: '',
    surname: '',
    patronymic: '',
    gender: '',
    birth_date: '',
    region_code: '',
    region: '',
    sport_school: '',
    sport_organisation: '',
    phone: '',
    advertisement: '',
});

const athletes = ref([]);
const cache = {};

function searchAthlete(ignoreFormData = false) {
    console.log(props.competition.groups[0]);
    //console.log(JSON.parse(props.competition.groups[0].allowed_genders));
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
    console.log(athlete.value.birth_date);

    axios.post(props.routeSave, {
        ...athlete.value,
    }).then(r => {
        const data = r.data;
        console.log(data);
        alert('сохранено')
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
        id: '',
        first_name: '',
        surname: '',
        patronymic: '',
        gender: '',
        birth_date: '',
        region: '',
        region_code: '',
        sport_school: '',
        sport_organisation: '',
        city: '',
        phone: '',
        advertisement: '',
    }
}

function fillForm(data) {
    athlete.value.id = data.id;
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

<template>
    <section class="bg-transparent">
        <div class="px-4 mx-auto max-w-6xl">
            <form @submit.prevent="onSubmit" method="post" :action="routeSave">
                <div>
                    <p class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Регистрация открыта с {{dayjs(competition.registration_start).format("DD.MM.YYYY HH:mm:ss")}} по {{dayjs(competition.registration_finish).format("DD.MM.YYYY HH:mm:ss")}}</p>
                </div>
                <div v-if="globalErrors.length > 0" class="border-red-500 text-red-900 placeholder-red-700 rounded-2xl border-2 px-5 py-5 mb-3">
                    <label for="errors" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Пожалуйста, исправьте следующие ошибки:</label>
                    <ul id="errors" class="mt-5">
                        <li v-for="error in globalErrors" class="my-2 ml-8 text-sm text-red-600 dark:text-red-500 list-disc">
                            <span class="font-medium">{{ errorMessages[error] }}</span>
                        </li>
                    </ul>
                </div>
                <div class="border-gray-300 dark:border-gray-600 rounded-2xl border px-5 py-5">
                    <div class="grid grid-cols-15 gap-x-6 gap-y-8 sm:grid-cols-15">
                        <div class="sm:col-span-15"><label
                            class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white select-none">Данные
                            спортсмена:</label>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                            <input type="text" v-model="athlete.surname" name="surname" id="surname"
                                   @input="searchAthlete(true)"
                                   :class="formErrors.surname ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusin="searchAthlete()"
                                   @focusout='validateModel(athlete.surname, namePattern, "surname")'
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.surname"><span class="font-medium">Кириллица, латиница и дефис, два символа и больше</span>
                            </p>
                            <div
                                class="absolute border bg-gray-50 border-gray-300 ml-1 mt-1 text-gray-900 w-85 rounded-lg text-sm outline-1 outline-gray-300 z-40  dark:bg-gray-700 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:outline-gray-500"
                                v-show="athletes.length > 0">
                                <template v-for="item in athletes">
                                    <div @click="fillForm(item)"
                                         class="hover:bg-gray-200 hover:dark:bg-gray-600 px-3 py-3 ">
                                        <p class="text-left"><b class="font-bold">{{
                                                item.surname
                                            }}&nbsp;{{ item.first_name }}{{
                                                item.patronymic != null ? "&nbsp;" + item.patronymic : ""
                                            }}</b>, {{ item.qualification.short_title }}</p>
                                        <p v-if="item.gender === 'M'" class="text-right text-gray-400">родился
                                            {{ dayjs(item.birth_date).format("DD.MM.YYYY") }},
                                            {{ item.region.full_name }}</p>
                                        <p v-else-if="item.gender === 'F'" class="text-right text-gray-400">
                                            родилась
                                            {{ dayjs(item.birth_date).format("DD.MM.YYYY") }},
                                            {{ item.region.full_name }}</p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="sm:col-span-5">
                            <label for="first_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                            <input type="text" v-model="athlete.first_name" name="first_name" id="first_name"
                                   :class="formErrors.first_name ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout='validateModel(athlete.first_name, namePattern, "first_name")'
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.first_name"><span class="font-medium">Кириллица, латиница и дефис, два символа и больше</span>
                            </p>
                        </div>

                        <div class="sm:col-span-5">
                            <label for="patronymic"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                            <input type="text" v-model="athlete.patronymic" name="patronymic" id="patronymic"
                                   :class="formErrors.patronymic ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout='validateModel(athlete.patronymic, patronymicPattern, "patronymic")'
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.patronymic"><span class="font-medium">Кириллица, латиница и дефис</span>
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="gender"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пол</label>
                            <select id="gender"
                                    :class="formErrors.gender ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                    v-model="athlete.gender"
                                    @change="resetParticipation"
                                    @focusout='validateModel(athlete.gender, genderPattern, "gender")'
                            >
                                <option value="M">Мужской</option>
                                <option value="F">Женский</option>
                            </select>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.gender"><span class="font-medium">Выберите пол</span></p>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="birth_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата
                                рождения</label>
                            <input v-model="athlete.birth_date" type="date" name="birth_date" id="birth_date"
                                   :class="formErrors.birth_date ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @change="resetParticipation"
                                   @focusout="validateBirthDate()"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.birth_date"><span
                                class="font-medium">Укажите корректную дату рождения</span></p>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="qualifications"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Спортивный
                                разряд / звание</label>
                            <select id="qualifications"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="athlete.qualification">
                                <option v-for="qualification in qualifications" :value="qualification.code"
                                        :selected="qualification.code === 'NO'">
                                    {{ qualification.full_title }}
                                </option>
                            </select>
                        </div>

                        <div class="sm:col-span-5 p-0">
                            <label for="region"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Регион</label>
                            <vSelect
                                id="region"
                                :class="formErrors.region ? 'vue-select-tailwind vue-select-tailwind-deselect-hidden vue-select-tailwind-error'
                                    : 'vue-select-tailwind vue-select-tailwind-deselect-hidden'"
                                v-model="athlete.region_code"
                                :options="regions"
                                :reduce="region => region.code"
                                label="full_name"
                                @focusin="selectOnFocusIn()"
                                @focusout="selectOnFocusOut(regionSelectValidate)"
                            />
                            <!--todo сделать нормальные эвенты-->
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.region"><span
                                class="font-medium">Выберите регион из всплывающего списка</span></p>
                        </div>

                        <div class="sm:col-span-15">
                            <input id="wheelchair" type="checkbox" value=""
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                   v-model="athlete.using_chair"/>
                            <label for="wheelchair"
                                   class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300 select-none">Использую
                                стул / инвалидную коляску</label>
                        </div>
                    </div>
                </div>

                <div class="border-gray-300 dark:border-gray-600 rounded-2xl border px-5 py-5 mt-3">
                    <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white select-none">Участие
                                в соревнованиях:</label>
                            <template v-for="group in competition_copy.groups">
                                <div
                                    class="grid grid-cols-1 gap-x-6 gap-y-0 sm:grid-cols-2 items-center p-4 mt-2 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600"
                                    v-if="isGroupAvailable(group)">
                                    <div class="flex items-center col-span=1 sm:col-span-1">
                                        <input id="participation_{{group.id}}" type="checkbox" value=""
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                               v-model="group.participation"/>
                                        <label for="participation_{{group.id}}"
                                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">{{
                                                group.division.title
                                            }} {{ group.archery_class.title }}</label>
                                    </div>
                                    <div class="col-span-1 text-right">
                                        <p class="text-xs" v-if="group.min_birth_date !== null">Дата рождения: {{dayjs(group.min_birth_date).format("DD.MM.YYYY")}} - {{dayjs(group.max_birth_date).format("DD.MM.YYYY")}}</p>
                                        <p class="text-xs" v-if="group.min_birth_date === null">Дата рождения: от {{dayjs(group.max_birth_date).format("DD.MM.YYYY")}} и старше</p>
                                        <p class="text-xs" v-if="JSON.stringify(group.allowed_genders) !== JSON.stringify(group.archery_class.allowed_genders)">Пол: {{formatGenders(group.allowed_genders)}}</p>
                                    </div>
                                    <div class="row-span-1 sm:row-span-1 pl-5 mt-5"
                                         v-if="group.participation == true && (group.includes_teams == 1 || group.includes_mixed_teams == 1)">
                                        <div v-if="group.includes_teams == 1" class="flex items-center">
                                            <input id="participation_team_{{group.id}}" type="checkbox" value=""
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="group.participate_teams"/>
                                            <label for="participation_team_{{group.id}}"
                                                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Участвую
                                                в командных соревнованиях</label>
                                        </div>
                                        <div v-if="group.includes_mixed_teams == 1" class="flex items-center">
                                            <input id="participation_mixed_team_{{group.id}}" type="checkbox" value=""
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="group.participate_mixed_teams"/>
                                            <label for="participation_mixed_team_{{group.id}}"
                                                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Участвую
                                                в соревнованиях команд-микс</label>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="sm:col-span-1 -mt-2">
                            <label for="sport_school"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Спортивная
                                школа</label>
                            <vSelect
                                id="sport_school"
                                class="vue-select-tailwind"
                                v-model="athlete.sport_school_code"
                                :options="sport_schools"
                                :reduce="sport_school => sport_school.code"
                                label="full_title"
                                @focusin="selectOnFocusIn()"
                                @focusout="selectOnFocusOut()"
                            />
                        </div>

                        <div class="sm:col-span-1 -mt-2">
                            <label for="sport_organisation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Спортивный клуб
                                или
                                организация</label>
                            <vSelect
                                id="sport_school"
                                class="vue-select-tailwind"
                                v-model="athlete.sport_organisation_code"
                                :options="sport_organisations"
                                :reduce="sport_organisation => sport_organisation.code"
                                label="full_title"
                                @focusin="selectOnFocusIn()"
                                @focusout="selectOnFocusOut()"
                            />
                        </div>

                        <div class="sm:col-span-1 -mt-4">
                            <label for="contact_info"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Контактная
                                информация</label>
                            <input type="text" v-model="athlete.contact_information" name="contact_info"
                                   id="contact_info"
                                   :class="formErrors.contact_information ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="validateModel(athlete.contact_information, requiredTextPattern, 'contact_information')"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.contact_information"><span
                                class="font-medium">Укажите, как можно с вами связаться</span></p>
                        </div>
                        <div class="sm:col-span-1 -mt-4">
                            <label for="coach_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Тренер</label>
                            <input type="text" v-model="athlete.coach_name" name="coach_name" id="coach_name"
                                   :class="formErrors.coach_name ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="validateModel(athlete.coach_name, optionalTextPattern, 'coach_name')"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.coach_name"><span
                                class="font-medium">Укажите вашего тренера или оставьте поле пустым</span></p>
                        </div>
                    </div>
                </div>
                <button type="button"
                        class="inline-flex items-center px-5 py-2.5 mt-10 sm:mt-10 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600 mr-1"
                        @click.prevent="onClear">
                    Очистить
                </button>

                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-10 sm:mt-10 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Сохранить
                </button>

            </form>
        </div>
    </section>
</template>

<script setup>
import {ref} from 'vue';
import axios from "axios";
import dayjs from 'dayjs';
import vSelect from 'vue-select';

const props = defineProps(['routeSave', "routeFindAthlete", "competition", "qualifications", "regions", "sport_schools", "sport_organisations"]);
const competition_copy = ref(props.competition);

const athlete = ref({
    athlete_id: '',
    competition_id: '',
    first_name: '',
    surname: '',
    patronymic: '',
    gender: '',
    birth_date: '',
    qualification: 'NO',
    region_code: null,
    sport_school_code: '',
    sport_organisation_code: '',
    contact_information: '',
    coach_name: '',
    using_chair: ''
});

const athletes = ref([]);
let athleteRequestsCache = {};

const errorMessages = {
    "ALREADY_EXISTS": "Данный спортсмен уже зарегистрирован на эти соревнования",
    "INVALID_GENDER_FOR_GROUP": "Пол спортсмена не соответствует требованиям выбранного дивизиона и класса",
    "INVALID_BIRTH_DATE_FOR_GROUP": "Дата рождения спортсмена не соответствует требованиям выбранного дивизиона и класса",
    "DIFFERENT_CLASSES_IN_SAME_COMPETITION": "Спортсмен не может участвовать в одном соревновании в разных классах"
}

const formErrors = ref({
    surname: false,
    first_name: false,
    patronymic: false,
    gender: false,
    birth_date: false,
    region: false,
    contact_information: false,
    coach_name: false
});
const globalErrors = ref([]);

const namePattern = /^[а-яА-Яa-zA-Z\-]{2,}$/;
const patronymicPattern = /^[а-яА-Яa-zA-Z\-]*$/;
const genderPattern = /^[MF]{1}$/;
const requiredTextPattern = /^[а-яА-Я\w\-«»!?:;()\[\]&#№%+ "'.,]{2,}$/;
const optionalTextPattern = /^[а-яА-Я\w\-«»!?:;()\[\]&#№%+ "'.,]*$/;

function formatGenders(genders) {
    return genders
        .map((gender) => gender === "M" ? "М" : "Ж")
        .reduce((converted, gender) => converted + (converted !== "" ? ", " : "") + gender, "");
}

function selectOnFocusIn() {
    $(event.target).parent().parent().addClass('outline-2');
}

function selectOnFocusOut(validator) {
    $(event.target).parent().parent().removeClass('outline-2');

    if (validator != null) {
        validator();
    }
}

function regionSelectValidate() {
    formErrors.value.region = athlete.value.region_code === null;
}

function searchAthlete(ignoreFormData = false) {
    if (!ignoreFormData && (athlete.value.surname.length > 0 || athlete.value.first_name.length > 0 || athlete.value.patronymic.length > 0)) {
        return;
    }

    if (athlete.value.surname.length > 2) {
        if (athlete.value.surname in athleteRequestsCache) {
            athletes.value = athleteRequestsCache[athlete.value.surname];
            return;
        }

        axios.get(props.routeFindAthlete, {
            params: {
                surname: athlete.value.surname,
                competition_id: props.competition.id
            }
        }).then((response) => {
            athletes.value = response.data.athletes;
            athleteRequestsCache[athlete.value.surname] = response.data.athletes;
        })
    }
}

function isGroupAvailable(group) {
    const isAthleteGenderKnown = athlete.value.gender != '';
    const atLeastOneGroupSelected = competition_copy.value.groups.some(c_group => c_group.participation);
    const isAthleteBirthdayKnown = athlete.value.birth_date != '';

    //если пол спортсмена еще неизвестен - не фильтруем по полу
    const genderCriteriaMet = !isAthleteGenderKnown || group.allowed_genders.includes(athlete.value.gender);

    //проверим классы всех групп, где уже заявлено участие - спортсмен может участвовать только в одном классе
    const sameClassCriteriaMet = !atLeastOneGroupSelected ||
        competition_copy.value.groups.some(c_group => c_group.participation && c_group.class_code == group.class_code);

    //дата рождения спортсмена должна попадать между минимальной (если определена) и максимальной датой рождения, определенной для группы
    const birthDateCriteriaMet = !isAthleteBirthdayKnown ||
        (group.min_birth_date != null && dayjs(athlete.value.birth_date).diff(dayjs(group.min_birth_date)) <= 0 &&
            (dayjs(athlete.value.birth_date).diff(dayjs(group.max_birth_date)) >= 0));

    return genderCriteriaMet && sameClassCriteriaMet && birthDateCriteriaMet;
}

function resetParticipation() {
    competition_copy.value.groups.forEach(group => group.participation = false);
}

function resetFormErrors() {
    formErrors.value = {
        surname: false,
        first_name: false,
        patronymic: false,
        gender: false,
        birth_date: false,
        region: false,
        contact_information: false,
        coach_name: false
    }
    globalErrors.value = [];
}

function validateModel(model, pattern, errorTarget) {
    formErrors.value[errorTarget] = !pattern.test(model);
}

function validateBirthDate() {
    formErrors.value.birth_date = !dayjs(athlete.value.birth_date, 'YYYY-MM-DD', true).isValid() ||
        dayjs(athlete.value.birth_date).isAfter(dayjs());
}

function onSubmit() {
    resetFormErrors();

    formErrors.value.surname = !namePattern.test(athlete.value.surname);
    formErrors.value.first_name = !namePattern.test(athlete.value.first_name);
    formErrors.value.patronymic = !patronymicPattern.test(athlete.value.patronymic);
    formErrors.value.gender = !genderPattern.test(athlete.value.gender);
    validateBirthDate();
    regionSelectValidate();
    formErrors.value.contact_information = !requiredTextPattern.test(athlete.value.contact_information);
    formErrors.value.coach_name = !optionalTextPattern.test(athlete.value.coach_name);

    athlete.value.competition_id = props.competition.id;

    if (Object.values(formErrors.value).every((value) => value === false) && (globalErrors.value.length === 0)) {
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
        }).then(response => {
            if (response.status === "ok") {
                athleteRequestsCache = {};
                alert('сохранено');
            }
        }).catch(e => {
            if (e.response && e.response.data && e.response.data.errors) {
                globalErrors.value = e.response.data.errors;
            } else {
                alert("Произошла ошибка при сохранении объекта");
                if (e.response) {
                    console.log(e.response);
                }
            }
        });
    }
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
        qualification: '',
        region: '',
        region_code: '',
        sport_school: '',
        sport_organisation: '',
        contact_information: '',
        coach_name: '',
        using_chair: false
    }
}

function fillForm(data) {
    athlete.value.athlete_id = data.id;
    athlete.value.first_name = data.first_name;
    athlete.value.surname = data.surname;
    athlete.value.patronymic = data.patronymic;
    athlete.value.gender = data.gender;
    athlete.value.birth_date = dayjs(data.birth_date).format("YYYY-MM-DD");
    athlete.value.region_code = data.region;
    athlete.value.qualification = data.qualification.code;
    athlete.value.using_chair = data.using_chair == 1;

    athletes.value = [];
    resetParticipation();
    resetFormErrors();
}

</script>

<template>
    <section class="bg-transparent" v-if="competitionRegistrationUrl === ''">
        <div class="px-4 mx-auto max-w-6xl">
            <form @submit.prevent="onSubmit" method="post" :action="routeCreate">
                <div class="p-3 mb-3 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2 rounded-2xl border border-gray-300 dark:border-gray-600">
                    <div class="col-span-1 sm:col-span-2">
                            <span class="text-xl font-bold text-gray-900 dark:text-white">Основные настройки соревнования:</span>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Название соревнований
                        </label>
                        <input type="text" v-model="competition.title" name="title" id="title"
                               :class="formErrors.title ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                               @focusout="validateCompetitionTitle()"
                        />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                           v-if="formErrors.title"><span
                            class="font-medium">Укажите корректное название соревнования</span></p>
                    </div>

                    <div class="col-span-1">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Начало
                            соревнований</label>
                        <div class="mt-2">
                            <input v-model="competition.start_date" type="date" name="start_date" id="start_date"
                                   :class="formErrors.start_date ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="onCompetitionStartDateChange()"/>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.start_date"><span
                                class="font-medium">Укажите дату в будущем</span></p>
                        </div>

                        <div id="group_min_max_dates_recalculated_popover" role="tooltip"
                             class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div
                                class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-green-500">Внимание</h3>
                            </div>
                            <div class="px-3 py-2">
                                <p class="text-justify">Допустимые даты рождения и пол спортсменов были пересчитаны для
                                    всех групп соревнования.
                                    Пожалуйста, проверьте их перед сохранением.</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Окончание
                            соревнований</label>
                        <div class="mt-2">
                            <input v-model="competition.end_date" type="date" name="end_date" id="end_date"
                                   :class="formErrors.end_date ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="onCompetitionEndDateChange()"
                            />
                        </div>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                           v-if="formErrors.end_date"><span
                            class="font-medium">Укажите дату не раньше даты начала соревнования</span></p>
                    </div>

                    <div class="col-span-1">
                        <label for="registration_start"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Регистрация
                            начинается</label>
                        <div class="mt-2">
                            <input v-model="competition.registration_start" type="datetime-local"
                                   name="registration_start" id="registration_start"
                                   :class="formErrors.registration_start.length > 0 ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="onCompetitionRegistrationStartChange(true)"
                            />
                        </div>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                           v-for="errorMessage in formErrors.registration_start"><span
                            class="font-medium">{{ errorMessage }}</span></p>
                    </div>
                    <div class="col-span-1">
                        <label for="registration_finish"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Регистрация
                            заканчивается</label>
                        <div class="mt-2">
                            <input v-model="competition.registration_finish" type="datetime-local"
                                   name="registration_finish" id="registration_finish"
                                   :class="formErrors.registration_finish.length > 0 ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="onCompetitionRegistrationFinishChange(true)"
                            />
                        </div>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                           v-for="errorMessage in formErrors.registration_finish"><span
                            class="font-medium">{{ errorMessage }}</span></p>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                           v-if="formErrors.registration_finish"><span
                            class="font-medium"></span>
                        </p>
                    </div>
                    <div class="col-span-1 sm:col-span-2">
                        <input id="competition_includes_mixed_team_events" type="checkbox"
                               v-model="competition.includes_mixed_team_events"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        >
                        <label for="competition_includes_mixed_team_events"
                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">На соревновании будут
                            команды-микс</label>
                    </div>
                </div>
                <div class="p-3 mb-3 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2 rounded-2xl border border-gray-300 dark:border-gray-600">
                    <div class="col-span-1 sm:col-span-2">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">В соревновании могут участвовать:</span>
                    </div>
                    <div
                        class="border-gray-300 dark:border-gray-600 rounded-2xl border px-5 py-4 col-span-1 sm:col-span-2"
                        v-for="group in competition.groups" :key="group.id">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                            <div class="col-span-1 sm:col-span-3">
                                <label for="division"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дивизион</label>
                                <vSelect
                                    :id="`division_${group.id}`"
                                    :class="formErrors.division[group.id] ? 'vue-select-tailwind vue-select-tailwind-deselect-hidden vue-select-tailwind-error'
                                           : 'vue-select-tailwind vue-select-tailwind-deselect-hidden'"
                                    v-model="group.division_code"
                                    :options="enrichedDivisions"
                                    :reduce="division => division.code"
                                    @search:blur="validateDivision(group)"
                                />
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                                   v-if="formErrors.division[group.id]"><span
                                    class="font-medium">Выберите дивизион</span></p>
                            </div>
                            <div class="col-span-1 sm:col-span-3">
                                <label for="archery_class"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Класс</label>
                                <vSelect
                                    :id="`archery_class_${group.id}`"
                                    :class="formErrors.archery_class[group.id] ? 'vue-select-tailwind vue-select-tailwind-deselect-hidden vue-select-tailwind-error'
                                           : 'vue-select-tailwind vue-select-tailwind-deselect-hidden'"
                                    v-model="group.class_code"
                                    :options="enrichedClasses"
                                    :reduce="archery_class => archery_class.code"
                                    @option:selected="recalculateAgeAndGenderLimits(group, 'archery_class_' + group.id)"
                                    @search:blur="validateArcheryClass(group)"
                                />
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                                   v-if="formErrors.archery_class[group.id]"><span
                                    class="font-medium">Выберите класс</span></p>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <label for="max_birth_date"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата
                                    рождения спортсмена, от</label>
                                <input v-model="group.min_birth_date" type="date" name="min_birth_date"
                                       id="min_birth_date"
                                       :class="Array.isArray(formErrors.min_birth_date[group.id]) && formErrors.min_birth_date[group.id].length > 0 ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                       @focusout="validateMinBirthDate(group)"
                                />
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                                   v-for="errorMessage in formErrors.min_birth_date[group.id]"><span
                                    class="font-medium">{{ errorMessage }}</span></p>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <label for="min_birth_date"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата
                                    рождения спортсмена, до</label>
                                <input v-model="group.max_birth_date" type="date" name="max_birth_date"
                                       id="max_birth_date"
                                       :class="Array.isArray(formErrors.max_birth_date[group.id]) && formErrors.max_birth_date[group.id].length > 0 ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                       @focusout="validateMaxBirthDate(group)"
                                />
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                                   v-for="errorMessage in formErrors.max_birth_date[group.id]"><span
                                    class="font-medium">{{ errorMessage }}</span></p>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <label for="allowed_genders"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Разрешённый
                                    пол спортсмена</label>
                                <vSelect
                                    multiple
                                    id="allowed_genders"
                                    :class="formErrors.allowed_genders[group.id] ? 'vue-select-tailwind vue-select-tailwind-error'
                                           : 'vue-select-tailwind'"
                                    v-model="group.allowed_genders"
                                    :options="[{label: 'Мужской', code: 'M'}, {label: 'Женский', code: 'F'}]"
                                    :reduce="option => option.code"
                                    @focusout="validateAllowedGenders(group)"
                                    @option:deselected="validateAllowedGenders(group)"
                                />
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                                   v-if="formErrors.allowed_genders[group.id]"><span
                                    class="font-medium">Укажите пол допущенных спортсменов</span></p>
                            </div>
                            <div class="col-span-1 sm:col-span-3 flex items-center-safe">
                                <input id="teams" type="checkbox" v-model="group.includes_teams"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                />
                                <label for="teams"
                                       class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">В этой
                                    группе будут команды</label>
                            </div>
                            <div class="col-span-1 text-2xl sm:col-span-3 text-right -mt-2"><a
                                class="cursor-pointer"
                                @click="competition.groups = competition.groups.filter((v) => v !== group)">❌</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 sm:col-span-2 -mt-2">
                        <button type="button"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600"
                                @click="competition.groups.push({ id: -1 * Math.floor(Math.random() * 100000)})">
                            Добавить группу
                        </button>
                    </div>
                </div>
                <div class="p-3 mb-3 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2 rounded-2xl border border-gray-300 dark:border-gray-600">
                    <div class="col-span-1 sm:col-span-2">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Дополнительные настройки соревнования:</span>
                    </div>
                    <div class="col-span-1 p-2 rounded-sm border border-gray-300 dark:border-gray-600">
                        <input id="participants_list_available_to_anyone" type="checkbox" checked
                               v-model="competition.participants_list_available_to_anyone"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        >
                        <label for="participants_list_available_to_anyone"
                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Список участников
                            соревнования доступен всем</label>
                    </div>
                    <div class="col-span-1 p-2 rounded-sm border border-gray-300 dark:border-gray-600">
                        <input id="allow_countries" type="checkbox"
                               v-model="competition.allow_countries"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        >
                        <label for="allow_countries"
                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Разрешить выбирать страны в качестве регионов участников</label>
                    </div>
                    <div class="col-span-1 p-2 rounded-sm border border-gray-300 dark:border-gray-600 items-center content-center">
                        <div class="flex items-center mb-4">
                            <input v-model="competition.allow_input_school_and_club" id="sport_school_select" type="radio" value="false" name="allow_input_sport_school_and_club" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="sport_school_select" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Спортивная школа, клуб и организация выбираются из двух списков</label>
                        </div>
                        <div class="flex items-center">
                            <input v-model="competition.allow_input_school_and_club" id="sport_school_input" type="radio" value="true" name="allow_input_sport_school_and_club" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="sport_school_input" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Спортивная школа, клуб и организация вводятся вручную в одно поле</label>
                        </div>
                    </div>
                    <div class="col-span-1 p-2 rounded-sm border border-gray-300 dark:border-gray-600">
                        <label for="ui_language"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Язык формы
                            регистрации и списка участников</label>
                        <select id="ui_language"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                v-model="competition.ui_language">
                            <option value="ru">Русский</option>
                            <option value="en">Английский</option>
                        </select>
                    </div>

                </div>

                <button type="button"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600 mr-1"
                        @click.prevent="onClear">
                    Очистить
                </button>

                <button type="submit"
                        :class="validationSuccessful() ? 'inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800'
                        : 'text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center'"
                        :disabled="!validationSuccessful()"
                >
                    Сохранить
                </button>
            </form>
        </div>
    </section>
    <section v-if="competitionRegistrationUrl !== ''">
        <p class="block text-2xl mt-0 ml-2 font-medium text-gray-900 dark:text-white">Соревнование успешно
            добавлено.</p>
        <p class="block text-xl ml-2 font-medium text-gray-900 dark:text-white">Ссылка для регистрации на соревнования:
            <a class="hover:underline text-blue-600" :href="competitionRegistrationUrl">{{
                    competitionRegistrationUrl
                }}</a></p>
    </section>
</template>
<script setup>
import {computed, ref} from "vue";
import axios from "axios";
import dayjs from 'dayjs';
import {Popover} from "flowbite";
import vSelect from 'vue-select';
import {trans} from "laravel-vue-i18n";

const requiredTextPattern = /^[а-яА-ЯёË\w\-«»!?:;()\[\]&#№%+ "'.,]{2,}$/;

const props = defineProps(["routeCreate", "routeRegistration", "divisions", "archery_classes"]);

const enrichedDivisions = computed(() => props.divisions.map(division => {
    division.label = trans("divisions." + division.code);
    return division;
}));
const enrichedClasses = computed(() => props.archery_classes.map(archeryClass => {
    archeryClass.label = trans("classes." + archeryClass.code);
    return archeryClass;
}));

const competition = ref({
    title: '',
    start_date: '',
    end_date: '',
    registration_start: '',
    registration_finish: '',
    participants_list_available_to_anyone: true,
    includes_mixed_team_events: false,
    allow_countries: false,
    allow_input_school_and_club: false,
    ui_language: "ru",
    groups: []
});

const competitionRegistrationUrl = ref("");

const formErrors = ref({});
resetFormErrors();

function onCompetitionRegistrationStartChange(revalidateRegistrationFinish = false) {
    //валидный момент времени и раньше даты начала соревнования, если дата начала указана
    formErrors.value.registration_start = [];
    const beforeCompetitionStartError = "Начало регистрации должно быть раньше начала соревнования";
    const beforeRegistrationFinishError = "Начало регистрации должно быть раньше окончания регистрации";

    //момент времени должен парситься
    if (competition.value.registration_start != "") {
        if (dayjs(competition.value.registration_start, 'YYYY-MM-DDTHH:mm', true).isValid()) {
            //если указана дата начала соревнования - мы должны начинать регистрацию до начала соревнования
            if (dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid() &&
                !dayjs(competition.value.registration_start).isBefore(dayjs(competition.value.start_date))) {
                formErrors.value.registration_start.push(beforeCompetitionStartError);
            }

            //если указан момент окончания регистрации - момент начала должен быть до момента окончания
            if (dayjs(competition.value.registration_finish, 'YYYY-MM-DDTHH:mm', true).isValid() &&
                !dayjs(competition.value.registration_start).isBefore(dayjs(competition.value.registration_finish))) {
                formErrors.value.registration_start.push(beforeRegistrationFinishError);
            }
        } else {
            formErrors.value.registration_start.push(beforeCompetitionStartError);
        }
    }

    if (revalidateRegistrationFinish) {
        onCompetitionRegistrationFinishChange(false);
    }
}

function onCompetitionRegistrationFinishChange(revalidateRegistrationStart = false) {
    formErrors.value.registration_finish = ref([]);
    const beforeCompetitionStartError = "Окончание регистрации должно быть раньше начала соревнования";
    const beforeRegistrationFinishError = "Окончание регистрации должно быть позже начала регистрации"

    //момент времени должен парситься
    if (competition.value.registration_finish != "") {
        if (dayjs(competition.value.registration_finish, 'YYYY-MM-DDTHH:mm', true).isValid()) {
            //если указана дата начала соревнования - мы должны начинать регистрацию до начала соревнования
            if (dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid() &&
                !dayjs(competition.value.registration_finish).isBefore(dayjs(competition.value.start_date))) {
                formErrors.value.registration_finish.push(beforeCompetitionStartError);
            }

            //если указан момент окончания регистрации - момент начала должен быть до момента окончания
            if (dayjs(competition.value.registration_start, 'YYYY-MM-DDTHH:mm', true).isValid() &&
                !dayjs(competition.value.registration_start).isBefore(dayjs(competition.value.registration_finish))) {
                formErrors.value.registration_finish.push(beforeRegistrationFinishError);
            }
        } else {
            formErrors.value.registration_finish.push(beforeCompetitionStartError);
        }
    }

    if (revalidateRegistrationStart) {
        onCompetitionRegistrationStartChange(false);
    }
}

function validateCompetitionStartDate() {
    formErrors.value.start_date = !dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid() ||
        dayjs(competition.value.start_date).isBefore(dayjs());
}

function onCompetitionStartDateChange() {
    validateCompetitionStartDate();

    if (formErrors.value.start_date === false) {
        //если дата начала валидна - нужно провалидировать дату начала и конца регистрации
        onCompetitionRegistrationStartChange();
        onCompetitionRegistrationFinishChange();
        toggleDatesRecalculatedPopup('start_date');
    }
}

function onCompetitionEndDateChange() {
    //дата должна быть валидной и не быть раньше даты начала, если дата начала указана
    formErrors.value.end_date = !dayjs(competition.value.end_date, 'YYYY-MM-DD', true).isValid() ||
        (dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid() &&
            dayjs(competition.value.end_date).isBefore(dayjs(competition.value.start_date)));
}

function validateMinBirthDate(group) {
    //если указана валидная дата начала соревнования, сравнивать будем с ней, иначе - с текущей датой
    const validDateInThePast = (competition.value.start_date != "" && dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid())
        ? "Укажите корректную дату, не превышающую дату начала соревнования, или оставьте поле пустым"
        : "Укажите корректную дату в прошлом или оставьте поле пустым";
    const lessThanMaxBirthDate = "Укажите дату, предшествующую максимальной дате рождения";
    const dateToCompareWith = (competition.value.start_date != "" && dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid())
        ? dayjs(competition.value.start_date)
        : dayjs();

    formErrors.value.min_birth_date[group.id] = [];

    //дата может быть не указана
    if (group.min_birth_date) {
        //если указана, она должна быть валидной и быть не позже даты начала соревнования, или в прошлом
        if (dayjs(group.min_birth_date, 'YYYY-MM-DD', true).isValid() && !dayjs(group.min_birth_date).isAfter(dateToCompareWith)) {
            //если указана, валидная и в прошлом - она должна быть меньше или равна максимальной даты рождения, если та указана
            if (dayjs(group.max_birth_date, 'YYYY-MM-DD', true).isValid()) {
                if (!dayjs(group.min_birth_date).isBefore(dayjs(group.max_birth_date))) {
                    formErrors.value.min_birth_date[group.id].push(lessThanMaxBirthDate);
                }
            }
        } else {
            formErrors.value.min_birth_date[group.id].push(validDateInThePast);
        }
    }
}

function validateMaxBirthDate(group) {
    //если указана валидная дата начала соревнования, сравнивать будем с ней, иначе - с текущей датой
    const validDateInThePast = (competition.value.start_date != "" && dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid())
        ? "Укажите корректную дату, не превышающую дату начала соревнования, или оставьте поле пустым"
        : "Укажите корректную дату в прошлом или оставьте поле пустым";
    const greaterThanMinBirthDate = "Укажите дату, превышающую минимальную дату рождения";
    const dateToCompareWith = (competition.value.start_date != "" && dayjs(competition.value.start_date, 'YYYY-MM-DD', true).isValid())
        ? dayjs(competition.value.start_date)
        : dayjs();

    formErrors.value.max_birth_date[group.id] = [];

    //если указана, она должна быть валидной и быть не позже даты начала соревнования, или в прошлом
    if (dayjs(group.max_birth_date, 'YYYY-MM-DD', true).isValid() && !dayjs(group.max_birth_date).isAfter(dateToCompareWith)) {
        //если указана, валидная и в прошлом - она должна быть меньше или равна максимальной даты рождения, если та указана
        if (dayjs(group.min_birth_date, 'YYYY-MM-DD', true).isValid()) {
            if (!dayjs(group.min_birth_date).isBefore(dayjs(group.max_birth_date))) {
                formErrors.value.max_birth_date[group.id].push(greaterThanMinBirthDate);
            }
        }
    } else {
        formErrors.value.max_birth_date[group.id].push(validDateInThePast);
    }
}

function toggleDatesRecalculatedPopup(triggerId) {
    if (competition.value.groups.length > 0) {
        competition.value.groups.forEach((group) => recalculateAgeAndGenderLimits(group));

        const targetElement = document.getElementById("group_min_max_dates_recalculated_popover");
        const triggerElement = document.getElementById(triggerId);
        const popover = new Popover(targetElement, triggerElement, {triggerType: "none"});
        popover.show();
    }
}

function recalculateAgeAndGenderLimits(group, targetId = null) {
    if (group.class_code !== "") {
        const fullClass = props.archery_classes.find(c => c.code === group.class_code);
        if (fullClass) {
            group.allowed_genders = fullClass.allowed_genders;
            if (competition.value.start_date !== "") {
                group.max_birth_date = dayjs(competition.value.start_date).subtract(fullClass.min_age, "year").format("YYYY-MM-DD");
                if (Number.isInteger(fullClass.max_age)) {
                    group.min_birth_date = dayjs(competition.value.start_date).subtract(fullClass.max_age, "year")
                        .date(1).month(0).format("YYYY-MM-DD");
                } else {
                    group.min_birth_date = null;
                }
            }
        }
    }
    validateMinBirthDate(group);
    validateMaxBirthDate(group);
    validateAllowedGenders(group);

    if (targetId !== null) {
        toggleDatesRecalculatedPopup(targetId);
    }
}

function validateCompetitionTitle() {
    formErrors.value.title = !requiredTextPattern.test(competition.value.title);
}

function validateDivision(group) {
    formErrors.value.division[group.id] = (group.division_code == null);
}

function validateArcheryClass(group) {
    formErrors.value.archery_class[group.id] = (group.class_code == null);
}

function validateAllowedGenders(group) {
    formErrors.value.allowed_genders[group.id] = group.allowed_genders.length === 0;
}

function resetFormErrors() {
    formErrors.value = {
        title: false,
        start_date: false,
        end_date: false,
        registration_start: [],
        registration_finish: [],
        division: [],
        archery_class: [],
        min_birth_date: [],
        max_birth_date: [],
        allowed_genders: []
    };
}

function validationSuccessful() {
    return formErrors.value.title === false &&
        formErrors.value.start_date === false &&
        formErrors.value.end_date === false &&
        formErrors.value.registration_start.length === 0 &&
        formErrors.value.registration_finish.length === 0 &&
        formErrors.value.division.length === 0 &&
        formErrors.value.archery_class.length === 0 &&
        formErrors.value.min_birth_date.length === 0 &&
        formErrors.value.max_birth_date.length === 0 &&
        formErrors.value.allowed_genders.length === 0 &&
        competition.value.groups.length > 0;
}

function onSubmit() {
    resetFormErrors();
    validateCompetitionTitle();
    validateCompetitionStartDate();
    onCompetitionEndDateChange();
    onCompetitionRegistrationStartChange(true);
    onCompetitionRegistrationFinishChange(true);
    competition.value.groups.forEach((group) => {
        validateDivision(group);
        validateArcheryClass(group);
        validateMinBirthDate(group);
        validateMaxBirthDate(group);
        validateAllowedGenders(group);
    });

    if (validationSuccessful()) {
        if (competition.value.ui_language === "ru" || confirm("Вы выбрали язык формы регистрации и списка участников, отличный от русского. Вы уверены?")) {
            axios.post(props.routeCreate, {
                ...competition.value
            }).then(r => {
                competitionRegistrationUrl.value = props.routeRegistration.replace(':competition_id', r.data.competition_id);
            }).catch(e => {
                if (e.response && e.response.data && e.response.data.errors) {
                    this.errors = e.response.data.errors;
                } else {
                    alert("Произошла ошибка при сохранении объекта");
                }
            });
        }
    }
}

function onClear() {
    if (!confirm('Вы уверены, что хотите очистить данные формы?')) {
        return;
    }

    competition.value = {
        title: '',
        start_date: '',
        end_date: '',
        registration_start: '',
        registration_finish: '',
        participants_list_available_to_anyone: true,
        includes_mixed_team_events: false,
        allow_countries: false,
        ui_language: "ru",
        allow_input_school_and_club: false,
        groups: []
    }
}
</script>

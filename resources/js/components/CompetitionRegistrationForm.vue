<template>
    <div class="bg-white shadow-sm p-10">
        <form @submit.prevent="onSubmit" method="post" :action="routeSave">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Персональные данные</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Нам необходимо понять кто вы и что умеете.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="surname" class="block text-sm/6 font-medium text-gray-900">Фамилия</label>
                            <div class="mt-2">
                                <input type="text" v-model="athlete.surname" name="surname" id="surname"
                                       @input="searchAthlete()" autocomplete="family-name"
                                       data-popover-target="popover-found-athletes" data-popover-trigger="none"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
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
                                        <input v-model="athlete.gender" id="F" name="gender" type="radio" value="fe"
                                               class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                        <label for="F" class="block text-sm/6 font-medium text-gray-900">Женский</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input v-model="athlete.gender" id="M" name="gender" type="radio" value="ma"
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

                        <div class="sm:col-span-2">
                            <label for="birth_date" class="block text-sm/6 font-medium text-gray-900">Регион</label>
                            <div class="mt-2">
                                <input v-model="athlete.region" type="text" name="birth_date" id="birth_date"
                                       autocomplete="birthday"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                            <!--todo region component                        -->
                        </div>

                        <div class="sm:col-span-2">
                            <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дивизион</label>
                            <select v-model="athlete.division" id="division" name="division"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="division in divisions" value="{{ division.code}}">{{
                                        division.title
                                    }}
                                </option>
                            </select>
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
                                            <input v-model="privacy" id="privacy" aria-describedby="privacy-description"
                                                   name="privacy" type="checkbox" checked=""
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
                                        <label for="privacy" class="font-medium text-gray-900">Я даю своё согласие на
                                            обработку персональных данных</label>
                                        <p id="privacy-description" class="text-gray-500">Обработка производится в
                                            соответствии с нашей <a class="underline hover:text-indigo-600">политикой
                                                обработки обрабатывания данных обработки</a>.</p>
                                    </div>
                                </div>
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

    <div data-popover id="popover-found-athletes" role="tooltip" ref="popover"
         class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
            <h3 class="font-semibold text-gray-900 dark:text-white">Popover bottom</h3>
        </div>
        <div class="px-3 py-2">
            <p>And here's some amazing content. It's very engaging. Right?</p>
        </div>
        <a @click="closePopover()">Закрыть</a>
        <div data-popper-arrow></div>
    </div>
</template>

<script setup>
import {ref} from 'vue'
import Vue from 'vue'
import Athlete from '/resources/js/components/Athlete.vue'
import axios from "axios";
import {Popover} from "flowbite";

const props = defineProps(['routeSave', "routeFindAthlete", "competition", "divisions", "archery_classes"])

const athlete = ref({
    first_name: '',
    surname: '',
    patronymic: '',
    gender: '',
    birth_date: '',
    region_code: '',
    city: '',
    phone: '',
    advertisement: '',
});

const privacy = ref('');

function closePopover() {
    new Popover(document.getElementById('popover-found-athletes'), document.getElementById("surname"), {
        placement: "bottom"
    }).hide();
}

function searchAthlete() {
    if (athlete.value.surname.length > 2) {
        console.log(props.routeFindAthlete)
        axios.get(props.routeFindAthlete, {
            params: {
                surname: athlete.value.surname
            }
        }).then((response) => {
            var AthleteClass = Vue.extend(Athlete);

            // {
            //     propsData: {
            //         data: ref({
            //             surname: response.data.athletes[0].surname,
            //             first_name: response.data.athletes[0].first_name
            //         })
            //     }
            // }

            var athlete = new AthleteClass();
            athlete.$mount()
            this.$refs.popover.appendChild(athlete.$el)

            let popover = document.getElementById('popover-found-athletes');
            new Popover(popover, document.getElementById("surname"), {
                placement: "bottom"
            }).show();
            console.log(response);
        })
    }
}

function onSubmit() {
    if (privacy.value !== true) {
        alert('Примите политику перс данных')
        return;
    }

    axios.post(props.routeSave, {
        privacy: privacy.value,
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
        first_name: '',
        surname: '',
        patronymic: '',
        gender: '',
        birth_date: '',
        region_code: '',
        city: '',
        phone: '',
        advertisement: '',
    }
    privacy.value = '';
}
</script>

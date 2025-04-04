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
                            <input type="text" v-model="athlete.surname" name="surname" id="surname" autocomplete="family-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="first_name" class="block text-sm/6 font-medium text-gray-900">Имя</label>
                        <div class="mt-2">
                            <input type="text" v-model="athlete.first_name" name="first_name" id="first_name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="patronymic" class="block text-sm/6 font-medium text-gray-900">Отчество</label>
                        <div class="mt-2">
                            <input type="text" v-model="athlete.patronymic" name="patronymic" id="patronymic" autocomplete="additional-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <fieldset>
                            <legend class="text-sm/6 font-semibold text-gray-900">Пол персонажа</legend>
                            <div class="mt-2 space-y-0">
                                <div class="flex items-center gap-x-3">
                                    <input v-model="athlete.gender" id="female" name="gender" type="radio" value="fe" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                    <label for="female" class="block text-sm/6 font-medium text-gray-900">Женский</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input v-model="athlete.gender" id="male" name="gender" type="radio" value="ma" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                    <label for="male" class="block text-sm/6 font-medium text-gray-900">Мужской</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input v-model="athlete.gender" id="secret-prison" name="gender" type="radio" value="secret-prison" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                    <label for="secret-prison" class="block text-sm/6 font-medium text-gray-900">Не определился</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="birth_date" class="block text-sm/6 font-medium text-gray-900">Дата рождения</label>
                        <div class="mt-2">
                            <input v-model="athlete.birth_date" type="date" name="birth_date" id="birth_date" autocomplete="birthday" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="phone" class="block text-sm/6 font-medium text-gray-900">Номер телефона</label>
                        <div class="mt-2">
                            <input v-model="athlete.phone" id="phone" name="phone" type="phone" autocomplete="phone" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="iphone 11 pro max"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3 sm:col-start-1">
                        <label for="region" class="block text-sm/6 font-medium text-gray-900">Регион</label>
                        <div class="mt-2">
                            <input v-model="athlete.region_code" type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="city" class="block text-sm/6 font-medium text-gray-900">Город</label>
                        <div class="mt-2">
                            <input type="text" v-model="athlete.city" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Обработка персональных данных</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Мы обработаем все ваши данные исходя из нашей политики персональных данных</p>

                <div class="mt-2 space-y-10">
                    <fieldset>
                        <div class="mt-2 space-y-6">
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input v-model="privacy" id="privacy" aria-describedby="privacy-description" name="privacy" type="checkbox" checked="" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                            <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-sm/6">
                                    <label for="privacy" class="font-medium text-gray-900">Я даю своё согласие на обработку персональных данных</label>
                                    <p id="privacy-description" class="text-gray-500">Обработка производится в соответствии с нашей <a class="underline hover:text-indigo-600">политикой обработки обрабатывания данных обработки</a>.</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input v-model="athlete.advertisement" id="advertisement" aria-describedby="advertisement-description" name="advertisement" type="checkbox" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                            <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-sm/6">
                                    <label for="advertisement" class="font-medium text-gray-900">Я согласен на рассылку об акциях и рекламных предложениях</label>
                                    <p id="advertisement-description" class="text-gray-500">Рекламные уведомления будут рекламировать наши луки и табуретки.</p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900" @click.prevent="onClear">Очистить</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Сохранить</button>
        </div>
    </form>
</div>
</template>

<script setup>
import { ref } from 'vue'
import axios from "axios";

const props = defineProps(['routeSave'])

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

function onSubmit() {
    if (privacy.value !== true) {
        alert('Примите политику перс данных')
        return;
    }

    axios.post( props.routeSave, {
        privacy: privacy.value,
        ...athlete.value,
    }).then(r => {
        const data = r.data;
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

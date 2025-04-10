<template>
    <section class="bg-transparent">
        <div class="py-8 px-4 mx-auto max-w-6xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Добавление соревнования</h2>
            <form @submit.prevent="onSubmit" method="post" :action="routeCreate">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-10">
                    <div class="sm:col-span-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Название соревнований
                        </label>
                        <div class="mt-2">
                            <input type="text" v-model="competition.title" name="title" id="title"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Начало
                            соревнований</label>
                        <div class="mt-2">
                            <input v-model="competition.start_date" type="date" name="start_date" id="start_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Окончание
                            соревнований</label>
                        <div class="mt-2">
                            <input v-model="competition.end_date" type="date" name="end_date" id="end_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="registration_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Регистрация
                            начинается</label>
                        <div class="mt-2">
                            <input v-model="competition.registration_start" type="datetime-local"
                                   name="registration_start" id="registration_start"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="registration_finish" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Регистрация
                            заканчивается</label>
                        <div class="mt-2">
                            <input v-model="competition.registration_finish" type="datetime-local"
                                   name="registration_finish" id="registration_finish"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <h2 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">На соревновании будут:</h2>
                        <div class="flex gap-3">
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input v-model="competition.competition_includes_teams"
                                           id="competition_includes_teams" name="competition_includes_teams"
                                           type="checkbox" checked=""
                                           class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-1 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 forced-colors:appearance-auto dark:bg-gray-500 dark:border-gray-700"/>
                                    <svg
                                        class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                        viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="competition_includes_teams" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Команды</label>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input v-model="competition.competition_includes_mixed_teams"
                                           id="competition_includes_mixed_teams" name="competition_includes_mixed_teams"
                                           type="checkbox" checked=""
                                           class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-1 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 forced-colors:appearance-auto dark:bg-gray-500 dark:border-gray-700"/>
                                    <svg
                                        class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                        viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="competition_includes_mixed_teams" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Миксы</label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="border-b border-gray-900/10 pb-8 dark:border-gray-400/10">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">В соревновании могут участвовать:</h2>
                </div>

                <div class="border-b border-gray-900/10 pb-8 dark:border-gray-400/10">
                    <div class="flex gap-3">
                        <div class="flex h-6 shrink-0 items-center">
                            <div class="group grid size-4 grid-cols-1">
                                <input v-model="competition.participants_list_available_to_anyone"
                                       id="participants_list_available_to_anyone" name="participants_list_available_to_anyone"
                                       type="checkbox" checked=""
                                       class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-1 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 forced-colors:appearance-auto dark:bg-gray-500 dark:border-gray-700"/>
                                <svg
                                    class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                    viewBox="0 0 14 14" fill="none">
                                    <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm/6">
                            <label for="participants_list_available_to_anyone" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">
                                Список участников соревнования доступен всем
                            </label>
                        </div>
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
import {ref} from "vue";
import axios from "axios";

const props = defineProps(['routeCreate'])

const competition = ref({
    title: '',
    start_date: '',
    end_date: '',
    registration_start: '',
    registration_finish: '',
    competition_includes_teams: '',
    competition_includes_mixed_teams: '',
    participants_list_available_to_anyone: 'true',
});


function onSubmit() {
    axios.post( props.routeCreate, {
        ...competition.value
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
    if (!confirm('Вы уверены, что хотите очистить данные формы?')) {
        return;
    }

    competition.value = {
        title: '',
        start_date: '',
        end_date: '',
        registration_start: '',
        registration_finish: '',
        competition_includes_teams: '',
        competition_includes_mixed_teams: '',
        participants_list_available_to_anyone: '',
    }
}
</script>

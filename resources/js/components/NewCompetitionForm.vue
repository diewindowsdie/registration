<template>
    <div class="bg-white shadow-sm p-10">
        <form @submit.prevent="onSubmit" method="post" :action="routeCreate">
            <div class="space-y-6">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-10">

                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm/6 font-medium text-gray-900">Название
                                соревнований</label>
                            <div class="mt-2">
                                <input type="text" v-model="competition.title" name="title" id="title"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="start_date" class="block text-sm/6 font-medium text-gray-900">Начало
                                соревнований</label>
                            <div class="mt-2">
                                <input v-model="competition.start_date" type="date" name="start_date" id="start_date"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="end_date" class="block text-sm/6 font-medium text-gray-900">Окончание
                                соревнований</label>
                            <div class="mt-2">
                                <input v-model="competition.end_date" type="date" name="end_date" id="end_date"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="registration_start" class="block text-sm/6 font-medium text-gray-900">Регистрация
                                начинается</label>
                            <div class="mt-2">
                                <input v-model="competition.registration_start" type="datetime-local"
                                       name="registration_start" id="registration_start"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="registration_finish" class="block text-sm/6 font-medium text-gray-900">Регистрация
                                заканчивается</label>
                            <div class="mt-2">
                                <input v-model="competition.registration_finish" type="datetime-local"
                                       name="registration_finish" id="registration_finish"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <h2 class="block text-sm/6 font-medium text-gray-900">На соревновании будут:</h2>
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input v-model="competition.competition_includes_teams"
                                               id="competition_includes_teams" name="competition_includes_teams"
                                               type="checkbox" checked=""
                                               class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"/>
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
                                    <label for="competition_includes_teams" class="text-gray-900">Команды</label>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input v-model="competition.competition_includes_mixed_teams"
                                               id="competition_includes_mixed_teams" name="competition_includes_mixed_teams"
                                               type="checkbox" checked=""
                                               class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"/>
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
                                    <label for="competition_includes_mixed_teams" class="text-gray-900">Миксы</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-8">
                    <h2 class="text-base/7 font-semibold text-gray-900">В соревновании могут участвовать:</h2>

                </div>

                <div class="border-b border-gray-900/10 pb-8">
                    <div class="flex gap-3">
                        <div class="flex h-6 shrink-0 items-center">
                            <div class="group grid size-4 grid-cols-1">
                                <input v-model="competition.participants_list_available_to_anyone"
                                       id="participants_list_available_to_anyone" name="participants_list_available_to_anyone"
                                       type="checkbox" checked=""
                                       class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"/>
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
                            <label for="participants_list_available_to_anyone" class="text-gray-900">Список участников соревнования доступен всем</label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900" @click.prevent="onClear">
                        Очистить
                    </button>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
    </div>
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

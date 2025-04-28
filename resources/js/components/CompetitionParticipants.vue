<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-3">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!--группа-->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mb-5"
                 v-for="group in competition.groups">
                <div class="flex flex-col items-center space-y-3 p-4 text-2xl font-bold text-black dark:text-white bg-gray-300 dark:bg-gray-800">
                    {{ group.division.title }} {{ group.archery_class.title }}</div>
                <!--сама таблица-->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Спортсмен</th>
                            <th scope="col" class="px-4 py-3 hidden sm:table-cell">Дата&nbsp;рождения</th>
                            <th scope="col" class="px-4 py-3 hidden sm:table-cell">Регион</th>
                            <th scope="col" class="px-4 py-3 hidden sm:table-cell">Разряд / звание</th>
                            <th scope="col" class="px-4 py-3 hidden sm:table-cell">Спортивная школа</th>
                            <th scope="col" class="px-4 py-3 hidden sm:table-cell">Клуб / организация</th>
                            <th scope="col" class="px-4 py-3 table-cell sm:hidden"/>
                        </tr>
                        </thead>
                        <tbody data-accordion="open" data-active-classes="text-black dark:text-white bg-white dark:bg-gray-800" data-inactive-classes="text-gray-600 dark:text-gray-400">
                            <template v-for="participant in participants.filter(candidate => candidate.athlete !== null && candidate.division_code === group.division_code && candidate.class_code === group.class_code)">
                                <tr class="border-t dark:border-gray-700" >
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{participant.athlete.surname}}&nbsp;{{participant.athlete.first_name}}{{participant.athlete.first_name !== null ? " " + participant.athlete.first_name : ""}}</th>
                                    <td class="px-4 py-3 hidden sm:table-cell">{{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}</td>
                                    <td class="px-4 py-3 hidden sm:table-cell">{{ participant.athlete.region.full_name }}</td>
                                    <td class="px-4 py-3 hidden sm:table-cell">{{ participant.athlete.qualification.short_title }}</td>
                                    <td class="px-4 py-3 hidden sm:table-cell">{{ participant.sport_school !== null ? participant.sport_school.full_title : ""}}</td>
                                    <td class="px-4 py-3 hidden sm:table-cell">{{ participant.sport_organisation !== null ? participant.sport_organisation.full_title : "" }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end sm:hidden"> <!--скрываем этот столбец начиная с размера sm-->
                                        <button :id="'dropdown-button-' + participant.id" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button"
                                                aria-expanded="false"
                                                :aria-controls="'dropdown-participant-' + participant.id"
                                                :data-accordion-target="'#dropdown-participant-' + participant.id"
                                        >
                                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 5 5 1 1 5"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-t dark:border-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <td colspan="7" :id="'dropdown-participant-' + participant.id" class="hidden">
                                        <div class="text-left mx-6 my-0.5 p-3">
                                            <p><b>Дата рождения:</b> {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}</p>
                                            <p><b>Регион:</b> {{ participant.athlete.region.full_name }}</p>
                                            <p><b>Разряд/звание:</b> {{ participant.athlete.qualification.short_title }}</p>
                                            <p><b>Спортивная школа:</b> {{ participant.sport_school !== null ? participant.sport_school.full_title : ""}}</p>
                                            <p><b>Клуб/организация:</b> {{ participant.sport_organisation !== null ? participant.sport_organisation.full_title : "" }}</p>


                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import dayjs from 'dayjs';

const props = defineProps(["competition", "participants"]);
</script>

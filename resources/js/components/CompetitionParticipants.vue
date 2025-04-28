<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-3">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!--группа-->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mb-5"
                 v-for="group in competition.groups">
                <div
                    class="flex flex-col items-center space-y-3 p-4 text-2xl font-bold text-black dark:text-white bg-gray-300 dark:bg-gray-800">
                    {{ group.division.title }} {{ group.archery_class.title }}
                </div>
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
                            <th scope="col" class="px-4 py-3 hidden sm:table-cell">Дата и время регистрации</th>
                            <th scope="col" class="px-4 py-3 table-cell sm:hidden"/>
                        </tr>
                        </thead>
                        <tbody data-accordion="open"
                               data-active-classes="text-black dark:text-white bg-white dark:bg-gray-800"
                               data-inactive-classes="text-gray-600 dark:text-gray-400">
                        <template
                            v-for="participant in participants.filter(candidate => candidate.athlete !== null && candidate.division_code === group.division_code && candidate.class_code === group.class_code)">
                            <tr class="border-t dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ participant.athlete.surname }}&nbsp;{{ participant.athlete.first_name }}{{ participant.athlete.patronymic !== null ? " " + participant.athlete.patronymic : "" }}
                                </th>
                                <td class="px-4 py-3 hidden sm:table-cell">
                                    {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell">{{
                                        participant.athlete.region.full_name
                                    }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell">
                                    {{ participant.athlete.qualification.short_title }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell">
                                    {{ participant.sport_school !== null ? participant.sport_school.full_title : "" }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell">{{
                                        participant.sport_organisation !== null ? participant.sport_organisation.full_title : ""
                                    }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell">
                                    {{ dayjs(participant.created_at).format("DD.MM.YYYY HH:mm:ss") }}
                                </td>
                                <td class="px-4 py-3 flex items-center justify-end sm:hidden">
                                    <!--скрываем этот столбец начиная с размера sm-->
                                    <button :id="'dropdown-button-' + participant.id"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button"
                                            aria-expanded="false"
                                            :aria-controls="'dropdown-participant-' + participant.id"
                                            :data-accordion-target="'#dropdown-participant-' + participant.id"
                                    >
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 5 5 1 1 5"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t dark:border-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                <td colspan="8" :id="'dropdown-participant-' + participant.id" class="hidden">
                                    <div class="text-left mx-6 my-0.5 p-3">
                                        <p><b>Дата рождения:</b>
                                            {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}</p>
                                        <p><b>Регион:</b> {{ participant.athlete.region.full_name }}</p>
                                        <p><b>Разряд/звание:</b> {{ participant.athlete.qualification.short_title }}</p>
                                        <p v-if="participant.sport_school !== null"><b>Спортивная школа:</b>
                                            {{ participant.sport_school.full_title }}</p>
                                        <p v-if="participant.sport_organisation !== null"><b>Клуб/организация:</b>
                                            {{ participant.sport_organisation.full_title }}</p>
                                        <p><b>Дата и время регистрации:</b>
                                            {{ dayjs(participant.created_at).format("DD.MM.YYYY HH:mm:ss") }}</p>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <button v-if="isSecretary" type="button" id="exportViaClipboard"
                    class="inline-flex items-center px-5 py-2.5 mb-3 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                Экспорт в IANSEO (буфер обмена)
            </button>
            <button v-if="isSecretary" type="button" data-tooltip-target="copied-tooltip" data-tooltip-trigger="none"
                    @click="ianseoExportToFile(participants)"
                    class="inline-flex items-center px-5 py-2.5 mb-3 ml-3 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                Экспорт в IANSEO (файл)
            </button>
            <div id="copied-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                Скопировано
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </section>
</template>
<script setup>
import dayjs from 'dayjs';
import ClipboardJS from "clipboard";
import {Popover, Tooltip} from 'flowbite';
import {ianseoExportToFile, ianseoData} from "../ianseoExport.js";

const props = defineProps(["competition", "participants", "isSecretary"]);
// console.log(ClipboardJS.isSupported());

const clipboard = new ClipboardJS('#exportViaClipboard', {
    text: function() {
        return ianseoData(props.participants);
    }
});
clipboard.on('success', function(e) {
    const targetElement = document.getElementById('copied-tooltip');
    const triggerElement = document.getElementById('exportViaClipboard');
    const tooltip = new Tooltip(targetElement, triggerElement, {triggerType: "none", placement: "bottom"});
    tooltip.show();
    setTimeout(function() {
        tooltip.hide();
    }, 2000);
    e.clearSelection();
});

</script>

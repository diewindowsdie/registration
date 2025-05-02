<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-3">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <h2 class="mb-4 py-2 text-3xl font-bold text-gray-900 dark:text-white">{{ competition.title }}, <br
                class="sm:hidden block"/>{{ dayjs(competition.start_date).format("DD.MM.YYYY") }} -
                {{ dayjs(competition.end_date).format("DD.MM.YYYY") }}</h2>
            <!--группа-->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mb-5"
                 v-for="group in competition.groups">
                <div
                    class="flex flex-col items-center space-y-3 p-4 text-2xl font-bold text-black dark:text-white bg-gray-300 dark:bg-gray-800">
                    <span class="absolute top-10 left-1.5 text-sm">
                        Всего участников: {{ sortedParticipants(group.division_code, group.class_code).length }}
                    </span>
                    <span>{{ group.division.title }} {{ group.archery_class.title }}</span>
                </div>
                <!--сама таблица-->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 ">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 hover:cursor-pointer select-none w-[2.5%] hidden sm:table-cell"
                                v-if="isSecretary"></th>
                            <th scope="col" class="px-4 py-3 hover:cursor-pointer select-none w-[15%]"
                                @click="toggleOrderBy('athlete.surname', group.division_code, group.class_code)">
                                Спортсмен
                            </th>
                            <th scope="col" class="px-4 py-3 table-cell sm:hidden w-1"/>
                            <sort-order-indicator
                                field="athlete.surname"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy"
                                :hide-for-narrow-screen="false">
                            </sort-order-indicator>
                            <th scope="col"
                                class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[5%]"
                                @click="toggleOrderBy('athlete.birth_date', group.division_code, group.class_code)">
                                Дата&nbsp;рождения
                            </th>
                            <sort-order-indicator
                                field="athlete.birth_date"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy">
                            </sort-order-indicator>
                            <template v-if="isSecretary">
                                <th scope="col"
                                    class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[5%]"
                                    @click="toggleOrderBy('athlete.using_chair', group.division_code, group.class_code)">
                                    Использует стул,&nbsp;коляску
                                </th>
                                <sort-order-indicator
                                    field="athlete.using_chair"
                                    :division_code="group.division_code"
                                    :class_code="group.class_code"
                                    :orderBy="orderBy">
                                </sort-order-indicator>
                            </template>
                            <th scope="col"
                                class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[10%]"
                                @click="toggleOrderBy('athlete.region.full_name', group.division_code, group.class_code)">
                                Регион
                            </th>
                            <sort-order-indicator
                                field="athlete.region.full_name"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy">
                            </sort-order-indicator>
                            <th scope="col"
                                class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[2%]"
                                @click="toggleOrderBy('athlete.qualification.order', group.division_code, group.class_code)">
                                Разряд, звание
                            </th>
                            <sort-order-indicator
                                field="athlete.qualification.order"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy">
                            </sort-order-indicator>
                            <th scope="col"
                                class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[8%]"
                                @click="toggleOrderBy('sport_school.full_title', group.division_code, group.class_code)">
                                Спортивная школа
                            </th>
                            <sort-order-indicator
                                field="sport_school.full_title"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy">
                            </sort-order-indicator>
                            <th scope="col"
                                class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[6%]"
                                @click="toggleOrderBy('sport_organisation.full_title', group.division_code, group.class_code)">
                                Клуб, организация
                            </th>
                            <sort-order-indicator
                                field="sport_organisation.full_title"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy">
                            </sort-order-indicator>
                            <template v-if="isSecretary">
                                <th scope="col"
                                    class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[5%]"
                                    @click="toggleOrderBy('contact_information', group.division_code, group.class_code)">
                                    Контактная информация
                                </th>
                                <sort-order-indicator
                                    field="contact_information"
                                    :division_code="group.division_code"
                                    :class_code="group.class_code"
                                    :orderBy="orderBy">
                                </sort-order-indicator>
                                <th scope="col"
                                    class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none w-[6%]"
                                    @click="toggleOrderBy('coach_name', group.division_code, group.class_code)">
                                    Тренер
                                </th>
                                <sort-order-indicator
                                    field="coach_name"
                                    :division_code="group.division_code"
                                    :class_code="group.class_code"
                                    :orderBy="orderBy">
                                </sort-order-indicator>
                            </template>
                            <th scope="col" class="px-4 py-3 hover:cursor-pointer hidden sm:table-cell select-none"
                                @click="toggleOrderBy('created_at', group.division_code, group.class_code)">Дата и время
                                регистрации
                            </th>
                            <sort-order-indicator
                                field="created_at"
                                :division_code="group.division_code"
                                :class_code="group.class_code"
                                :orderBy="orderBy">
                            </sort-order-indicator>
                        </tr>
                        </thead>
                        <tbody data-accordion="open"
                               data-active-classes="text-black dark:text-white bg-white dark:bg-gray-800"
                               data-inactive-classes="text-gray-600 dark:text-gray-400">
                        <template
                            v-for="participant in sortedParticipants(group.division_code, group.class_code)">
                            <tr class="border-t dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white hidden sm:table-cell"
                                    v-if="isSecretary">
                                    <a class="hover:cursor-pointer"
                                       @click="confirmDeleteParticipant(participant.id)">❌</a>
                                </th>
                                <td scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    colspan="2">
                                    {{ participant.athlete.surname }}&nbsp;{{
                                        participant.athlete.first_name
                                    }}{{
                                        participant.athlete.patronymic !== null ? " " + participant.athlete.patronymic : ""
                                    }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell" colspan="2">
                                    {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}
                                </td>
                                <td v-if="isSecretary" class="px-4 py-3 hidden sm:table-cell" colspan="2">
                                    <svg v-if="participant.athlete.using_chair === 1"
                                         class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                         viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                    </svg>
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell" colspan="2">{{
                                        participant.athlete.region.full_name
                                    }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell" colspan="2">
                                    {{ participant.athlete.qualification.short_title }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell" colspan="2">
                                    {{ participant.sport_school !== null ? participant.sport_school.full_title : "" }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell" colspan="2">{{
                                        participant.sport_organisation !== null ? participant.sport_organisation.full_title : ""
                                    }}
                                </td>
                                <td v-if="isSecretary" class="px-4 py-3 hidden sm:table-cell"
                                    colspan="2">{{ participant.contact_information }}
                                </td>
                                <td v-if="isSecretary" class="px-4 py-3 hidden sm:table-cell"
                                    colspan="2">{{ participant.coach_name }}
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell" colspan="2">
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
                                <td colspan="3" :id="'dropdown-participant-' + participant.id" class="hidden">
                                    <div class="text-left mx-6 my-0.5 p-3">
                                        <p><b>Дата рождения:</b>
                                            {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}</p>
                                        <p v-if="isSecretary && participant.athlete.using_chair === 1"><b>Использует
                                            стул или инвалидную коляску</b></p>
                                        <p><b>Регион:</b> {{ participant.athlete.region.full_name }}</p>
                                        <p><b>Разряд/звание:</b> {{ participant.athlete.qualification.short_title }}</p>
                                        <p v-if="participant.sport_school !== null"><b>Спортивная школа:</b>
                                            {{ participant.sport_school.full_title }}</p>
                                        <p v-if="participant.sport_organisation !== null"><b>Клуб/организация:</b>
                                            {{ participant.sport_organisation.full_title }}</p>
                                        <p v-if="isSecretary"><b>Контактная информация:</b>
                                            {{ participant.contact_information }}</p>
                                        <p v-if="isSecretary && participant.coach_name !== null"><b>Тренер:</b>
                                            {{ participant.coach_name }}</p>
                                        <p><b>Дата и время регистрации:</b>
                                            {{ dayjs(participant.created_at).format("DD.MM.YYYY HH:mm:ss") }}</p>
                                        <p v-if="isSecretary" class="mt-3">
                                            <a class="hover:cursor-pointer"
                                               @click="confirmDeleteParticipant(participant.id)">❌</a>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 bg-gray-100 dark:bg-gray-700" v-if="isSecretary">
                    <button v-if="isSecretary" type="button" :id="group.division_code + '_' + group.class_code"
                            class="exportViaClipboard inline-flex items-center px-3 py-2.5 mr-2 text-xs font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                        Экспорт группы в IANSEO (буфер обмена)
                    </button>
                    <button v-if="isSecretary" type="button" data-tooltip-target="copied-tooltip" data-tooltip-trigger="none"
                            @click="ianseoExportToFile(sortedParticipants(group.division_code, group.class_code), competition.id, group.division_code + group.class_code)"
                            class="inline-flex items-center px-3 py-2.5 mr-2 text-xs font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                        Экспорт группы в IANSEO (файл)
                    </button>
                </div>
            </div>
            <!--todo когда сделаю алисаы, поменять тут на алиас-->
            <button v-if="isSecretary" type="button"
                    class="exportViaClipboard inline-flex items-center px-5 py-2.5 mb-3 mr-3 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                Экспорт всех в IANSEO (буфер обмена)
            </button>
            <button v-if="isSecretary" type="button" data-tooltip-target="copied-tooltip" data-tooltip-trigger="none"
                    @click="ianseoExportToFile(participants_copy, competition.id)"
                    class="inline-flex items-center px-5 py-2.5 mb-3 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                Экспорт всех в IANSEO (файл)
            </button>
            <div id="copied-tooltip" role="tooltip"
                 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                Скопировано
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </section>
</template>
<script setup>
import dayjs from 'dayjs';
import ClipboardJS from "clipboard";
import {Tooltip} from 'flowbite';
import {ianseoExportToFile, ianseoData} from "../ianseoExport.js";
import {ref} from "vue";

const props = defineProps(["competition", "participants", "isSecretary", "routeDeleteParticipant"]);

const orderBy = ref([]);
const participants_copy = ref(props.participants);

function sortedParticipants(division_code, class_code) {
    if (orderBy.value[division_code + class_code] == null) {
        orderBy.value[division_code + class_code] = {
            field: "created_at",
            order: "desc"
        };
    }

    return participants_copy.value
        .filter(candidate => candidate.athlete !== null)
        .filter(candidate => candidate.division_code === division_code && candidate.class_code === class_code)
        .sort((a, b) => {
            const orderByForGroup = orderBy.value[division_code + class_code];
            const parts = orderByForGroup.field.split(".");
            let av = a;
            for (let i = 0; i < parts.length; ++i) {
                if (av === null) {
                    break;
                }
                av = av[parts[i]];
            }
            let bv = b;
            for (let i = 0; i < parts.length; ++i) {
                if (bv === null) {
                    break;
                }
                bv = bv[parts[i]];
            }

            //сравнение с налл
            if (av === null && bv !== null) {
                return orderByForGroup.order === "asc" ? -1 : 1;
            }
            if (av !== null && bv === null) {
                return orderByForGroup.order === "asc" ? 1 : -1;
            }
            if (av === null && bv === null) {
                return 0;
            }

            //внятные значения
            if (av < bv) {
                return orderByForGroup.order === "asc" ? -1 : 1;
            }
            if (av > bv) {
                return orderByForGroup.order === "asc" ? 1 : -1;
            }

            return 0;
        });
}

function toggleOrderBy(field, division_code, class_code) {
    const orderByForGroup = orderBy.value[division_code + class_code];

    if (orderByForGroup.field === field) {
        orderByForGroup.order = orderByForGroup.order === "asc" ? "desc" : "asc";
    } else {
        orderByForGroup.field = field;
        orderByForGroup.order = "asc";
    }
}

function confirmDeleteParticipant(id) {
    if (window.confirm("Удалить участника из данного соревнования?")) {
        const path = props.routeDeleteParticipant.replace(":participant_id", id);
        axios.delete(path).then(response => {
            if (response.data.status === "ok") {
                participants_copy.value = participants_copy.value.filter(participant => participant.id !== id);
                alert("Спортсмен удален из соревнования.")
            }
        }).catch(e => {
            alert("Произошла ошибка при удалении спортсмена.");
        });
    }
}

const clipboard = new ClipboardJS('.exportViaClipboard', {
    text: function (trigger) {
        if (trigger.id) {
            const args = trigger.id.split("_");
            if (args[0] !== '' && args[1] !== '') {
                return ianseoData(sortedParticipants(args[0], args[1]));
            }
        }

        return ianseoData(participants_copy.value);
    }
});
clipboard.on('success', function (e) {
    const targetElement = document.getElementById('copied-tooltip');
    const tooltip = new Tooltip(targetElement, e.trigger, {triggerType: "none", placement: "bottom"});
    tooltip.show();
    setTimeout(function () {
        tooltip.hide();
    }, 2000);
    e.clearSelection();
});

</script>

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
                    <span class="absolute top-10 left-1.5 text-sm hidden sm:block whitespace-nowrap">
                        {{
                            wTrans("participants.totalRegistered", {count: sortedParticipants(group.division_code, group.class_code).length, whitespace: " "})
                        }}
                    </span>
                    <span>{{ trans("divisions." + group.division.code) }} {{ trans("classes." + group.archery_class.code) }}</span>
                </div>
                <template v-if="sortedParticipants(group.division_code, group.class_code).length > 0">
                    <!--сама таблица-->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col"
                                    :class="['px-4', 'py-3', 'select-none', 'hidden', 'sm:table-cell', getWidthClass('delete')]"
                                    v-if="isSecretary"></th>
                                <th scope="col"
                                    :class="['px-4', 'py-3', 'hover:cursor-pointer', 'select-none', getWidthClass('athlete')]"
                                    @click="toggleOrderBy('athlete.surname', group.division_code, group.class_code)">
                                    <div class="flex items-center">
                                        <div>{{ trans("participants.athlete") }}</div>
                                        <sort-order-indicator
                                            field="athlete.surname"
                                            :division_code="group.division_code"
                                            :class_code="group.class_code"
                                            :orderBy="orderBy"
                                            :hide-for-narrow-screen="false">
                                    </sort-order-indicator>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 table-cell sm:hidden w-1 relative align-baseline place-items-center">
                                    <span class="absolute top-1 right-1 text-xs normal-case text-black dark:text-white whitespace-nowrap">
                                        {{ wTrans("participants.totalRegistered", {count: sortedParticipants(group.division_code, group.class_code).length}) }}
                                    </span>
                                </th>
                                <th scope="col"
                                    :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('birth_date')]"
                                    @click="toggleOrderBy('athlete.birth_date', group.division_code, group.class_code)">
                                    <div class="flex items-center">
                                        <div>{{ trans("participants.birthDate") }}</div>
                                            <sort-order-indicator
                                                field="athlete.birth_date"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                        </sort-order-indicator>
                                    </div>
                                </th>
                                <template v-if="isSecretary">
                                    <th scope="col"
                                        :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('wheelchair')]"
                                        @click="toggleOrderBy('athlete.using_chair', group.division_code, group.class_code)">
                                        <div class="flex items-center">
                                            <div class="w-min">{{ trans("participants.usingWheelchair", {whitespace: "&nbsp;"}) }}</div>
                                            <sort-order-indicator
                                                field="athlete.using_chair"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                            </sort-order-indicator>
                                        </div>
                                    </th>
                                </template>
                                <th scope="col"
                                    :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('region')]"
                                    @click="toggleOrderBy('region.full_name', group.division_code, group.class_code)">
                                    <div class="flex items-center">
                                        <div class="w-min">{{ competition.allow_countries ? trans("participants.regionOrCountry", {whitespace: '&nbsp;'}) : trans("participants.region") }}</div>
                                        <sort-order-indicator
                                            field="region.full_name"
                                            :division_code="group.division_code"
                                            :class_code="group.class_code"
                                            :orderBy="orderBy">
                                        </sort-order-indicator>
                                    </div>
                                </th>
                                <th scope="col"
                                    :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('qualification')]"
                                    @click="toggleOrderBy('athlete.qualification.order', group.division_code, group.class_code)">
                                    <div class="flex items-center">
                                        <div class="w-min">{{ trans("participants.qualification") }}</div>
                                        <sort-order-indicator
                                            field="athlete.qualification.order"
                                            :division_code="group.division_code"
                                            :class_code="group.class_code"
                                            :orderBy="orderBy">
                                        </sort-order-indicator>
                                    </div>
                                </th>
                                <th v-if="competition.allow_input_school_and_club"
                                    scope="col"
                                    :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('sport_school_or_club')]"
                                    @click="toggleOrderBy('sport_school_or_club', group.division_code, group.class_code)">
                                        <div class="flex items-center">
                                            <div>{{ trans("participants.sportSchoolOrClub") }}</div>
                                            <sort-order-indicator
                                                field="sport_school_or_club"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                            </sort-order-indicator>
                                        </div>
                                </th>
                                <template v-else>
                                    <th scope="col"
                                        :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('sport_school')]"
                                        @click="toggleOrderBy('sport_school.full_title', group.division_code, group.class_code)">
                                        <div class="flex items-center">
                                            <div>{{ trans("participants.sportSchool") }}</div>
                                            <sort-order-indicator
                                                field="sport_school.full_title"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                            </sort-order-indicator>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('sport_organisation')]"
                                        @click="toggleOrderBy('sport_organisation.full_title', group.division_code, group.class_code)">
                                        <div class="flex items-center">
                                            <div>{{ trans("participants.clubAndOrganisation") }}</div>
                                            <sort-order-indicator
                                                field="sport_organisation.full_title"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                            </sort-order-indicator>
                                        </div>
                                    </th>
                                </template>
                                <template v-if="isSecretary">
                                    <th scope="col"
                                        :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('contact_information')]"
                                        @click="toggleOrderBy('contact_information', group.division_code, group.class_code)">
                                        <div class="flex items-center">
                                            <div class="w-min">{{ trans("participants.contactInfo") }}</div>
                                            <sort-order-indicator
                                                field="contact_information"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                            </sort-order-indicator>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('coach_name')]"
                                        @click="toggleOrderBy('coach_name', group.division_code, group.class_code)">
                                        <div class="flex items-center">
                                            <div class="w-min">{{ trans("participants.coachInfo") }}</div>
                                            <sort-order-indicator
                                                field="coach_name"
                                                :division_code="group.division_code"
                                                :class_code="group.class_code"
                                                :orderBy="orderBy">
                                            </sort-order-indicator>
                                        </div>
                                    </th>
                                </template>
                                <th scope="col"
                                    :class="['px-4', 'py-3', 'hover:cursor-pointer', 'hidden', 'sm:table-cell', 'select-none', getWidthClass('created_at')]"
                                    @click="toggleOrderBy('created_at', group.division_code, group.class_code)">
                                    <div class="flex items-center">
                                        <div>{{ trans("participants.registrationDateTime") }}</div>
                                        <sort-order-indicator
                                            field="created_at"
                                            :division_code="group.division_code"
                                            :class_code="group.class_code"
                                            :orderBy="orderBy">
                                        </sort-order-indicator>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody data-accordion="open"
                                   data-active-classes="text-black dark:text-white bg-white dark:bg-gray-800"
                                   data-inactive-classes="text-gray-600 dark:text-gray-400">
                            <template
                                v-for="participant in sortedParticipants(group.division_code, group.class_code)">
                                <tr class="border-t dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 dark:text-white hidden sm:table-cell"
                                        v-if="isSecretary">
                                        <a class="hover:cursor-pointer"
                                           @click="confirmDeleteParticipant(participant.id)">❌</a>
                                    </th>
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-normal text-ellipsis overflow-hidden">
                                        {{ participant.athlete.surname }} {{
                                            participant.athlete.first_name
                                        }}{{
                                            participant.athlete.patronymic !== null ? " " + participant.athlete.patronymic : ""
                                        }}
                                    </td>
                                    <td class="participant-cell">
                                        {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}
                                    </td>
                                    <td v-if="isSecretary" class="participant-cell">
                                        <svg v-if="participant.athlete.using_chair === 1"
                                             class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                        </svg>
                                    </td>
                                    <td class="participant-cell">{{
                                            participant.region.is_country
                                                ? trans("countries." + participant.region_code)
                                                : trans("regions." + participant.region_code)
                                        }}
                                    </td>
                                    <td class="participant-cell">
                                        {{ participant.athlete.qualification.short_title }}
                                    </td>
                                    <td v-if="competition.allow_input_school_and_club"
                                        class="participant-cell">
                                        {{ participant.sport_school_or_club }}
                                    </td>
                                    <template v-else>
                                        <td class="participant-cell">
                                            {{
                                                participant.sport_school !== null ? participant.sport_school.full_title : ""
                                            }}
                                        </td>
                                        <td class="participant-cell">{{
                                                participant.sport_organisation !== null ? participant.sport_organisation.full_title : ""
                                            }}
                                        </td>
                                    </template>
                                    <td v-if="isSecretary" class="participant-cell">{{ participant.contact_information }}</td>
                                    <td v-if="isSecretary" class="participant-cell">{{ participant.coach_name }}</td>
                                    <td class="participant-cell">{{ dayjs(participant.created_at).format("DD.MM.YYYY HH:mm:ss") }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end sm:hidden">
                                        <!--скрываем этот столбец начиная с размера sm-->
                                        <button :id="'dropdown-button-' + participant.id"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                                type="button"
                                                aria-expanded="false"
                                                :aria-controls="'dropdown-participant-' + participant.id"
                                                :data-accordion-target="'#dropdown-participant-' + participant.id"
                                        >
                                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                 aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 5 5 1 1 5"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-t dark:border-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <td colspan="2" :id="'dropdown-participant-' + participant.id" class="hidden sm:hidden">
                                        <div class="text-left mx-6 my-0.5 p-3">
                                            <p><b>{{ trans("participants.birthDate", {whitespace: " "}) }}:</b>
                                                {{ dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") }}</p>
                                            <p v-if="isSecretary && participant.athlete.using_chair === 1"><b>{{
                                                    trans("participants.usingWheelchairFull")
                                                }}</b></p>
                                            <p v-if="participant.region.is_country">
                                                <b>{{ trans("participants.country") }}:</b>
                                                {{ trans("countries." + participant.region_code) }}
                                            </p>
                                            <p v-else>
                                                <b>{{ trans("participants.region") }}:</b>
                                                {{ trans("regions." + participant.region_code) }}
                                            </p>
                                            <p><b>{{ trans("participants.qualification") }}:</b>
                                                {{ participant.athlete.qualification.full_title }}</p>
                                            <p v-if="participant.sport_school !== null">
                                                <b>{{ trans("participants.sportSchool") }}:</b>
                                                {{ participant.sport_school.full_title }}</p>
                                            <p v-if="participant.sport_organisation !== null">
                                                <b>{{ trans("participants.clubAndOrganisation") }}:</b>
                                                {{ participant.sport_organisation.full_title }}</p>
                                            <p v-if="isSecretary"><b>{{ trans("participants.contactInfo") }}:</b>
                                                {{ participant.contact_information }}</p>
                                            <p v-if="isSecretary && participant.coach_name !== null"><b>Тренер:</b>
                                                {{ participant.coach_name }}</p>
                                            <p><b>{{ trans("participants.registrationDateTime") }}:</b>
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
                    <div class="p-2 bg-gray-100 dark:bg-gray-700" v-if="isSecretary">
                        <button v-if="isSecretary" type="button" :id="group.division_code + '_' + group.class_code"
                                class="exportViaClipboard inline-flex items-center px-3 py-2.5 mr-2 mb-1 sm:mb-0 text-xs font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-0 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                            {{ trans("participants.exportGroupViaClipboard") }}
                        </button>
                        <button v-if="isSecretary" type="button"
                                @click="ianseoExportToFile(sortedParticipants(group.division_code, group.class_code), competition.id, group.division_code + group.class_code)"
                                class="inline-flex items-center px-3 py-2.5 mr-2 text-xs font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-0 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                            {{ trans("participants.exportGroupViaFile") }}
                        </button>
                    </div>
                </template>
            </div>
            <!--todo когда сделаю алисаы, поменять тут на алиас-->
            <button v-if="isSecretary" type="button"
                    class="exportViaClipboard inline-flex items-center px-5 py-2.5 mb-1 sm:mb-0 mr-3 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-0 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                {{ trans("participants.exportAllViaClipboard") }}
            </button>
            <button v-if="isSecretary" type="button"
                    @click="ianseoExportToFile(participants_copy, competition.id)"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-0 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600">
                {{ trans("participants.exportAllViaFile") }}
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
import {trans, wTrans} from 'laravel-vue-i18n'

const props = defineProps(["competition", "participants", "isSecretary", "routeDeleteParticipant"]);

const orderBy = ref([]);
const participants_copy = ref(props.participants.map(participant => {
    participant.region.full_name = participant.region.is_country
        ? trans("countries." + participant.region.code)
        : trans("regions." + participant.region.code);

    return participant;
}));

const widthClasses = {
    delete: {true: "w-[2%]", false: "w-0"},
    athlete: {true: "sm:w-[18%]", false: "sm:w-[24%]"},
    birth_date: {true: "w-[6%]", false: "w-[10%]"},
    wheelchair: {true: "w-[7%]", false: "w-0"},
    region: {true: "w-[12%]", false: "w-[20%]"},
    qualification: {true: "w-[6.5%]", false: "w-[10%]"},
    sport_school: {true: "w-[12%]", false: "w-[22%]"},
    sport_organisation: {true: "w-[12%]", false: "w-[19%]"},
    sport_school_or_club: {true: "w-[16%]", false: "w-[16%]"},
    contact_information: {true: "w-[10%]", false: "w-0"},
    coach_name: {true: "w-[9%]", false: "w-0"},
    created_at: {true: "w-[10%]", false: "w-[15%]"},
};

function getWidthClass(column) {
    return widthClasses[column][props.isSecretary === 1];
}

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
    if (confirm(trans("participants.confirmParticipantDelete"))) {
        const path = props.routeDeleteParticipant.replace(":participant_id", id);
        axios.delete(path).then(response => {
            if (response.data.status === "ok") {
                participants_copy.value = participants_copy.value.filter(participant => participant.id !== id);
                alert(trans("participants.participantDeleted"));
            }
        }).catch(e => {
            alert(trans("participants.errorDeleteParticipant"));
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
});

</script>

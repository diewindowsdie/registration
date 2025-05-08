<template>
    <a v-if="isSecretary"
        class="flex items-center justify-center px-5 py-2.5 mb-3 mx-1.5 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600"
        :href="routeNewCompetition">{{ trans("navbar.add_competition") }}</a>

    <ul id="accordion" data-accordion="open" class="space-y-2 mt-0" data-active-classes="text-black dark:text-white"
        data-inactive-classes="text-gray-600 dark:text-gray-400">
        <template v-for="competition in competitions_copy" :key="competition.id">
            <li :id="'competition_' + competition.id">
                <button type="button"
                        :id="'trigger-' + competition.id"
                        :class="(currentCompetition !== null ? currentCompetition.id : null) === competition.id
                            ? 'details-toggler flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-black dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'
                            : 'details-toggler flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700'
                        "
                                    :aria-expanded="(currentCompetition !== null ? currentCompetition.id : null)  === competition.id"
                                    :aria-controls="(isSecretary || isRegistrationOpen(competition)) ? ('dropdown-competitions-' + competition.id) : ''"
                                    :data-accordion-target="(isSecretary || isRegistrationOpen(competition)) ? ('#dropdown-competitions-' + competition.id) : ''"
                    >
                    <span class="flex-1 text-left">{{ competition.title }},<br/>
                        {{ dayjs(competition.start_date).format('DD.MM') }} - {{ dayjs(competition.end_date).format('DD.MM') }}</span>
                    <svg v-if="isSecretary || isRegistrationOpen(competition)" data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
                <template v-if="isSecretary || isRegistrationOpen(competition)">
                    <div class="grid grid-cols-8 pl-6 hidden" :id="'dropdown-competitions-' + competition.id">
                        <template v-if="isRegistrationOpen(competition)">
                            <div class="col-span-1 text-gray-500 dark:text-gray-400 mt-1 flex items-center-safe justify-center">
                                <svg class="w-5 h-5 fill-gray-500 dark:fill-gray-400" viewBox="0 0 32 32" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier"><title>pencil</title>
                                        <path
                                            d="M5.582 20.054l14.886-14.886 6.369 6.369-14.886 14.886-6.369-6.369zM21.153 8.758l-0.698-0.697-11.981 11.98 0.698 0.698 11.981-11.981zM22.549 10.154l-0.698-0.698-11.981 11.982 0.697 0.697 11.982-11.981zM23.945 11.55l-0.698-0.698-11.981 11.981 0.698 0.698 11.981-11.981zM23.319 2.356c0.781-0.783 2.045-0.788 2.82-0.013l3.512 3.512c0.775 0.775 0.77 2.038-0.012 2.82l-2.17 2.17-6.32-6.32 2.17-2.169zM5.092 20.883l6.030 6.030-5.284 1.877-2.623-2.623 1.877-5.284zM4.837 29.117l-3.066 1.117 1.117-3.066 1.949 1.949z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-span-7 text-gray-500 dark:text-gray-400 hover:underline mt-1 px-2 flex items-center-safe"><a
                                :href="routeRegistrationForm.replace(':competition_id', competition.alias)">{{ trans("navbar.register") }}</a>
                            </div>
                        </template>
                        <template v-if="competition.participants_list_available_to_anyone || isSecretary">
                            <div class="col-span-1 text-gray-500 dark:text-gray-400 mt-1 flex items-center-safe justify-center">
                                <svg class="w-5 h-5 fill-gray-500 dark:fill-gray-400" viewBox="0 0 16 16"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M3 1H1V3H3V1Z"></path>
                                        <path d="M3 5H1V7H3V5Z"></path>
                                        <path d="M1 9H3V11H1V9Z"></path>
                                        <path d="M3 13H1V15H3V13Z"></path>
                                        <path d="M15 1H5V3H15V1Z"></path>
                                        <path d="M15 5H5V7H15V5Z"></path>
                                        <path d="M5 9H15V11H5V9Z"></path>
                                        <path d="M15 13H5V15H15V13Z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-span-7 text-gray-500 dark:text-gray-400 hover:underline mt-1 px-2 flex items-center-safe"><a
                                :href="routeParticipantsList.replace(':competition_id', competition.alias)">{{ trans("navbar.participants") }}</a>
                            </div>
                        </template>
                        <template v-if="isSecretary">
                            <div class="col-span-1 text-gray-500 dark:text-gray-400 mt-1 flex items-center-safe justify-center">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path class="stroke-gray-500 dark:stroke-gray-400"
                                              d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path class="stroke-gray-500 dark:stroke-gray-400"
                                              d="M12.9046 3.06005C12.6988 3 12.4659 3 12 3C11.5341 3 11.3012 3 11.0954 3.06005C10.7942 3.14794 10.5281 3.32808 10.3346 3.57511C10.2024 3.74388 10.1159 3.96016 9.94291 4.39272C9.69419 5.01452 9.00393 5.33471 8.36857 5.123L7.79779 4.93281C7.3929 4.79785 7.19045 4.73036 6.99196 4.7188C6.70039 4.70181 6.4102 4.77032 6.15701 4.9159C5.98465 5.01501 5.83376 5.16591 5.53197 5.4677C5.21122 5.78845 5.05084 5.94882 4.94896 6.13189C4.79927 6.40084 4.73595 6.70934 4.76759 7.01551C4.78912 7.2239 4.87335 7.43449 5.04182 7.85566C5.30565 8.51523 5.05184 9.26878 4.44272 9.63433L4.16521 9.80087C3.74031 10.0558 3.52786 10.1833 3.37354 10.3588C3.23698 10.5141 3.13401 10.696 3.07109 10.893C3 11.1156 3 11.3658 3 11.8663C3 12.4589 3 12.7551 3.09462 13.0088C3.17823 13.2329 3.31422 13.4337 3.49124 13.5946C3.69158 13.7766 3.96395 13.8856 4.50866 14.1035C5.06534 14.3261 5.35196 14.9441 5.16236 15.5129L4.94721 16.1584C4.79819 16.6054 4.72367 16.829 4.7169 17.0486C4.70875 17.3127 4.77049 17.5742 4.89587 17.8067C5.00015 18.0002 5.16678 18.1668 5.5 18.5C5.83323 18.8332 5.99985 18.9998 6.19325 19.1041C6.4258 19.2295 6.68733 19.2913 6.9514 19.2831C7.17102 19.2763 7.39456 19.2018 7.84164 19.0528L8.36862 18.8771C9.00393 18.6654 9.6942 18.9855 9.94291 19.6073C10.1159 20.0398 10.2024 20.2561 10.3346 20.4249C10.5281 20.6719 10.7942 20.8521 11.0954 20.94C11.3012 21 11.5341 21 12 21C12.4659 21 12.6988 21 12.9046 20.94C13.2058 20.8521 13.4719 20.6719 13.6654 20.4249C13.7976 20.2561 13.8841 20.0398 14.0571 19.6073C14.3058 18.9855 14.9961 18.6654 15.6313 18.8773L16.1579 19.0529C16.605 19.2019 16.8286 19.2764 17.0482 19.2832C17.3123 19.2913 17.5738 19.2296 17.8063 19.1042C17.9997 18.9999 18.1664 18.8333 18.4996 18.5001C18.8328 18.1669 18.9994 18.0002 19.1037 17.8068C19.2291 17.5743 19.2908 17.3127 19.2827 17.0487C19.2759 16.8291 19.2014 16.6055 19.0524 16.1584L18.8374 15.5134C18.6477 14.9444 18.9344 14.3262 19.4913 14.1035C20.036 13.8856 20.3084 13.7766 20.5088 13.5946C20.6858 13.4337 20.8218 13.2329 20.9054 13.0088C21 12.7551 21 12.4589 21 11.8663C21 11.3658 21 11.1156 20.9289 10.893C20.866 10.696 20.763 10.5141 20.6265 10.3588C20.4721 10.1833 20.2597 10.0558 19.8348 9.80087L19.5569 9.63416C18.9478 9.26867 18.6939 8.51514 18.9578 7.85558C19.1262 7.43443 19.2105 7.22383 19.232 7.01543C19.2636 6.70926 19.2003 6.40077 19.0506 6.13181C18.9487 5.94875 18.7884 5.78837 18.4676 5.46762C18.1658 5.16584 18.0149 5.01494 17.8426 4.91583C17.5894 4.77024 17.2992 4.70174 17.0076 4.71872C16.8091 4.73029 16.6067 4.79777 16.2018 4.93273L15.6314 5.12287C14.9961 5.33464 14.3058 5.0145 14.0571 4.39272C13.8841 3.96016 13.7976 3.74388 13.6654 3.57511C13.4719 3.32808 13.2058 3.14794 12.9046 3.06005Z"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-span-7 text-gray-500 dark:text-gray-400 hover:underline mt-1 px-2 flex items-center-safe">
                                {{ trans("navbar.settings") }}
                            </div>
                            <div class="col-span-1 text-gray-500 dark:text-gray-400 mt-1 flex items-center-safe justify-center">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path class="stroke-gray-500 dark:stroke-gray-400"
                                              d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-span-7 text-gray-500 dark:text-gray-400 hover:underline mt-1 px-2 flex items-center-safe"><a
                                class="hover:cursor-pointer"
                                @click="deleteCompetition(competition.id)">{{ trans("navbar.delete") }}</a>
                            </div>
                        </template>
                    </div>
                </template>
            </li>
        </template>
    </ul>
</template>
<script setup>
import dayjs from "dayjs";
import {trans} from "laravel-vue-i18n";
import {ref} from "vue";

const props = defineProps({
    competitions: Object,
    currentCompetition: {
        type: Object,
        default: null
    },
    isSecretary: Number,
    routeRegistrationForm: String,
    routeParticipantsList: String,
    routeNewCompetition: String,
    routeDeleteCompetition: String,
    routeLoadUpcomingCompetitions: String,
});
const competitions_copy = ref(props.competitions);

function isRegistrationOpen(competition) {
    return (!dayjs(competition.registration_start).isAfter(dayjs())) && (!dayjs(competition.registration_finish).isBefore(dayjs()));
}

function deleteCompetition(id) {
    if (confirm("Удалить соревнование?")) {
        const path = props.routeDeleteCompetition.replace(":competition_id", id);
        axios.delete(path).then(response => {
            if (response.data.status === "ok") {
                loadUpcomingCompetitions(id);
            }
        }).catch(e => {
            alert("Ошибка при удалении соревнования :(");
        });
    }
}

function loadUpcomingCompetitions(deletedCompetitionId) {
    axios.get(props.routeLoadUpcomingCompetitions).then(response => {
        if (response.data.status === "ok") {
            competitions_copy.value = response.data.competitions;
        }
    }).catch(e => {
        //если не смогли перезагрузить список - просто удалим из модели удаленное соревнование
        competitions_copy.value = competitions_copy.value.filter(competition => competition.id !== deletedCompetitionId);
        throw e;
    });
}

</script>

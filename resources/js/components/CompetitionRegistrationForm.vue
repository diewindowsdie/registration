<template>
    <section class="bg-transparent" v-if="registrationSuccess === false">
        <div class="px-4 mx-auto max-w-6xl">
            <h2 class="mb-4 py-2 text-4xl font-bold text-gray-900 dark:text-white">{{ competition.title }}, {{ dayjs(competition.start_date).format("DD.MM.YYYY") }}<template v-if="!dayjs(competition.start_date).isSame(dayjs(competition.end_date))"> - {{ dayjs(competition.end_date).format('DD.MM.YYYY') }}</template></h2>
            <h2 class="mb-4 py-2 text-2xl text-gray-900 dark:text-white">{{ trans("registration.registrationOpenTitle") }} {{ trans("general.dateFrom") }}
                <b>{{ dayjs(competition.registration_start).format("DD.MM.YYYY HH:mm:ss") }}</b> {{ trans("general.dateTo") }} <b>{{ dayjs(competition.registration_finish).format("DD.MM.YYYY HH:mm:ss")}}</b></h2>
            <form @submit.prevent="onSubmit" method="post" :action="routeSave">
                <div v-if="globalErrors.length > 0" class="border-red-500 text-red-900 placeholder-red-700 rounded-2xl border-2 px-5 py-5 mb-3">
                    <label for="errors" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">{{ trans("registration.globalErrors") }}</label>
                    <ul id="errors" class="mt-5">
                        <li v-for="error in globalErrors" class="my-2 ml-8 text-sm text-red-600 dark:text-red-500 list-disc">
                            <span class="font-medium">{{ errorMessages[error] }}</span>
                        </li>
                    </ul>
                </div>
                <div class="border-gray-300 dark:border-gray-600 rounded-2xl border px-5 py-5">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-8 sm:grid-cols-15">
                        <div class="sm:col-span-15"><label
                            class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white select-none">{{ trans("registration.athleteInformation") }}</label>
                        </div>
                        <div class="sm:col-span-5">
                            <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.lastName") }}</label>
                            <input type="text" v-model="athlete.surname" name="surname" id="surname"
                                   @input="searchAthlete(true)"
                                   :class="formErrors.surname ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusin="searchAthlete()"
                                   @focusout='onSurnameFocusOut()'
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.surname"><span class="font-medium">{{ trans("registration.error.namePattern") }}</span>
                            </p>
                            <div
                                class="absolute border bg-gray-50 border-gray-300 ml-1 mt-1 text-gray-900 w-85 rounded-lg text-sm outline-1 outline-gray-300 z-40  dark:bg-gray-700 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:outline-gray-500"
                                v-show="athletes.length > 0"
                                @mouseenter="preventAthletesSearchResultsCleanup = true"
                                @mouseleave="preventAthletesSearchResultsCleanup = false"
                            >
                                <template v-for="item in athletes">
                                    <div @click="fillForm(item)"
                                         class="hover:bg-gray-200 hover:dark:bg-gray-600 px-3 py-3 break-words">
                                        <p class="text-left font-bold">{{
                                                item.surname
                                            }}&nbsp;{{ item.first_name }}{{
                                                item.patronymic != null ? "&nbsp;" + item.patronymic : ""
                                            }}</p>
                                        <p v-if="item.gender === 'M'" class="text-right text-gray-400">{{ competition_copy.use_sport_qualification ? (item.qualification.short_title + ", " ) : "" }}{{ trans("registration.bornM") }}
                                            {{ dayjs(item.birth_date).format("DD.MM.YYYY") }},
                                            {{ item.region.is_country ? trans("countries." + item.region.code) : trans("regions." + item.region.code) }}</p>
                                        <p v-else-if="item.gender === 'F'" class="text-right text-gray-400">{{ competition_copy.use_sport_qualification ? (item.qualification.short_title + ", " ) : "" }}{{ trans("registration.bornF") }}
                                            {{ dayjs(item.birth_date).format("DD.MM.YYYY") }},
                                            {{ item.region.is_country ? trans("countries." + item.region.code) : trans("regions." + item.region.code) }}</p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="sm:col-span-5">
                            <label for="first_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.firstName") }}</label>
                            <input type="text" v-model="athlete.first_name" name="first_name" id="first_name"
                                   :class="formErrors.first_name ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                   : 'border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout='validateModel(athlete.first_name, namePattern, "first_name")'
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.first_name"><span class="font-medium">{{ trans("registration.error.namePattern") }}</span>
                            </p>
                        </div>

                        <div class="sm:col-span-5 flex flex-col">
                            <label for="patronymic"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.middleName") }}</label>
                            <input type="text" v-model="athlete.patronymic" name="patronymic" id="patronymic"
                                   :class="athlete.noMiddleName
                                        ? 'border cursor-not-allowed bg-gray-200 border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white'
                                        : (formErrors.patronymic
                                            ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                            : 'border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                                          )"
                                   :disabled="athlete.noMiddleName"
                                   @focusout="validatePatronymic()"
                            />
                            <div class="flex justify-end items-center text-sm">
                                <input id="no_patronymic" type="checkbox" value=""
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       v-model="athlete.noMiddleName"
                                       @change="onNoMiddleNameChange"
                                />
                                <label for="no_patronymic"
                                       class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300 select-none">{{ trans("registration.noMiddleName") }}</label>
                            </div>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.patronymic"><span class="font-medium">{{ trans("registration.error.patronymic") }}</span>
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="gender"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.gender") }}</label>
                            <select id="gender"
                                    :class="formErrors.gender ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                    v-model="athlete.gender"
                                    @change="resetParticipation"
                                    @focusout='validateModel(athlete.gender, genderPattern, "gender")'
                            >
                                <option value="M">{{ trans("registration.gender_M") }}</option>
                                <option value="F">{{ trans("registration.gender_F") }}</option>
                            </select>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.gender"><span class="font-medium">{{ trans("registration.error.gender") }}</span></p>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="birth_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.birthDate") }}</label>
                            <input v-model="athlete.birth_date" type="date" name="birth_date" id="birth_date"
                                   :class="formErrors.birth_date ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @change="resetParticipation"
                                   @focusout="validateBirthDate()"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.birth_date"><span
                                class="font-medium">{{ trans("registration.error.birthDate") }}</span></p>
                        </div>
                        <div class="sm:col-span-5" v-if="competition_copy.use_sport_qualification">
                            <label for="qualifications"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.qualification") }}</label>
                            <select id="qualifications"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="athlete.qualification">
                                <option v-for="qualification in qualifications" :value="qualification.code"
                                        :selected="qualification.code === 'NO'">
                                    {{ qualification.full_title }}
                                </option>
                            </select>
                        </div>

                        <div class="sm:col-span-5">
                            <label for="region"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ competition.allow_countries ? trans("registration.regionOrCountry", {whitespace: '&nbsp;'}) : trans("registration.region") }}</label>
                            <vSelect
                                id="region"
                                :class="formErrors.region ? 'vue-select-tailwind vue-select-tailwind-deselect-hidden vue-select-tailwind-error'
                                    : 'vue-select-tailwind vue-select-tailwind-deselect-hidden'"
                                v-model="athlete.region_code"
                                :options="enrichedRegions"
                                :reduce="region => region.code"
                                label="full_name"
                                @focusout="regionSelectValidate()"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.region"><span class="font-medium">{{ competition.allow_countries ? trans("registration.error.regionOrCountry", {whitespace: '&nbsp;'}) : trans("registration.error.region") }}</span></p>
                        </div>
                        <div class="sm:col-span-15 flex items-center sm:-mt-3 -mt-1">
                            <input id="wheelchair" type="checkbox" value=""
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                   v-model="athlete.using_chair"/>
                            <label for="wheelchair"
                                   class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300 select-none">{{ trans("registration.usingWheelchair") }}</label>
                        </div>
                        <div class="sm:col-span-10 mt-4">
                            <label for="contact_info"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.contactInfo") }}</label>
                            <input type="text" v-model="athlete.contact_information" name="contact_info"
                                   id="contact_info"
                                   :class="formErrors.contact_information ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="validateModel(athlete.contact_information, requiredTextPattern, 'contact_information')"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.contact_information"><span
                                class="font-medium">{{ trans("registration.error.contactInfo") }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="border-gray-300 dark:border-gray-600 rounded-2xl border px-5 py-5 mt-3">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white select-none">{{ trans("registration.competitionParticipation") }}</label>
                            <template v-for="group in competition_copy.groups">
                                <div
                                    :class="isGroupAvailable(group) ? 'grid grid-cols-1 gap-x-6 gap-y-0 sm:grid-cols-2 items-center p-4 mt-2 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600'
                                                                    : 'grid grid-cols-1 gap-x-6 gap-y-0 sm:grid-cols-2 items-center p-4 mt-2 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-200 dark:bg-gray-500 dark:text-gray-300 dark:border-gray-600'"
                                    >
                                    <div class="flex items-center col-span=1 sm:col-span-1">
                                        <input id="participation_{{group.id}}" type="checkbox" value=""
                                               :class="isGroupAvailable(group) ? 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'
                                                                               : 'w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-600 dark:border-gray-600'"
                                               v-model="group.participation" :disabled="!isGroupAvailable(group)"/>
                                        <label for="participation_{{group.id}}"
                                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">{{ trans("divisions." + group.division.code) }} {{ trans("classes." + group.archery_class.code) }}</label>
                                    </div>
                                    <div class="text-right block">
                                        <p class="text-xs font-bold">{{ trans("registration.groupEligibilityCriteria") }}</p>
                                        <p class="text-xs" v-if="competition_copy.use_sport_qualification && group.min_qualification_code !== 'NO'">{{ trans("registration.qualificationEligibility") }} <b>{{group.min_qualification.short_title}}</b></p>
                                        <p class="text-xs" v-if="group.min_birth_date !== null">{{ trans("registration.birthDateEligibility") }} <b>{{dayjs(group.min_birth_date).format("DD.MM.YYYY")}} {{ trans("registration.birthDateEligibilityTo") }} {{dayjs(group.max_birth_date).format("DD.MM.YYYY")}}</b></p>
                                        <p class="text-xs" v-if="group.min_birth_date === null">{{ trans("registration.birthDateEligibilityFrom") }} <b>{{dayjs(group.max_birth_date).format("DD.MM.YYYY")}}</b> {{ trans("registration.birthDateEligibilityAndOlder") }}</p>
                                        <p class="text-xs" v-if="JSON.stringify(group.allowed_genders) !== JSON.stringify(group.archery_class.allowed_genders)">
                                            {{ trans("registration.gender") }}: <b>{{formatGenders(group.allowed_genders)}}</b></p>
                                    </div>
                                    <div class="pl-5 mt-5"
                                         v-if="group.participation == true && (group.includes_teams == 1 || competition_copy.includes_mixed_team_events == 1)">
                                        <div v-if="group.includes_teams == 1" class="flex items-center">
                                            <input id="participation_team_{{group.id}}" type="checkbox" value=""
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="group.participate_teams"/>
                                            <label for="participation_team_{{group.id}}"
                                                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">{{ trans("registration.teamEventParticipation") }}</label>
                                        </div>
                                        <div v-if="competition_copy.includes_mixed_team_events == 1" class="flex items-center">
                                            <input id="participation_mixed_team_{{group.id}}" type="checkbox" value=""
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="group.participate_mixed_teams"/>
                                            <label for="participation_mixed_team_{{group.id}}"
                                                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">{{ trans("registration.mixedTeamEventParticipation") }}</label>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div v-if="competition_copy.allow_input_school_and_club"
                             class="sm:col-span-2">
                            <label for="sport_school_or_club"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.sportSchoolOrClub") }}</label>
                            <input type="text" v-model="athlete.sport_school_or_club" name="sport_school_or_club" id="sport_school_or_club"
                                   class="border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <template v-else>
                            <div>
                                <label for="sport_school"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.sportSchool") }}</label>
                                <vSelect
                                    id="sport_school"
                                    class="vue-select-tailwind"
                                    v-model="athlete.sport_school_code"
                                    :options="sport_schools"
                                    :reduce="sport_school => sport_school.code"
                                    label="full_title"
                                />
                            </div>
                            <div>
                                <label for="sport_organisation"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.sportOrganisation") }}</label>
                                <vSelect
                                    id="sport_school"
                                    class="vue-select-tailwind"
                                    v-model="athlete.sport_organisation_code"
                                    :options="sport_organisations"
                                    :reduce="sport_organisation => sport_organisation.code"
                                    label="full_title"
                                />
                            </div>
                        </template>
                        <div class="sm:col-span-2">
                            <label for="coach_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ trans("registration.coachInfo") }}</label>
                            <input type="text" v-model="athlete.coach_name" name="coach_name" id="coach_name"
                                   :class="formErrors.coach_name ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                   @focusout="validateModel(athlete.coach_name, requiredTextPattern, 'coach_name')"
                            />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"
                               v-if="formErrors.coach_name"><span
                                class="font-medium">{{ trans("registration.error.coachInfo") }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <input id="personalDataHandling" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                           v-model="personalDataHandling"/>
                    <label for="personalDataHandling"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">{{ trans("registration.personalDataProcessing.prefix") }}<a href="/policy" class="hover:underline">{{ trans("registration.personalDataProcessing.text") }}</a></label>
                </div>
                <button type="button"
                        class="inline-flex items-center px-5 py-2.5 mt-5 sm:mt-10 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600 mr-1"
                        @click.prevent="onClear">
                    {{ trans("registration.resetButton") }}
                </button>

                <button type="submit"
                        :class="isAtLeastOneGroupSelected() && personalDataHandling ? 'inline-flex items-center px-5 py-2.5 mt-5 sm:mt-10 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800'
                        : 'text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center'"
                        :disabled="!(isAtLeastOneGroupSelected() && personalDataHandling)"
                    >
                    {{ trans("registration.submitButton") }}
                </button>

            </form>
        </div>
    </section>
    <section v-if="registrationSuccess"><p class="block text-2xl mt-0 ml-2 font-medium text-gray-900 dark:text-white">
        {{ trans("registration.registrationSuccess") }}</p></section>
</template>
<script setup>
import {computed, ref} from 'vue';
import axios from "axios";
import dayjs from 'dayjs';
import vSelect from 'vue-select';
import {trans, wTrans} from "laravel-vue-i18n";

const props = defineProps(["routeSave", "routeFindAthlete", "competition", "qualifications", "regions", "sport_schools", "sport_organisations"]);
const competition_copy = ref(props.competition);
competition_copy.value.groups.forEach(group => {
    group.participate_teams = group.includes_teams === 1;
    group.participate_mixed_teams = competition_copy.value.includes_mixed_team_events === 1;
});

const enrichedRegions = computed(() => props.regions.map(region => {
    region.full_name = region.is_country
        ? trans("countries." + region.code)
        : trans("regions." + region.code);
    return region;
}).sort((a, b) => {
    if (a.is_country !== b.is_country) {
        return b.is_country - a.is_country;
    }

    return ('' + a.full_name).localeCompare(b.full_name)
}));

const athlete = ref({
    athlete_id: '',
    competition_id: '',
    first_name: '',
    surname: '',
    patronymic: '',
    noMiddleName: false,
    gender: '',
    birth_date: '',
    qualification: 'NO',
    region_code: null,
    sport_school_code: '',
    sport_organisation_code: '',
    sport_school_or_club: "",
    contact_information: '',
    coach_name: '',
    using_chair: ''
});

const athletes = ref([]);
const registrationSuccess = ref(false)
let athleteRequestsCache = {};

const errorMessages = {
    "ALREADY_EXISTS": wTrans("registration.error.global.athleteAlreadyRegistered"),
    "INVALID_GENDER_FOR_GROUP": wTrans("registration.error.global.invalidGenderForGroup"),
    "INVALID_BIRTH_DATE_FOR_GROUP": wTrans("registration.error.global.invalidBirthDateForGroup"),
    "INVALID_QUALIFICATION_FOR_GROUP": wTrans("registration.error.global.invalidQualificationForGroup"),
    "DIFFERENT_CLASSES_IN_SAME_COMPETITION": wTrans("registration.error.global.differentClassesInSameCompetition")
}

const formErrors = ref({
    surname: false,
    first_name: false,
    patronymic: false,
    gender: false,
    birth_date: false,
    region: false,
    contact_information: false,
    coach_name: false
});
const globalErrors = ref([]);
const personalDataHandling = ref(false);

const namePattern = /^[^\d.,!@#$%^&*()_+=\[\]{}\\|;:"<>\/?~№]+$/;
const genderPattern = /^[MF]{1}$/;
const requiredTextPattern = /^.{2,}$/;

function formatGenders(genders) {
    return genders
        .map((gender) => gender === "M" ? trans("registration.gender_M_short") : trans("registration.gender_F_short"))
        .reduce((converted, gender) => converted + (converted !== "" ? ", " : "") + gender, "");
}

function regionSelectValidate() {
    formErrors.value.region = athlete.value.region_code === null;
}

function searchAthlete(ignoreFormData = false) {
    if (!ignoreFormData && (athlete.value.surname.length > 0 || athlete.value.first_name.length > 0 || athlete.value.patronymic.length > 0)) {
        return;
    }

    if (athlete.value.surname.length > 2) {
        if (athlete.value.surname in athleteRequestsCache) {
            athletes.value = athleteRequestsCache[athlete.value.surname];
            return;
        }

        axios.get(props.routeFindAthlete, {
            params: {
                surname: athlete.value.surname,
                competition_id: props.competition.id
            }
        }).then((response) => {
            athletes.value = response.data.athletes;
            athleteRequestsCache[athlete.value.surname] = response.data.athletes;
        })
    }
}

function isGroupAvailable(group) {
    const isAthleteDataKnown =
        athlete.value.surname !== '' && formErrors.value.surname === false &&
        athlete.value.first_name !== '' && formErrors.value.first_name === false &&
        //группы не скрываются если не ввели отчество, но скрываются если были ошибки его валидации
        //иначе люди будут не понимать почему нет доступных групп
        (athlete.value.noMiddleName || formErrors.value.patronymic === false) &&
        athlete.value.gender !== '' && formErrors.value.gender === false &&
        athlete.value.birth_date !== '' && formErrors.value.birth_date === false &&
        athlete.value.region_code !== '' && formErrors.value.region === false;

    const atLeastOneGroupSelected = isAtLeastOneGroupSelected();

    //если пол спортсмена еще неизвестен - не фильтруем по полу
    const genderCriteriaMet = isAthleteDataKnown && group.allowed_genders.includes(athlete.value.gender);

    //проверим классы всех групп, где уже заявлено участие - спортсмен может участвовать только в одном классе
    const sameClassCriteriaMet = !atLeastOneGroupSelected ||
        competition_copy.value.groups.some(c_group => c_group.participation && c_group.class_code == group.class_code);

    //дата рождения спортсмена должна попадать между минимальной (если определена) и максимальной датой рождения, определенной для группы
    const birthDateCriteriaMet = isAthleteDataKnown &&
        (group.min_birth_date === null || (group.min_birth_date != null && dayjs(athlete.value.birth_date).diff(dayjs(group.min_birth_date)) >= 0) &&
            dayjs(athlete.value.birth_date).diff(dayjs(group.max_birth_date)) <= 0);

    const qualificationCriteriaMet = isAthleteDataKnown && (!competition_copy.value.use_sport_qualification ||
        (props.qualifications.find(qualification => qualification.code === athlete.value.qualification).order >= group.min_qualification.order));

    return genderCriteriaMet && sameClassCriteriaMet && birthDateCriteriaMet && qualificationCriteriaMet;
}

function isAtLeastOneGroupSelected() {
    return competition_copy.value.groups.some(group => group.participation);
}

function resetParticipation() {
    competition_copy.value.groups.forEach(group => group.participation = false);
}

function resetFormErrors() {
    formErrors.value = {
        surname: false,
        first_name: false,
        patronymic: false,
        gender: false,
        birth_date: false,
        region: false,
        contact_information: false,
        coach_name: false,
    }
    globalErrors.value = [];
}

let preventAthletesSearchResultsCleanup = false;

function onSurnameFocusOut() {
    validateModel(athlete.value.surname, namePattern, "surname");
    if (!preventAthletesSearchResultsCleanup) {
        athletes.value = [];
    }
}

function onNoMiddleNameChange() {
    if (athlete.value.noMiddleName) {
        formErrors.value.patronymic = '';
        athlete.value.patronymic = '';
    } else {
        resetParticipation();
    }
}

function validateModel(model, pattern, errorTarget) {
    formErrors.value[errorTarget] = !pattern.test(model) || model === null;
}

function validatePatronymic() {
    formErrors.value.patronymic = false;
    if (athlete.value.noMiddleName === false) {
        validateModel(athlete.value.patronymic, namePattern, "patronymic");
    }
}

function validateBirthDate() {
    formErrors.value.birth_date = !dayjs(athlete.value.birth_date, 'YYYY-MM-DD', true).isValid() ||
        dayjs(athlete.value.birth_date).isAfter(dayjs());
}

function onSubmit() {
    if (!personalDataHandling.value) {
        return;
    }

    resetFormErrors();

    onSurnameFocusOut();
    validateModel(athlete.value.first_name, namePattern, "first_name");
    validatePatronymic();
    validateModel(athlete.value.gender, genderPattern, "gender");
    validateBirthDate();
    regionSelectValidate();
    validateModel(athlete.value.contact_information, requiredTextPattern, 'contact_information');
    validateModel(athlete.coach_name, requiredTextPattern, 'coach_name');

    athlete.value.competition_id = props.competition.id;

    if (Object.values(formErrors.value).every((value) => value === false) && (globalErrors.value.length === 0)) {
        axios.post(props.routeSave, {
            groups: competition_copy.value.groups
                .filter((group) => group.participation == true)
                .map(function (group) {
                    let result = {};
                    for (const property in group) {
                        if (["id", "participation", "participate_teams", "participate_mixed_teams"].includes(property)) {
                            result[property] = group[property];
                        }
                    }

                    return result;
                }),
            ...athlete.value,
        }).then(response => {
            if (response.data.status === "ok") {
                athleteRequestsCache = {};
                registrationSuccess.value = true;
            }
        }).catch(e => {
            if (e.response && e.response.data && e.response.data.errors) {
                globalErrors.value = e.response.data.errors;
            } else {
                alert(trans("registration.error.unknown"));
            }
        });
    }
}

function onClear() {
    if (!confirm(trans("registration.confirmReset"))) {
        return;
    }

    athlete.value = {
        athlete_id: '',
        first_name: '',
        surname: '',
        patronymic: '',
        noMiddleName: false,
        gender: '',
        birth_date: '',
        qualification: "NO",
        region_code: null,
        sport_school_code: null,
        sport_organisation_code: null,
        sport_school_or_club: null,
        contact_information: '',
        coach_name: '',
        using_chair: false
    }

    personalDataHandling.value = false;
}

function fillForm(data) {
    athlete.value.athlete_id = data.id;
    athlete.value.first_name = data.first_name;
    athlete.value.surname = data.surname;
    athlete.value.patronymic = data.patronymic;
    athlete.value.noMiddleName = false;
    athlete.value.gender = data.gender;
    athlete.value.birth_date = dayjs(data.birth_date).format("YYYY-MM-DD");
    athlete.value.region_code = enrichedRegions.value.map(region => region.code).includes(data.region_code)
        ? data.region.code
        : null;
    athlete.value.qualification = data.qualification.code;
    athlete.value.using_chair = data.using_chair == 1;

    athletes.value = [];
    resetParticipation();
    resetFormErrors();
}

</script>

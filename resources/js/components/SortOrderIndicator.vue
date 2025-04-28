<template>
    <th :class="hideForNarrowScreen ? 'px-4 py-3 hover:cursor-pointer hidden sm:table-cell w-1' : 'px-4 py-3 hover:cursor-pointer sm:table-cell w-1'">
        <svg v-if="!isAsc() && !isDesc()"
             class="w-4 h-4 text-gray-200 dark:text-gray-700" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
             viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                  clip-rule="evenodd"/>
        </svg>
        <svg v-if="isAsc()"
             class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
             viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                  clip-rule="evenodd"/>
        </svg>
        <svg v-if="isDesc()"
             class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
             viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M5.575 13.729C4.501 15.033 5.43 17 7.12 17h9.762c1.69 0 2.618-1.967 1.544-3.271l-4.881-5.927a2 2 0 0 0-3.088 0l-4.88 5.927Z"
                  clip-rule="evenodd"/>
        </svg>
    </th>
</template>
<script setup>
const props = defineProps({
    field: String,
    division_code: String,
    class_code: String,
    orderBy: Object,
    hideForNarrowScreen: {
        type: Boolean,
        default: true
    }
});

function isAsc() {
    return props.orderBy[props.division_code + props.class_code] != null &&
        props.orderBy[props.division_code + props.class_code].field === props.field &&
        props.orderBy[props.division_code + props.class_code].order === 'asc';
}

function isDesc() {
    return props.orderBy[props.division_code + props.class_code] != null &&
        props.orderBy[props.division_code + props.class_code].field === props.field &&
        props.orderBy[props.division_code + props.class_code].order === 'desc';
}
</script>

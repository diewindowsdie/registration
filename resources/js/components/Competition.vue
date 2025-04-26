<template>
    <div class="p-10 dark:text-gray-100">
        <h1>{{data.title}}, {{data.start_date}} - {{data.end_date}}</h1>
        <p>Регистрация: {{data.registration_start}} - {{data.registration_finish}}</p>
        <div v-if="data.competition_includes_teams === 1" class="shadow-sm p-10 border-gray-200 dark:border-gray-700 border">команды</div>
        <div v-if="data.competition_includes_mixed_teams === 1" class="shadow-sm p-10 border-gray-200 dark:border-gray-700 border">миксы</div>
        Соревнование включает группы:
        <div class="shadow-sm p-10 border-gray-200 dark:border-gray-700 border" v-for="group in data.groups">
            <p>{{ group.division.title }} {{ group.class_code.title }}</p>
            <p v-if="group.allowed_genders != null">Разрешенный пол спортсмена: {{group.allowed_genders}}</p>
            <p v-if="group.min_birth_date != null">Дата рождения спортсмена, от: {{group.min_birth_date}}</p>
            <p v-if="group.max_birth_date != null">Дата рождения спортсмена, до: {{group.max_birth_date}}</p>
        </div>
        <a :href="'registration/' + data.id" class="underline underline-offset-2 text-blue-500">Зарегистрироваться: {{data.id}}</a>
    </div>
</template>

<script setup>
const props = defineProps(["data"]);
</script>

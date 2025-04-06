<template>
    <div class="bg-white shadow-sm p-10">
        <h1>{{data.title}}, {{data.start_date}} - {{data.end_date}}</h1>
        <p>Регистрация: {{data.registration_start}} - {{data.registration_finish}}</p>
        <div v-if="data.competition_includes_teams === 1" class="bg-white shadow-sm p-10">команды</div>
        <div v-if="data.competition_includes_mixed_teams === 1" class="bg-white shadow-sm p-10">миксы</div>
        Соревнование включает группы:
        <div class="bg-white shadow-sm p-10" v-for="group in data.groups">
            <p>{{group.division.title}} {{group.archery_class.title}}</p>
            <p v-if="group.allowed_genders != null">Разрешенный пол спортсмена: {{group.allowed_genders}}</p>
            <p v-if="group.min_birth_date != null">Дата рождения спортсмена, от: {{group.min_birth_date}}</p>
            <p v-if="group.max_birth_date != null">Дата рождения спортсмена, до: {{group.max_birth_date}}</p>
        </div>
        <a :href="'registration/' + data.id">Зарегистрироваться: {{data.id}}</a>
    </div>
</template>
<script setup>
const props = defineProps(["data"]);
</script>

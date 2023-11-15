<script setup>
import axios from 'axios';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import Hero from './Front-end/Partials/Hero.vue';
import Articles from './Front-end/Partials/Articles.vue';


const props = defineProps({

})



</script>

<template>
    <MainLayout>

        <Head title="Accueil" />

        <Hero />
        <Articles />


    </MainLayout>
</template>


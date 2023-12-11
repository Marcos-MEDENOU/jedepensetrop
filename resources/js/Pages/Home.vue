<script setup>
import axios from 'axios';
import { Head } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import Hero from './Front-end/Partials/Hero.vue';
import Articles from './Front-end/Partials/Articles.vue';


const props = defineProps({
    user: {
        type: Object,
        required: true
    },

    categories: {
        type: Object,
        required: true
    },

    LatestPost: {
        type: Object,
        required: true
    },

    PreviousThreePosts: {
        type: Object,
        required: true
    },

    ThreeByCategory: {
        type: Object,
        required: true
    },

    TopThreePosts: {
        type: Object,
        required: true
    },
})



</script>

<template >
    <MainLayout :user="props.user" :categories="props.categories">

        <Head title="Accueil" />

        <Hero />

        <Articles :LatestPost="props.LatestPost" :PreviousThreePosts="props.PreviousThreePosts"
            :ThreeByCategory="props.ThreeByCategory" :TopThreePosts="props.TopThreePosts" />


    </MainLayout>
</template>


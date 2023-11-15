<script setup>
import axios from 'axios';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import Hero from './Front-end/Partials/Hero.vue';
import Articles from './Front-end/Partials/Articles.vue';
const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
})

</script>
<template>
    <MainLayout>

        <Head title="Accueil" />

        <div class="relative h-[700px] flex items-center justify-center transition-all ">
            <!-- Fond d'écran en arrière-plan -->
            <transition name="fade" mode="in-out">
                <img :src="'/images/' + props.post.image" :alt="props.post.title"
                    class="absolute inset-0 w-full h-full object-cover transition-opacity transition-filter"
                    style="filter: brightness(0.5);" />
            </transition>
            <span
                class="absolute text-2xl z-10 inline-flex px-3 py-2 mt-3 ml-3 font-medium text-white bg-[#e39a00] rounded-lg select-none">
                {{ props.post['category'].name }}
            </span>
        </div>

        <div class="container mx-auto my-8">
    <div class="flex justify-between items-center border-b pb-4">
        <div class="text-gray-700">
            <p class="font-semibold text-lg">Auteur : {{ props.post['author'].name }}</p>
            <p class="font-semibold text-lg">Catégorie : {{ props.post['category'].name }}</p>
        </div>
        <div class="text-gray-700">
            <p class="font-semibold text-lg">Publié le {{ props.post['created_at'] }}</p>
            <p class="font-semibold text-lg">Dernière mise à jour le {{ props.post['updated_at'] }}</p>
        </div>
    </div>

    <div class="mt-6 mb-12">
        <h1 class="text-4xl font-bold mb-4">{{ props.post.title }}</h1>
        <div class="prose">
            <div v-html="props.post['content']"></div>
        </div>
    </div>
</div>




    </MainLayout>
</template>


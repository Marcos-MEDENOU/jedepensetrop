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

        <div class="relative h-[500px] flex items-center justify-center transition-all ">
            <!-- Fond d'écran en arrière-plan -->
            <transition name="fade" mode="in-out">
                <img :src="'http://127.0.0.1:8000/storage/uploads/' + props.post.image" :alt="props.post.title"
                    class="absolute inset-0 object-cover w-full h-full transition-opacity transition-filter"
                    style="filter: brightness(0.5);" />
            </transition>
            <span
                class="absolute text-2xl z-10 inline-flex px-3 py-2 mt-3 ml-3 font-medium text-white bg-[#e39a00] rounded-lg select-none">
                {{ props.post['category'].name }}
            </span>
        </div>

        <div class="container mx-auto my-8 w-[800px]">
            <div class="flex items-center justify-between pb-4 border-b">
                <div class="text-gray-700">
                    <!-- <p class="text-lg font-semibold">Auteur : {{ props.post['author'].name }}</p> -->
                    <p class="text-lg font-semibold">Catégorie : {{ props.post['category'].name }}</p>
                </div>
                <div class="text-gray-700">
                    <p class="text-lg font-semibold">Publié le {{ props.post['created_at'] }}</p>
                    <p class="text-lg font-semibold">Dernière mise à jour le {{ props.post['updated_at'] }}</p>
                </div>
            </div>

            <div class="mt-6 mb-12">
                <h1 class="mb-4 text-5xl font-bold text-[#e39a00]">{{ props.post.title }}</h1>
                <div class="prose">
                    <div id="editor" v-html="props.post['content']"></div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-8 border-t border-gray-300">
                <div class="text-gray-700 cursor-pointer ">
                    <span class="p-5 text-lg font-bold text-white bg-green-500 rounded-lg shadow-md hover:scale-50 hover:bg-green-600"> Article précédent</span>
                    <span class="block mt-8 text-lg font-bold">Titre de l'article précédent</span>
                </div>
                <div class="text-gray-700 cursor-pointer ">
                    <span class="p-5 mb-5 text-lg font-bold text-white bg-green-500 rounded-md shadow-lg hover:scale-50 hover:bg-green-600"> Article suivant</span>
                    <span class="block mt-8 text-lg font-bold">Titre de l'article suivant</span>
                </div>
            </div>

        </div>




    </MainLayout>
</template>

<style>
#editor h1 {
  font-weight: bold;
  margin-block: 2rem;
  font-size: 36pt;
  /* font-family: DMSans; */
}

#editor h2 {
  font-weight: bold;
  margin-block: 1rem;
  font-size: 24pt;
}

#editor h3 {
  text-decoration: underline;
  font-size: 18pt;
}

#editor p,
#editor ul,
#editor table {
  font-size: 12pt;
  /* font-family: DMSans; */
  padding-block: 5pt;
}

#editor table.full {
  display: block;
  background-color: white;
}

#editor h3 {
  text-decoration: underline
}
</style>
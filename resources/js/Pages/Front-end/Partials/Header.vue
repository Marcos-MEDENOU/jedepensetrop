<script setup>
import { Head } from "@inertiajs/vue3";
import Icon from '@/Components/Icons/Icon.vue'
import { onMounted, ref } from "vue";
import axios from "axios";


// Fonction me permettant de récupérer les catégorie dans la base de données
let categories = ref(null)

const getCategories = () => {
    axios.get('/getcategories')
        .then(response => {
            // Gérer la réponse ici
            console.log(response.data.categories);
            categories.value = response.data.categories;
        })
        .catch(error => {
            // Gérer les erreurs ici
            console.error('Erreur lors de la récupération des catégories:', error);
        });
};

onMounted(() => {
    getCategories();
});


</script>

<template>
    <Head title="Accueil" />

    <div style="background-color: whitesmoke" class="  w-full z-50">
        <nav
            class=" flex justify-between items-center mx-auto container py-2">


            <!-- Logo Container -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="/" class="cursor-pointer">
                    <h3 class="text-2xl font-medium text-blue-500">
                        <img class="object-cover h-14" src="/images/jdtblog.png" alt="BlogLogo">
                    </h3>
                </a>
            </div>



            <!-- Icon Menu Section -->
            <div class="flex -mx-2">
                <a class="text-gray-500 cursor-pointer hover:scale-105">
                    <svg fill="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-10 h-10 rounded-full border-2 border-[#000] px-2" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500 cursor-pointer hover:scale-105">
                    <svg fill="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-10 h-10 rounded-full border border-2 border-[#000] px-2 " viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500 cursor-pointer hover:scale-105">
                    <svg fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-10 h-10 rounded-full border border-2 border-[#000] px-2" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500 cursor-pointer hover:scale-105">
                    <svg fill="#000" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="0"
                        class="w-10 h-10 rounded-full border border-2 border-[#000] px-2" viewBox="0 0 24 24">
                        <path stroke="2"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="2"></circle>
                    </svg>
                </a>
            </div>


        </nav>
    </div>

    <ul class="sticky top-0 z-50 justify-center flex items-center gap-5 bg-[#ffcd00] h-20 w-full">
        <li>
            <a href="/" class="px-3 py-2 text-lg font-semibold hover:underline">Accueil</a>
        </li>
        <li v-for="(categorie, index) in categories" :key="index">
            <a href="/" class="px-3 py-2 text-lg font-semibold hover:underline">{{ categorie.name }}</a>
        </li>

        <!-- Formulaire de recherche -->

        <form @submit.prevent="submitForm" class="ml-5">

            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <Icon name="search" />
                </div>
                <input v-model="searchQuery" placeholder="Rechercher..." type="search" id="default-search"
                    class="block w-56  h-10  ps-10 text- text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>

            </div>
        </form>

    </ul>
</template>

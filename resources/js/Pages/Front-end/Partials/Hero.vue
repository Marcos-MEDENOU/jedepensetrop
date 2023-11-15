<template>
    <div class="relative h-[700px] flex items-center justify-center transition-all ">
        <!-- Fond d'écran en arrière-plan -->
        <transition name="fade" mode="in-out">
            <img :src="currentBackground" :key="currentBackground"
                class="absolute inset-0 w-full h-full object-cover transition-opacity transition-filter"
                style="filter: brightness(0.5);" />
        </transition>


        <!-- Contenu au centre -->
        <div class="absolute top-28 text-center flex items-center text-white">
            <!-- Mascotte avec punchlines -->
            <img src="/images/mascotte.png" alt="Mascotte" class="  " />
            <transition name="fade" mode="out-in">
                <div :key="currentPunchline" class="mb-4 w-96 ">
                    <p class="text-4xl">{{ currentPunchline }}</p>
                </div>
            </transition>
        </div>


        <!-- Formulaire de recherche -->

        <form @submit.prevent="submitForm" class="absolute top-5 right-5 ">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input v-model="searchQuery" placeholder="Rechercher..." type="search" id="default-search"
                    class="block w-56  h-10  ps-10 text- text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>

            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';

const backgrounds = [

    "/images/blogs.jpg",
];

const punchlines = [
    "La finance au service de tous.",
    "Investir pour un avenir meilleur.",
    "Construisons ensemble votre succès financier.",
    "Épargner aujourd'hui, c'est investir dans votre demain.",
    "Découvrez des opportunités financières illimitées.",
    "La clé du succès financier est entre vos mains.",
    "La richesse commence par une vision financière claire.",
    "Chaque dépense est une opportunité d'économiser.",
    "Soyez le maître de votre destin financier.",
    "Transformez vos rêves en réalité avec une planification financière solide.",
    "Les petites économies aujourd'hui mènent aux grandes richesses demain.",
];

const currentBackground = ref(backgrounds[0]);
let currentIndex = 0;

const currentPunchline = ref(punchlines[0]);
let currentPunchlineIndex = 0;

const searchQuery = ref('');



const changePunchline = () => {
    currentPunchlineIndex = (currentPunchlineIndex + 1) % punchlines.length;
    currentPunchline.value = punchlines[currentPunchlineIndex];
};

const submitForm = () => {
    // Logique de soumission du formulaire ici
    console.log('Recherche soumise:', searchQuery.value);
};

onMounted(() => {

    // Change la punchline toutes les 5 secondes
    setInterval(changePunchline, 5000);
});
</script>

<style scoped></style>

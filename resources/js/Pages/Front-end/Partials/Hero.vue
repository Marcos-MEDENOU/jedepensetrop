<template>
    <div class="relative h-[700px] flex items-center justify-center transition-all ">

        <!-- Fond d'écran en arrière-plan -->
        <transition name="fade" mode="in-out">
            <img :src="currentBackground" :key="currentBackground"
                class="absolute inset-0 object-cover w-full h-full transition-opacity transition-filter"
                style="filter: brightness(0.5);" />
        </transition>


        <!-- Contenu au centre -->
        <div class="absolute flex flex-col items-center justify-center px-10 text-white md:top-28 top-24 md:flex-row md:mb-20">
            <!-- Mascotte avec punchlines -->
            <img src="/images/masso.png" alt="Mascotte" class="floating-image " />
            <transition name="fade" mode="out-in">
                <div :key="currentPunchline" class="flex justify-center mb-4 text-center transition-opacity md:w-96 md:mr-20">
                    <p class="text-3xl md:text-4xl ">{{ currentPunchline }}</p>
                </div>
            </transition>
        </div>



    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
const props = defineProps({
    user:{
        type: Object,
        required:true
    }
})
const backgrounds = [

    "/images/blogs.jpg",
];

const punchlines = [
    " JE DEPENSE ? NON...! \n JE DEPENSE TROP.",
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
};

onMounted(() => {

    // Change la punchline toutes les 5 secondes
    setInterval(changePunchline, 8000);
});
</script>

<style scoped>
/* Ajout d'une transition en douceur */
.fade-enter-active,
.fade-leave-active {
    transition: opacity  ease-in-out;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
    transition: 0.5s ease-in-out
}

.floating-image {
    /* Ajustez la taille de votre image selon vos besoins */
    height: auto;
    animation: floatUpDown 4s ease-in-out infinite;
    /* Ajustez la durée selon vos besoins */
}

@keyframes floatUpDown {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(5px);
        /* Ajustez la distance de déplacement selon vos besoins */
    }
}</style>

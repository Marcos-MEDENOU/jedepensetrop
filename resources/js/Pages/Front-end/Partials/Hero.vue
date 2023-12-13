<template>
    <div class="relative md:h-[700px] h-[550px] flex items-center justify-center transition-all ">

        <!-- Fond d'écran en arrière-plan -->
        <transition name="fade" mode="in-out">
            <img :src="currentBackground" :key="currentBackground"
                class="absolute inset-0 object-cover w-full h-full transition-opacity transition-filter" />
        </transition>


        <!-- Desktop -->


        <img src="/images/masso.png" alt="Mascotte" class="absolute w-80 md:w-96 bottom-5" />

    <p class="absolute flex items-center h-auto px-5 py-5 mx-5 mb-16 italic tracking-wider bg-white shadow-xl cross w- md:w-96 md:mx-10 md:mb-80 bg-opacity-90 rounded-3xl md:h-40 top-12">
        <transition name="fade" mode="out-in">
            <div :key="currentPunchline">
                <p class="text-base md:text-xl">{{ currentPunchline }}</p>
                <div class="triangle"></div>
            </div>
        </transition>
    </p>




    </div></template>

<script setup>

import { ref, watch, onMounted } from 'vue';
const props = defineProps({
    user: {
        type: Object,
        required: true
    }
})

const backgrounds = [

    "/images/blog.jpg",
];

const punchlines = [
    " Je dépense ? Non...! \n Je dépense trop.",
    "Je dépense tellement que mon banquier pense que je suis son meilleur client.",
    "Je suis comme une machine à dépenser, j'ai un bouton 'acheter' à la place du cerveau.",
    "Je suis tellement doué pour dépenser de l'argent que je pourrais gagner une médaille d'or aux Jeux Olympiques du shopping.",
    "Ma carte de crédit me regarde avec un sourire diabolique chaque fois que je l'utilise.",
    "Mon compte en banque a une phobie des chiffres à zéro. Il préfère être négatif.",
    "Je suis comme un aimant à boutiques. Je ne peux pas résister à l'appel des soldes.",
    "Je dépense tellement que même les distributeurs automatiques me donnent des conseils financiers.",
    "Mon compte en banque fait un régime, mais mes dépenses sont en mode festin!",
    "Je suis le Picasso des achats impulsifs, mes dettes sont mes chefs-d'œuvre!",
    "Ma devise, c'est Je dépense donc je suis... à découvert.",
    "Je suis la preuve vivante que l'argent brûle des calories, car je dépense comme si j'étais en plein marathon financier.",
    "Quand il s'agit de dépenser, je suis comme une fusée : je décolle rapidement et je retombe en cendres en un rien de temps.",
    "Je suis tellement bon pour dépenser de l'argent, même ma carte de crédit me fait un high-five à chaque achat.",
    "Mon compte en banque est comme un trampoline, il ne cesse de rebondir entre 'solde critique' et 'découvert interdit'.",
    "Mon addiction aux achats est tellement grave que je devrais ouvrir un compte d'épargne appelé 'J'arrête-demain'.",
    "Je suis comme un aimant à dépenses, tout ce qui brille me coûte un bras.",
    "Mes économies sont parties en vacances permanentes, et mon compte en banque n'a même pas reçu une carte postale."
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
    transition: opacity ease-in-out;
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


/* p.cross {
    position: absolute;
    top: 50px;
    right: 500px;
    width: 500px;
    padding: 20px 20px;
    margin: 10px 10px 80px 40px;
    background: #ffffffdc;
    border-radius: 3px;
    border-bottom-left-radius: 10px;
    box-shadow: -3px 4px 8px #989898;
    letter-spacing: .06em;
} */

/******NOW CREATE THE cross CIRCLES*****/
/****FIRST THE LARGE CIRCLE***/
p.cross:before {
    content: "";
    position: absolute;
    bottom: -40px;
    left: 50%;
    background: #ffffff;
    width: 30px;
    height: 30px;
    border-radius: 30px;
    box-shadow: -3px 3px 8px #989898;
}

/*****NOW THE SMALL CIRCLE***/
/**Created exactly the same way as the large circle, except with smaller width, height and border-radius**/
p.cross:after {
    content: "";
    position: absolute;
    bottom: -55px;
    left: 50%;
    width: 15px;
    height: 15px;
    background: #ffffff;
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
    -webkit-box-shadow: -3px 3px 4px #989898;
    -moz-box-shadow: -3px 3px 4px #989898;
    box-shadow: -3px 3px 8px #989898;
}

p.thought {
    position: absolute;
    top: 10px;
    right: 2px;
    width: 250px;
    padding: 20px 20px;
    margin: 10px 10px 80px 40px;
    background: #ffffffdc;
    border-radius: 3px;
    border-bottom-left-radius: 10px;
    box-shadow: -3px 4px 8px #989898;
    letter-spacing: .06em;
}

/******NOW CREATE THE THOUGHT CIRCLES*****/
/****FIRST THE LARGE CIRCLE***/
p.thought:before {
    content: "";
    position: absolute;
    /*see the support section below for more info*/
    bottom: -40px;
    /*distance from the bottom of the bubble*/
    left: 60px;
    /*distance from the left edge of the bubble*/
    background: #ecb00a;
    width: 30px;
    /*same as the height*/
    height: 30px;
    /*same as the width*/
    /*add a curve to the corners the same size as the height and width*/
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
    /*add a drop shadow*/
    -webkit-box-shadow: -3px 3px 4px #989898;
    -moz-box-shadow: -3px 3px 4px #989898;
    box-shadow: -3px 3px 8px #989898;
}

/*****NOW THE SMALL CIRCLE***/
/**Created exactly the same way as the large circle, except with smaller width, height and border-radius**/
p.thought:after {
    content: "";
    position: absolute;
    bottom: -55px;
    left: 50px;
    width: 15px;
    height: 15px;
    background: #ecb00a;
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
    -webkit-box-shadow: -3px 3px 4px #989898;
    -moz-box-shadow: -3px 3px 4px #989898;
    box-shadow: -3px 3px 8px #989898;
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
}
</style>

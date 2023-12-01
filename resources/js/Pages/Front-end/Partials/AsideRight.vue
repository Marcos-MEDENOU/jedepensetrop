<script setup>
import axios from 'axios';
import { ref, onMounted, reactive } from 'vue';
import Swal from 'sweetalert2';
import Chatbot from '../Partials/Chatbot.vue';
import { router } from '@inertiajs/vue3'

const data = reactive({
    recentPosts: [],
});


const newArticles = [
    {
        category: 'High-Tech',
        title: 'Lorem Ipsum Dolor',
        content: 'Lorem ipsum dolor lodicum opazalin dhiloh...',
        image: 'https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759872/kuldar-kalvik-799168-unsplash.webp',
    },
    {
        category: 'Immobilier',
        title: 'Lorem Ipsum Dolor2',
        content: 'Lorem ipsum dolor lodicum opazalin dhiloh...',
        image: 'https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759871/jason-leung-798979-unsplash.webp',
    },
    {
        category: 'Société',
        title: 'Lorem Ipsum Dolor',
        content: 'Lorem ipsum dolor lodicum opazalin dhiloh...',
        image: 'https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759871/alessandro-capuzzi-799180-unsplash.webp',
    },
];

const email = ref('');
const question = ref('');

const subscribe = () => {

    axios.post('/newsletters/store', {
        email: email.value,
        question: question.value,
    })
        .then(response => {

            if (response.data.successMessage) {

                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.data.successMessage,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            if (response.data.errorMessage) {

                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: response.data.errorMessage,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            email.value = '';
            question.value = '';
        })
        .catch(error => {
            Swal.fire({
                position: "center",
                icon: "error",
                title: error,
                showConfirmButton: false,
                timer: 1500
            });
            email.value = '';
            question.value = '';
        });
}

</script>


<template>
    <section class="sticky py-10 top-20">
        <!-- Articles liés -->
        <h1 class="mb-2 text-2xl font-bold">Articles les plus consultés</h1>
        <div class="grid grid-cols-1 gap-5 my-4 mb-20 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-1">

            <div v-for="(item, index) in newArticles" :key="index"
                class="relative flex flex-col gap-2 p-5 mb-3 bg-white rounded-md shadow-xl 2xl:h-32 ">
                <div class="shadow-xl 2xl:absolute 2xl:-left-6 2xl:top-4 ">
                    <img :src="item.image" alt="" class="w-full rounded-lg 2xl:h-24 2xl:w-24 h-36">
                </div>
                <div class="2xl:ml-16 h-28">
                    <span class="italic">-{{ item.category }}-</span>
                    <div class="font-semibold">{{ item.title }}</div>
                    <div class="font-">{{ item.content }}</div>

                    <div class="absolute bottom-1 right-4 px-3 py-1  font-medium text-white bg-[#e39a00]  rounded-lg">
                        <a href="#" class="">Lire plus</a>
                    </div>
                </div>
            </div>

        </div>


        <!-- Partners -->



        <section class='partners'>
            <h1 class="mt-10 mb-5 text-2xl font-bold">Nos partenaires</h1>
            <div class="slider">
                <div class="slide-track">
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" height="100" width="250"
                            alt="" />
                    </div>
                    <div class="slide">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" height="100" width="250"
                            alt="" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulaire d'abonnement à la newsletter -->
        <div class="mt-10">
            <h3 class="mb-2 text-2xl font-bold">Newsletter</h3>
            <p class="mb-2 text-gray-700">Abonnez-vous à notre newsletter pour les dernières mises à jour.</p>
            <form>
                <input v-model="email"
                    class="block w-full p-3 mb-5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    type="email" name="email" placeholder="Votre adresse e-mail" id="email" required="">

                <span @click="subscribe()"
                    class="w-full p-2 text-white bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-900">S'abonner</span>
                <p class="mt-2">Nous nous soucions de la protection de vos données. Lisez notre <a
                        class="text-blue-900 underline" href="/">politique de
                        confidentialité</a>.</p>
            </form>
        </div>
    </section>
    <Chatbot class="fixed  bottom-5 right-5 md:bottom-10 md:right-20" />
</template>
<style scope>
@import url('https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700,800');




@keyframes scroll {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(calc(-250px * 7));
    }
}

.slider {

    box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.125);
    height: 100px;
    margin: auto;
    overflow: hidden;
    position: relative;
    width: 350px;
    border-radius: 10px;
}

.slider::before,
.slider::after {
    background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
    content: "";
    height: 100px;
    position: absolute;
    width: 100px;
    z-index: 2;
}

.slider::after {
    right: 0;
    top: 0;
    transform: rotateZ(180deg);
}

.slider::before {
    left: 0;
    top: 0;
}

.slider .slide-track {
    animation: scroll 40s linear infinite;
    display: flex;
    width: calc(250px * 15);
}

.slider .slide {
    height: 100px;
    width: 250px;
}


/* Ajouter des media queries pour ajuster la taille sur différents écrans */
@media screen and (max-width: 768px) {
    .slider {
        width: 250px;
    }

    .slider .slide-track {
        width: calc(25% * 10);
    }
}
</style>

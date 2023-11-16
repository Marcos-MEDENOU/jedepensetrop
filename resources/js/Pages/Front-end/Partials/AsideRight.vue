<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
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


</script>


<template>
    <section class="py-10 lg:ml-24 sticky top-20">
        <!-- Articles liés -->
        <h1 class="text-2xl font-bold mb-2">Derniers Articles</h1>
        <div class="my-4">

            <div v-for="(item, index) in newArticles" :key="index"
                class="flex gap-2 mb-3 bg-white rounded-md shadow-xl p-5 relative h-32">
                <div class="absolute -left-6 shadow-xl top-4">
                    <img :src="item.image" alt="" class="h-24 w-24 rounded-lg">
                </div>
                <div class="ml-16">
                    <span class="italic">-{{ item.category }}-</span>
                    <div class="font-semibold">{{ item.title }}</div>
                    <div class="font-">{{ item.content }}</div>

                    <div
                        class="absolute bottom-1 right-4 px-3 py-1  font-medium text-white bg-[#e39a00]  rounded-lg">
                        <a href="#" class="">Lire plus</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Formulaire d'abonnement à la newsletter -->
        <div class="mt-10">
            <h3 class="text-2xl font-bold mb-2">Newsletter</h3>
            <p class="text-gray-700 mb-2">Abonnez-vous à notre newsletter pour les dernières mises à jour.</p>
            <form action="#" method="post">
                <input
                    class="block p-3  w-full  text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                    type="email" name="email" placeholder="Votre adresse e-mail" id="email" required="">

                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 rounded-lg text-white p-2 w-full">S'abonner</button>
                <p class="mt-2">Nous nous soucions de la protection de vos données. Lisez notre <a
                        class="text-blue-900 underline" href="/">politique de
                        confidentialité</a>.</p>
            </form>
        </div>
    </section>
</template>
<style scope>
@import url('https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700,800');
</style>

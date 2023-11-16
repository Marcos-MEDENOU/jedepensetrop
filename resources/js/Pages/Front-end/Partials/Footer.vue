<script setup>
import { Head } from "@inertiajs/vue3";
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


    <footer class="bg-[#ffcd00] dark:bg-gray-900 rounded-t-3xl  py-5">

        <div class="container flex  justify-between mx-auto mt-5">
            <a href="#">
                <img class="w-auto h-14" src="/images/jdtblog.png" alt="">
            </a>

            <ul class=" flex flex-col   ">
                <li class="font-bold text-2xl mb-5">Menu</li>
                <li v-for="(categorie, index) in categories" :key="index">
                    <a href="/" class="font-semibold hover:underline">{{ categorie.name }}</a>
                </li>
            </ul>

            <ul class=" flex flex-col   ">
                <li class="font-bold text-2xl mb-5">Entreprise</li>
                <li><a href="" class="font-semibold hover:underline">A propos</a></li>
                <li><a href="" class="font-semibold hover:underline">Politique de Confidentialité</a></li>
                <li><a href="" class="font-semibold hover:underline">Termes et Services</a></li>
            </ul>

            <div class="flex flex-col gap-2">

                <h1 class="font-bold text-2xl ">Newsletters</h1>
                <div class="mb-5">
                    <form>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-600">Adresse e-mail:</label>
                            <input type="email" id="email" name="email" class="mt-1 p-2 w-60  rounded-md shadow-lg border-0">
                        </div>

                        <button type="submit"
                            class="bg-gray-800 text-white p-2 rounded-md hover:bg-gray-900">S'abonner</button>
                    </form>
                </div>

                <div class="flex">


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
            </div>
        </div>
        <hr class="mt-5 border-t-2 border-black container mx-auto">
        <div class="container mx-auto text-center text-xl pt-5">
            &copy; 2023 jedepensetrop.fr
        </div>

    </footer>
</template>

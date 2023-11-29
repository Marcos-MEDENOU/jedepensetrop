<script setup>
import { Head } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import axios from "axios";
import Icon from '@/Components/Icons/Icon.vue'
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3'


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


const categoryPosts = (slug) => {
    console.log(slug);

    router.get(route("category_posts", slug))
};



const email = ref('');
const question = ref('');

const subscribe = () => {

    axios.post('/newsletter/store', {
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
    <footer class="bg-[#ffcd00] dark:bg-gray-900 rounded-t-3xl  py-5 px-20 ">

        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 justify-between mx-auto mt-5">
            <a href="/">
                <img class="w-36 h-10" src="/images/logoCharle.png" alt="">
            </a>

            <ul class=" flex flex-col   ">
                <li class="font-bold text-2xl mb-5">Menu</li>
                <li v-for="(categorie, index) in categories" :key="index">
                    <a @click="categoryPosts(categorie.slug)" class="font-semibold hover:underline cursor-pointer">{{
                        categorie.name }}</a>
                </li>
            </ul>

            <ul class=" flex flex-col   ">
                <li class="font-bold text-2xl mb-5">Entreprise</li>
                <li><a href="" class="font-semibold hover:underline cursor-pointer">A propos</a></li>
                <li><a href="" class="font-semibold hover:underline cursor-pointer">Politique de Confidentialité</a></li>
                <li><a href="" class="font-semibold hover:underline cursor-pointer">Termes et Services</a></li>
            </ul>

            <div class="flex flex-col gap-2">

                <h1 class="font-bold text-2xl ">Newsletters</h1>
                <div class="mb-5">
                    <form>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-600">Adresse e-mail:</label>
                            <input v-model="email" type="email" id="email" placeholder="Votre email" name="email"
                                class="mt-1 p-2 w-60  rounded-md shadow-lg border-0">
                        </div>

                        <span @click="subscribe()"
                            class="bg-gray-800 text-white p-2 rounded-md hover:bg-gray-900 cursor-pointer">S'abonner</span>
                    </form>
                </div>

                <!-- Icon Menu Section -->
                <div class="flex -mx-2 ">
                    <a href="https://www.facebook.com/VIPPInterstis" target="_blank"
                        class="text-gray-500 cursor-pointer hover:scale-105">
                        <Icon name="facebook" />

                    </a>

                    <a href="https://twitter.com/vipp_groupe" target="_blank"
                        class="ml-3 text-gray-500 cursor-pointer hover:scale-105">
                        <Icon name="twitter" />

                    </a>
                    <a href="https://www.instagram.com/vipp_________/?hl=am-et" target="_blank"
                        class="ml-3 text-gray-500 cursor-pointer hover:scale-105">
                        <Icon name="instagram" />

                    </a>
                    <a href="https://www.linkedin.com/company/groupe-vipp" target="_blank"
                        class="ml-3 text-gray-500 cursor-pointer hover:scale-105">
                        <Icon name="linkedin" />
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

<script setup>
import { Head } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import axios from "axios";
import Icon from '@/Components/Icons/Icon.vue'
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3'
const props = defineProps({
    user: {
        type: Object,
        required: true
    },

    categories: {
        type: Object,
        required: true
    },


})


// Fonction me permettant de récupérer les catégorie dans la base de données
let categories = ref(props.categories)


const getCategories = async () => {
    axios.get('/getcategories')
        .then(response => {
            // Gérer la réponse ici
            categories.value = response.data;
        })
        .catch(error => {
            // Gérer les erreurs ici
            console.error('Erreur lors de la récupération des catégories:', error);
        });
};

onMounted(async () => {
    await getCategories();
});



const categoryPosts = (slug) => {

    router.get(route("category_posts", slug))
};



const email = ref('');

const subscribe = () => {

    //Vérifier si un des élément est vide
    if (email.value.trim() == "" ) {
        Swal.fire({
            title: 'Attention',
            text: 'Veuillez remplir le champ, il est vide.',
            icon: 'warning',
        });
    } else {
        //verifier si email entrer est valide
        // Expression régulière pour vérifier une adresse e-mail simple
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        // Teste la chaîne de caractères avec l'expression régulière
        if (regexEmail.test(email.value)) {
            //
            axios.post('/newslettersHome/store', {

                email: email.value,

            })
                .then(response => {

                    if (response.data.successMessage) {

                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.data.successMessage,
                            showConfirmButton: true,

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


                })
                .catch(error => {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: error,
                        showConfirmButton: false,
                        timer: 3500
                    });
                    email.value = '';

                });

        } else {
            Swal.fire({
                title: 'Erreur',
                text: 'Email incorrecte',
                icon: 'error',
            });
        };

    }

}


</script>

<template>
    <footer class="bg-[#000] dark:bg-gray-900 rounded-t-3xl text-white py-5 md:px-20 px-5">

        <div class="container grid justify-between grid-cols-1 gap-10 mx-auto mt-5 md:grid-cols-2 lg:grid-cols-4">
            <a href="/">
                <img class="h-10 w-36" src="/images/logoCharle.png" alt="">
            </a>

            <ul class="flex flex-col ">
                <li class="mb-5 text-2xl font-bold">Menu</li>
                <li v-for="(categorie, index) in categories" :key="index">
                    <a @click="categoryPosts(categorie.slug)" class="font-semibold cursor-pointer hover:underline">{{
                        categorie.name }}</a>
                </li>
            </ul>

            <ul class="flex flex-col ">
                <li class="mb-5 text-2xl font-bold">Entreprise</li>
                <li><a href="" class="font-semibold cursor-pointer hover:underline">Qui sommes-nous?</a></li>
                <li><a href="" class="font-semibold cursor-pointer hover:underline">Politique de Confidentialité</a></li>
                <li><a href="" class="font-semibold cursor-pointer hover:underline">Termes et Services</a></li>
            </ul>

            <div class="flex flex-col gap-2">

                <h1 class="text-2xl font-bold ">Newsletters</h1>
                <div class="mb-5">
                    <form>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-600">Adresse e-mail:</label>
                            <input v-model="email" type="email" id="email" placeholder="Votre email" name="email"
                                class="p-2 mt-1 border-0 rounded-md shadow-lg w-60">
                        </div>

                        <span @click="subscribe()"
                            class="p-2 text-white bg-gray-800 rounded-md cursor-pointer hover:bg-gray-900">S'abonner</span>
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
        <hr class="container mx-auto mt-5 border-t-2 border-yellow">
        <div class="container pt-5 mx-auto text-xl text-center">
            &copy; 2023 jedepensetrop.fr
        </div>

    </footer>
</template>

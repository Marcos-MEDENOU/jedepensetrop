<script setup>
import { Head } from "@inertiajs/vue3";
import Icon from '@/Components/Icons/Icon.vue'
import Search from '@/Components/Search.vue'
import { onMounted, ref } from "vue";
import axios from "axios";
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




const categoryPosts = (slug) => {

    router.get(route("category_posts", slug))
};


const menuVisible = ref(false);
const showClosebtn = ref(false);
const showMenubtn = ref(true);

const showMenu = () => {
    menuVisible.value = !menuVisible.value
    showClosebtn.value = true;
    showMenubtn.value = false;
}

const closeMenu = () => {
    menuVisible.value = !menuVisible.value
    showClosebtn.value = false;
    showMenubtn.value = true;
}

</script>

<template>
    <div style="background-color: rgb(0, 0, 0)" class="z-50 w-full px-20 md:px-0">
        <nav
            class="container flex-row items-center justify-between hidden gap-5 py-2 mx-auto bg-transparent lg:top-0 lg:z-50 lg:flex 2xl:px-10 ">


            <!-- Logo Container -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="/" class="cursor-pointer">
                    <h3 class="text-2xl font-medium ">
                        <img class="h-10 w-36" src="/images/logoCharle.png" alt="BlogLogo">
                    </h3>
                </a>
            </div>

            <div class=" bottom-4 right-4 xl:right-20"
                v-if="user && ((user['roles'][0].name == 'super-admin' || user['roles'][0].name == 'writer'))">
                <a href="/dashboard" target="_blank"
                    class="flex items-center justify-between gap-4 px-4 py-1 font-mono font-semibold duration-500 ease-in-out transform bg-yellow-400 rounded-lg shadow animate-bounce hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Se connecter a l'espace admin
                </a>
            </div>

            <!-- {{ user["roles"][0].name == "user" }} -->


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


        </nav>
    </div>

    <ul class="hidden  sticky top-0 z-50 justify-center lg:flex items-center gap-5 bg-[#ffcd00] h-20 w-full px-10">
        <li>
            <a href="/" class="px-3 py-2 text-lg font-semibold hover:underline">Accueil</a>
        </li>
        <li v-for="(categorie, index) in categories" :key="index">
            <a @click="categoryPosts(categorie.slug)"
                class="px-3 py-2 text-lg font-semibold cursor-pointer hover:underline">{{ categorie.name }}</a>
        </li>

        <!-- Formulaire de recherche -->

        <Search/>

    </ul>


    <nav
        class="sticky top-0 left-0 right-0 z-50 flex items-center justify-between px-8 py-3 bg-black shadow-lg lg:hidden h-18">
        <!-- Logo Container -->
        <div class="flex items-center">
            <!-- Logo -->
            <a href="/" class="cursor-pointer">
                <h3 class="text-2xl font-medium">
                    <img class="h-10 w-36" src="/images/logoCharle.png" alt="BlogLogo">
                </h3>
            </a>
        </div>

        <!-- Bouton hamburger -->
        <div>
            <div class="cursor-pointer" @click="showMenu" v-if="showClosebtn == false">
                <Icon name="menubtn" />
            </div>
            <div class="cursor-pointer" @click="closeMenu" v-if="showMenubtn == false">
                <Icon name="closebtn" />
            </div>
        </div>

    </nav>


    <ul v-if="menuVisible"
        class="lg:hidden fixed top-[4.5rem]  shadow-md rounded-lg left-3 right-3 z-50 justify-center flex flex-col items-center gap-5 bg-[#000] h-96 text-white ">
        <li>
            <a href="/" class="px-3 py-2 text-lg font-semibold hover:underline">Accueil</a>
        </li>
        <li v-for="(categorie, index) in categories" :key="index">

            <a @click="categoryPosts(categorie.slug)"
                class="px-3 py-2 text-lg font-semibold cursor-pointer hover:underline">{{ categorie.name }}</a>
        </li>

        <!-- Formulaire de recherche -->

        <Search/>


    </ul></template>

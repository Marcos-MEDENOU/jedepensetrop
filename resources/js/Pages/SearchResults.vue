<script setup>
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Icons/Icon.vue'
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import AsideRight from './Front-end/Partials/AsideRight.vue';
import { format } from 'date-fns';
import { fr } from 'date-fns/locale';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },

    searchTerm: {
        type: Array,
        required: true,
    },


})

console.log(props.searchTerm);



const showArticle = (slug) => {
    console.log(slug);

    router.get(route("post.show", slug))
};


const nom = ref('');
const prenom = ref('');
const email = ref('');
const question = ref('');

const subscribe = () => {

    //Vérifier si un des élément est vide
    if (nom.value.trim() == "" || prenom.value.trim() == "" || email.value.trim() == "" || question.value.trim() == "") {
        console.log("kljhgl");
        Swal.fire({
            title: 'Attention',
            text: 'Veuillez remplir tous les champs du formulaire.',
            icon: 'warning',
        });
    } else {
        //verifier si email entrer est valide
        // Expression régulière pour vérifier une adresse e-mail simple
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        // Teste la chaîne de caractères avec l'expression régulière
        if (regexEmail.test(email.value)) {
            //
            axios.post('/newsletters/store', {
                lastname: nom.value,
                firstname: prenom.value,
                email: email.value,
                question: question.value,
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

                    nom.value = '';
                    prenom.value = '';
                    email.value = '';
                    question.value = '';

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
                    question.value = '';
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
const formatDate = (inputDate) => {
    if (!inputDate) {
        return null; // Ou une autre valeur par défaut appropriée
    }

    const [day, month, year] = inputDate.split('/').map(Number);

    // Vérifier si la date est valide
    if (isNaN(day) || isNaN(month) || isNaN(year)) {
        return null; // Ou une autre valeur par défaut appropriée
    }

    const dateInUTC = new Date(Date.UTC(year, month - 1, day)); // Note: Month is zero-based

    // Convertir la date à partir de l'UTC vers le fuseau horaire français
    return new Date(dateInUTC.toLocaleString('en-US', { timeZone: 'Europe/Paris' }));
};

const formatRelativeTime = (inputDate) => {
    const parsedDate = formatDate(inputDate);

    if (!parsedDate) {
        return 'Date invalide';
    }

    const formattedDate = format(parsedDate, 'dd MMMM yyyy', { locale: fr });

    return formattedDate;
};



</script>


<template>
    <MainLayout :categories="props.categories">

        <Head title="Search Result" />
        <div class="justify-center px-5 mt-8 2xl:flex xl:mx-0 md:px-20 xl:px-10">

            <div class="2xl:w-6/12 lg:12/12 ">



                <div v-if="props.searchTerm.length > 0" class="mb-10">
                    <h1 class="mb-5 text-3xl font-bold">Résultat(s)</h1>

                    <div class="grid grid-cols-1 gap-6 cursor-pointer lg:grid-cols-3 md:grid-cols-2 ">

                        <div v-for="(article, index) in props.searchTerm" :key="index"
                            class="transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg ">
                                    <div
                                        class="h-40 w-full xl:w-[50rem] transition-transform duration-500 ease-in-out transform hover:scale-110">

                                        <img :src="'/storage/images/' + article.folder + '/' + article.image" alt=""
                                            class="object-cover w-full h-full">

                                    </div>
                                    <span
                                        class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#e39a00] rounded-lg select-none">
                                        {{ article.category.name }}
                                    </span>
                                </div>


                                <div class="flex flex-col justify-center gap-2 mx-auto mt-8 ">

                                    <h1 class="h-20 text-xl font-bold">
                                        {{ article.title }}
                                    </h1>

                                    <div class="mt-5 text-gray-500">
                                        <p class="italic">
                                            {{ formatRelativeTime(article.published_at) }}
                                        </p>
                                        <p class="flex items-center gap-1 italic">
                                            <Icon name="clock" /> {{ article.duree < 10 ? '0' + article.duree :
                                                article.duree }} minutes </p>
                                    </div>

                                </div>


                            </div>
                        </div>


                    </div>
                </div>

                <div v-else>
                    <h1 class="mb-5 text-3xl font-bold">Aucun résultat(s)</h1>
                </div>



                <div class="bg-[#ffcd00] p-5 my-10 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Newsletter</h3>
                    <p class="mb-2 text-gray-700">Abonnez-vous à notre newsletter pour les dernières mises à jour.</p>
                    <!-- Formulaire -->
                    <form action="#" method="POST" class="flex flex-col items-center gap-5 ">
                        <div class="flex flex-col w-full gap-5 md:flex-row">
                            <!-- Champ de la question -->
                            <div class="flex flex-col w-full gap-2">
                                <input v-model="nom" type="text" id="nom" name="nom" placeholder="Votre nom"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 ">
                                <input v-model="prenom" type="text" id="prenom" name="prenom" placeholder="Votre prénom"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 ">

                            </div>

                            <!-- Champ de l'email -->
                            <div class="flex flex-col w-full gap-2 ">
                                <input v-model="email" type="email" id="email" name="email" required
                                    placeholder="Entrez votre adresse email"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 ">

                                <input v-model="question" type="text" id="question" name="question"
                                    placeholder="Posez votre question ici!"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Bouton Envoyer -->
                        <span @click="subscribe()"
                            class="px-4 py-2 text-white transition duration-300 bg-gray-800 rounded-md cursor-pointer hover:bg-gray-900">Envoyer</span>
                    </form>
                    <p class="mt-2">Nous nous soucions de la protection de vos données. Lisez notre <a
                            class="text-blue-900 underline" href="/">politique de
                            confidentialité</a>.</p>
                </div>


            </div>

            <!-- <div class="2xl:px-10 2xl:w-3/12 2xl:ml-20 ">
                <AsideRight :TopThreePosts="props.TopThreePosts" />
            </div> -->
        </div>
    </MainLayout>
</template>


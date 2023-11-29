<script setup>
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AsideRight from '../Partials/AsideRight.vue';
import Icon from '@/Components/Icons/Icon.vue'
import { format, differenceInSeconds, differenceInMinutes, differenceInHours, differenceInDays } from 'date-fns';
import { utcToZonedTime } from 'date-fns-tz';
import frLocale from 'date-fns/locale/fr';




const latestPost = ref([]);
const fetchLatestPost = async () => {
    try {
        const response = await axios.get('/latestPost');
        latestPost.value = response.data;
        console.log(latestPost.value)
    } catch (error) {
        console.error('Une erreur s\'est produite lors de la récupération des articles récents', error);
    }
};

const data = reactive({
    recentPosts: [],
});

const fetchPreviousThreePosts = async () => {
    try {
        const response = await axios.get('/previousThreePosts');
        data.recentPosts = response.data;
        console.log(data.recentPosts)
    } catch (error) {
        console.error('Une erreur s\'est produite lors de la récupération des articles récents', error);
    }
};

const dataByCategory = reactive({
    recentPosts: [],
});

const fetchThreeByCategory = async () => {
    try {
        const response = await axios.get('/showThreeByCategory');
        dataByCategory.recentPosts = response.data;
        console.log(dataByCategory.recentPosts)
    } catch (error) {
        console.error('Une erreur s\'est produite lors de la récupération des articles récents', error);
    }
};

onMounted(async () => {
    await fetchLatestPost();
    await fetchPreviousThreePosts();
    await fetchThreeByCategory()
});


const showArticle = (slug) => {
    console.log(slug);

    router.get(route("post.show", slug))
};

const nom = ref('');
const prenom = ref('');
const email = ref('');
const question = ref('');

const subscribe = () => {

    axios.post('/newsletter/store', {
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
                timer: 1500
            });
            email.value = '';
            question.value = '';
        });
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
    const currentDate = new Date();
    console.log(parsedDate);
    console.log(currentDate);

    if (!parsedDate) {
        return 'Date invalide';
    }

    const differenceInSecondsValue = Math.floor((currentDate - parsedDate) / 1000);
    const differenceInMinutesValue = Math.floor(differenceInSecondsValue / 60);
    const differenceInHoursValue = Math.floor(differenceInMinutesValue / 60);
    const differenceInDaysValue = Math.floor(differenceInHoursValue / 24);

    if (differenceInDaysValue > 1) {
        return format(parsedDate, 'dd MMMM yyyy', { locale: frLocale });
    } else if (differenceInHoursValue > 0) {
        return `il y a ${differenceInHoursValue} ${differenceInHoursValue > 1 ? 'heures' : 'heure'}`;
    } else if (differenceInMinutesValue > 0) {
        return `il y a ${differenceInMinutesValue} ${differenceInMinutesValue > 1 ? 'minutes' : 'minute'}`;
    } else {
        return `il y a ${differenceInSecondsValue} ${differenceInSecondsValue > 1 ? 'secondes' : 'seconde'}`;
    }
};


</script>


<template>
    <div class="justify-center px-5 mt-8 2xl:flex xl:mx-0 md:px-20 xl:px-10 md:">

        <div class="2xl:w-6/12 lg:12/12 ">

            <h1 class="mb-5 text-3xl font-bold">Articles les plus récents</h1>

            <div class="mb-10 transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                <div @click="showArticle(article.slug)" class="p-4 mb-10 bg-white rounded-lg shadow">
               

                    <div @click="showArticle(latestPost.slug)" class="relative w-full rounded-lg cursor-pointer">
                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                            <div
                                class="w-full transition-transform duration-500 ease-in-out transform h-96 hover:scale-105">
                                <!-- Apply fixed width and height to the image -->
                                <img v-bind:src="`http://127.0.0.1:8000/storage/images/sell_pictures/${latestPost.folder}/${latestPost.image}`" alt=""
                                    class="object-cover w-full h-full rounded-lg" style="filter: brightness(0.5);">
                                <!-- <img :src="'http://127.0.0.1:8000/storage/uploads/' + latestPost.image" alt=""
                                    class="object-cover w-full h-full rounded-lg" style="filter: brightness(0.5);"> -->
                            </div>
                        </div>

                        <div
                            class="absolute flex flex-col justify-center gap-2 mt-1 text-white md:mx-auto bottom-10 md:left-14 md:right-14 left-4 right-4">
                            <h1 class="my-2 mb-3 text-3xl font-bold md:text-5xl">
                                {{ latestPost.title }}
                            </h1>
                            <!-- <p class="text-xl ">{{ latestPost.seo_description }}</p> -->
                            <div class="mt-5 text-xl text-white">
                                <p class="italic">
                                    {{ formatRelativeTime(latestPost.published_at) }}
                                </p>
                                <p class="flex items-center gap-1 italic">
                                    <Icon name="clock" /> {{ latestPost.duree ? '0' + latestPost.duree : latestPost.duree }}
                                    minutes
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <!-- <h1 class="mb-5 text-3xl font-bold">Derniers Articles</h1> -->
                    <div class="grid grid-cols-1 gap-6 cursor-pointer lg:grid-cols-3 md:grid-cols-2 lg:mx-auto ">
                 
                        <div v-for="(article, index) in data.recentPosts" :key="index"
                            class="transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg">
                                    <div
                                        class="h-40 w-full xl:w-[50rem] transition-transform duration-500 ease-in-out transform hover:scale-110">
                                        <!-- Apply fixed width and height to the image -->
                                        <img :src="'http://127.0.0.1:8000/storage/images/sell_pictures/' + article.folder + '/' + article.image" alt=""
                                            class="object-cover w-full h-full">
                                    </div>
                                    <span
                                        class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#e39a00] rounded-lg select-none">
                                        {{ article.category.name }}
                                    </span>
                                </div>

                                <div class="flex flex-col justify-center gap-2 mx-auto mt-1 ">
                                    <h1 class="h-20 text-xl font-bold">
                                        {{ article.title }}
                                    </h1>

                                    <div class="mt-5 text-gray-500 ">
                                        <p class="mb-2 italic">
                                            {{ formatRelativeTime(article.published_at) }}
                                        </p>
                                        <p class="flex items-center gap-1 italic">
                                            <Icon name="clock" /> {{ article.duree ? '0' + article.duree : article.duree }}
                                            minutes
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="bg-[#ffcd00] p-5 my-10 rounded-lg">
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

                                <input v-model="question" type="text" id="question" name="question"
                                    placeholder="Posez votre question ici!"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                                <input v-model="email" type="email" id="email" name="email"
                                    placeholder="Entrez votre adresse email"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 ">
                            </div>
                        </div>

                        <!-- Bouton Envoyer -->
                        <span @click="subscribe()"
                            class="px-4 py-2 text-white transition duration-300 bg-gray-800 rounded-md cursor-pointer hover:bg-gray-900">Envoyer</span>
                    </form>
                </div>


            </div>




            <div v-for="categories, index in dataByCategory" :key="index">
                <div v-for="category, index in categories" :key="index" class="mt-10 mb-10">

                    <h1 class="mb-5 text-3xl font-bold">{{ category.category }}</h1>
                    <div class="grid grid-cols-1 gap-6 cursor-pointer lg:grid-cols-3 md:grid-cols-2 ">

                        <div v-for="(article, index) in category.posts" :key="index"
                            class="transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg ">
                                    <div
                                        class="h-40 w-full xl:w-[50rem] transition-transform duration-500 ease-in-out transform hover:scale-110">

                                        <img :src="'http://127.0.0.1:8000/storage/images/sell_pictures/' + article.folder + '/'+ article.image" alt=""
                                            class="object-cover w-full h-full">

                                    </div>
                                    <span
                                        class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#e39a00] rounded-lg select-none">
                                        {{ category.category }}
                                    </span>
                                </div>


                                <div class="flex flex-col justify-center gap-2 mx-auto mt-1 ">

                                    <h1 class="h-20 text-xl font-bold">
                                        {{ article.title }}
                                    </h1>

                                    <div class="mt-5 text-gray-500">
                                        <p class="italic">
                                            {{ formatRelativeTime(article.published_at) }}
                                        </p>
                                        <p class="flex items-center gap-1 italic">
                                            <Icon name="clock" /> {{ article.duree ? '0' + article.duree : article.duree }}
                                            minutes
                                        </p>
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-10 2xl:w-3/12 xl:ml-20 ">
            <AsideRight />
        </div>
    </div>
</template>

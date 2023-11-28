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
    <div class=" 2xl:flex justify-center mt-8 xl:mx-0 md:px-20 xl:px-10 px-14">

        <div class="2xl:w-6/12 lg:12/12  ">

            <h1 class="mb-5 text-3xl font-bold">Articles les plus récents</h1>

            <div class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 mb-10">
                <div @click="showArticle(article.slug)" class="p-4 mb-10 bg-white rounded-lg shadow">


                    <div @click="showArticle(latestPost.slug)" class="w-full rounded-lg   relative cursor-pointer">
                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                            <div
                                class="h-96 w-full transition-transform duration-500 ease-in-out transform hover:scale-105">
                                <!-- Apply fixed width and height to the image -->
                                <img :src="'http://127.0.0.1:8000/storage/uploads/' + latestPost.image" alt=""
                                    class="w-full h-full object-cover rounded-lg" style="filter: brightness(0.5);">
                            </div>
                        </div>

                        <div
                            class="flex flex-col justify-center text-white gap-2 mx-auto mt-1 absolute bottom-10 left-14 right-14">
                            <h1 class=" text-3xl md:text-5xl font-bold mb-3 my-2 ">
                                {{ latestPost.title }}
                            </h1>
                            <!-- <p class="text-xl ">{{ latestPost.seo_description }}</p> -->
                            <div class="mt-5 text-xl text-white">
                                <p class="italic">
                                    {{ formatRelativeTime(latestPost.published_at) }}
                                </p>
                                <p class="italic flex items-center gap-1">
                                    <Icon name="clock" /> {{ latestPost.duree ? '0' + latestPost.duree : latestPost.duree }}
                                    minutes
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <!-- <h1 class="mb-5 text-3xl font-bold">Derniers Articles</h1> -->
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6  cursor-pointer lg:mx-auto grid-cols-1 ">

                        <div v-for="(article, index) in data.recentPosts" :key="index"
                            class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 ">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg">
                                    <div
                                        class="h-40 w-full xl:w-[50rem] transition-transform duration-500 ease-in-out transform hover:scale-110">
                                        <!-- Apply fixed width and height to the image -->
                                        <img :src="'http://127.0.0.1:8000/storage/uploads/' + article.image" alt=""
                                            class="w-full h-full object-cover">
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

                                    <div class="text-gray-500 mt-5 ">
                                        <p class="italic mb-2">
                                            {{ formatRelativeTime(article.published_at) }}
                                        </p>
                                        <p class="italic flex items-center gap-1">
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
                    <form action="#" method="POST" class=" flex items-center gap-5 ">
                        <!-- Champ de la question -->
                        <div class="w-full">
                            <input v-model="question" type="text" id="question" name="question"
                                placeholder="Posez votre question ici!"
                                class="border w-full border-gray-300 px-3 py-2 focus:outline-none focus:border-blue-500 rounded-md">
                        </div>

                        <!-- Champ de l'email -->
                        <div class="w-full">

                            <input v-model="email" type="email" id="email" name="email"
                                placeholder="Entrez votre adresse email"
                                class="border w-full border-gray-300 px-3 py-2 focus:outline-none focus:border-blue-500 rounded-md ">
                        </div>

                        <!-- Bouton Envoyer -->
                        <span @click="subscribe()"
                            class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900 transition duration-300 cursor-pointer">Envoyer</span>
                    </form>
                </div>


            </div>




            <div v-for="categories, index in dataByCategory" :key="index">
                <div v-for="category, index in categories" :key="index" class="mb-10 mt-10">

                    <h1 class="mb-5 text-3xl font-bold">{{ category.category }}</h1>
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6  cursor-pointer  ">

                        <div v-for="(article, index) in category.posts" :key="index"
                            class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 ">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg ">
                                    <div
                                        class="h-40 w-full xl:w-[50rem] transition-transform duration-500 ease-in-out transform hover:scale-110">

                                        <img :src="'http://127.0.0.1:8000/storage/uploads/' + article.image" alt=""
                                            class="w-full h-full object-cover">

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

                                    <div class="text-gray-500 mt-5">
                                        <p class="italic">
                                            {{ formatRelativeTime(article.published_at) }}
                                        </p>
                                        <p class="italic flex items-center gap-1">
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

        <div class="px-10 2xl:w-3/12 xl:ml-20  ">
            <AsideRight />
        </div>
    </div></template>

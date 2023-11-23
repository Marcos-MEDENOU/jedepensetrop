<script setup>
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AsideRight from '../Partials/AsideRight.vue';

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

onMounted(() => {
    fetchLatestPost();
    fetchPreviousThreePosts();
    fetchThreeByCategory()
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

</script>


<template>
    <div class=" flex justify-center mt-8 ml-20">

        <div class="w-6/12 lg:w-6/12 xl:w-6/12 ">

            <h1 class="mb-5 text-3xl font-bold">Derniers Articles</h1>

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
                            <h1 class="h-20 text-5xl font-bold mb-3">
                                {{ latestPost.title }}
                            </h1>
                            <p class="text-xl my-2">{{ latestPost.seo_description }}</p>
                            <div class="mt-5 text-xl">
                                <p class="italic">
                                    Publié le : {{ latestPost.published_at }}
                                </p>
                                <p class="italic">
                                    Lire en : {{ latestPost.duree }} minutes
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <!-- <h1 class="mb-5 text-3xl font-bold">Derniers Articles</h1> -->
                    <div class="grid grid-cols-3 gap-6  cursor-pointer lg:mx-auto grid-cols-2 ">

                        <div v-for="(article, index) in data.recentPosts" :key="index"
                            class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 ">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg">
                                    <div
                                        class="h-40 w-96 transition-transform duration-500 ease-in-out transform hover:scale-110">
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
                                    <div class="text-red-900 mt-5">
                                        <p class="italic">
                                            Publié le : {{ article.published_at }}
                                        </p>
                                        <p class="italic">
                                            Lire en : {{ article.duree }} minutes
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
                    <div class="grid grid-cols-3 gap-6  cursor-pointer  ">

                        <div v-for="(article, index) in category.posts" :key="index"
                            class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 ">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg ">
                                    <div
                                        class="h-40 w-96 transition-transform duration-500 ease-in-out transform hover:scale-110">

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

                                    <div class="text-red-900 mt-5">
                                        <p class="italic">
                                            Publié le : {{ article.published_at }}
                                        </p>
                                        <p class="italic">
                                            Lire en : {{ article.duree }} minutes
                                        </p>
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-3/12 ml-20 ">
            <AsideRight />
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AsideRight from '../Partials/AsideRight.vue';

const data = reactive({
    recentPosts: [],
});

const fetchRecentPosts = async () => {
    try {
        const response = await axios.get('/recent-posts');
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
    fetchRecentPosts();
    fetchThreeByCategory()
});


const showArticle = (slug) => {
    console.log(slug);

    router.get(route("post.show", slug))
};

</script>


<template>
    <div class=" flex justify-center mt-8">

        <div class="w-6/12 lg:w-6/12 xl:w-6/12 ">


            <div class="mb-10">
                <h1 class="mb-5 text-3xl font-bold">Derniers Articles</h1>
                <div class="grid grid-cols-3 gap-6  cursor-pointer lg:mx-auto grid-cols-2 ">

                    <div v-for="(article, index) in data.recentPosts" :key="index"
                        class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 ">
                        <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                            <div class="relative flex justify-center overflow-hidden rounded-lg ">
                                <div
                                    class="max-w-96 transition-transform duration-500 ease-in-out transform hover:scale-110">

                                    <img :src="'http://127.0.0.1:8000/storage/uploads/' + article.image" alt="">

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
                                <div class="flex justify-between">
                                    <p class="italic">
                                        Créer le : {{ article.created_at }}
                                    </p>
                                    <!-- <p class="italic ">
                                par : {{ article.author.name }}
                            </p> -->
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
                        <input type="text" id="question" name="question" placeholder="Posez votre question ici!"
                            class="border w-full border-gray-300 px-3 py-2 focus:outline-none focus:border-blue-500 rounded-md">
                    </div>

                    <!-- Champ de l'email -->
                    <div class="w-full">

                        <input type="email" id="email" name="email" placeholder="Entrez votre adresse email"
                            class="border w-full border-gray-300 px-3 py-2 focus:outline-none focus:border-blue-500 rounded-md">
                    </div>

                    <!-- Bouton Envoyer -->
                    <button type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900 transition duration-300">Envoyer</button>
                </form>
            </div>


            <div v-for="categories, index in dataByCategory" :key="index" >
                <div v-for="category, index in categories" :key="index" class="mb-10 mt-10">

                    <h1 class="mb-5 text-3xl font-bold">{{ category.category }}</h1>
                    <div class="grid grid-cols-3 gap-6  cursor-pointer lg:mx-auto grid-cols-2 ">

                        <div v-for="(article, index) in category.posts" :key="index"
                            class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2 ">
                            <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                                <div class="relative flex justify-center overflow-hidden rounded-lg ">
                                    <div
                                        class="max-w-96 transition-transform duration-500 ease-in-out transform hover:scale-110">

                                        <img :src="'http://127.0.0.1:8000/storage/uploads/' + article.image" alt="">

                                    </div>
                                    <span
                                        class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#e39a00] rounded-lg select-none">
                                        {{ category.category }}
                                    </span>
                                </div>


                                <div class="flex flex-col justify-center gap-2 mx-auto mt-8 ">

                                    <h1 class="h-20 text-xl font-bold">
                                        {{ article.title }}
                                    </h1>
                                    <div class="flex justify-between">
                                        <p class="italic">
                                            Créer le : {{ article.created_at }}
                                        </p>
                                        <!-- <p class="italic ">
                                par : {{ article.author.name }}
                            </p> -->
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="w-3/12 lg:w-3/12 xl:w-3/12 ">
            <AsideRight />
        </div>
    </div>
</template>

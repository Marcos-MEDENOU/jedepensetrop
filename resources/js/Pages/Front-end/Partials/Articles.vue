<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { router } from '@inertiajs/vue3'

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

onMounted(() => {
    fetchRecentPosts()
});


const showArticle = (slug) => {
    console.log(slug);

    router.get(route("post.show", slug) )
};

</script>


<template>
    <section class="lg:mx-24 py-10">
        <h1 class="text-3xl mb-10 font-bold">Derniers Articles</h1>



        <div class="grid grid-cols-2 gap-6 ml-10 lg:mx-auto sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 cursor-pointer">

            <div v-for="(article, index) in data.recentPosts" :key="index"
                class=" transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                <div @click="showArticle(article.slug)" class="p-4 bg-white rounded-lg shadow">
                    <div class="relative flex justify-center overflow-hidden rounded-lg ">
                        <div class="w-full transition-transform duration-500 ease-in-out transform hover:scale-110">

                            <img :src="'/images/' + article.image" alt="">

                        </div>
                        <span
                            class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#e39a00] rounded-lg select-none">
                            {{ article.category.name }}
                        </span>
                    </div>


                    <div class="flex flex-col  justify-center gap-2 mx-auto mt-8 ">

                        <h1 class="h-20 font-bold text-xl">
                            {{ article.title }}
                        </h1>
                        <div class="flex justify-between">
                            <p class="italic">
                                Créer le : {{ article.created_at }}
                            </p>
                            <p class="italic ">
                                par : {{ article.author.name }}
                            </p>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
</template>

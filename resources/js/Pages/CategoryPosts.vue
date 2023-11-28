<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import AsideRight from './Front-end/Partials/AsideRight.vue';

const props = defineProps({
    formattedCategory: {
        type: Object,
        required: true,
    },
})

console.log(props.formattedCategory);

const showArticle = (slug) => {
    console.log(slug);

    router.get(route("post.show", slug))
};

</script>


<template>
    <MainLayout>

        <Head :title="props.formattedCategory.category" />
        <div class="  2xl:flex justify-center mt-8 xl:mx-0 md:px-20 xl:px-10 px-14">

            <div class="2xl:w-6/12 lg:12/12  ">



                <div class="mb-10">
                    <h1 class="mb-5 text-3xl font-bold">{{ props.formattedCategory.category }}</h1>

                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6  cursor-pointer ">

                        <div v-for="(article, index) in props.formattedCategory.posts" :key="index"
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
                                        {{ article.category.name }}
                                    </span>
                                </div>


                                <div class="flex flex-col justify-center gap-2 mx-auto mt-8 ">

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


            </div>

            <div class="px-10 2xl:w-3/12 xl:ml-20  ">
                <AsideRight />
            </div>
        </div>
    </MainLayout>
</template>

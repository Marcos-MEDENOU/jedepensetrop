<script setup>
import axios from 'axios';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import AsideRight from './Front-end/Partials/AsideRight.vue';
import Comment from './Front-end/Partials/Comment.vue';
const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
})

</script>
<template>
    <MainLayout>

        <Head title="Accueil" />

        <div class="relative h-[500px] flex items-center justify-center transition-all ">
            <!-- Fond d'écran en arrière-plan -->
            <transition name="fade" mode="in-out">
                <img :src="'http://127.0.0.1:8000/storage/uploads/' + props.post.image" :alt="props.post.title"
                    class="absolute inset-0 object-cover w-full h-full transition-opacity transition-filter"
                    style="filter: brightness(0.5);" />
            </transition>
            <span
                class="absolute text-2xl z-10 inline-flex px-3 py-2 mt-3 ml-3 font-medium text-white bg-[#e39a00] rounded-lg select-none">
                {{ props.post['category'].name }}
            </span>
        </div>
        <div class="flex justify-center mt-8 ">


            <div class="w-6/12 lg:w-6/12 xl:w-6/12 ">
                <div class="flex items-center justify-between pb-4 border-b">
                    <div class="text-gray-700">
                        <!-- <p class="text-lg font-semibold">Auteur : {{ props.post['author'].name }}</p> -->
                        <p class="text-lg font-semibold">Catégorie : {{ props.post['category'].name }}</p>
                    </div>
                    <div class="text-gray-700">
                        <p class="text-lg font-semibold">Publié le {{ props.post['created_at'] }}</p>
                        <p class="text-lg font-semibold">Dernière mise à jour le {{ props.post['updated_at'] }}</p>
                    </div>
                </div>

                <div class="mt-6 mb-12">
                    <h1 class="mb-4 text-5xl font-bold text-[#e39a00]">{{ props.post.title }}</h1>
                    <div class="prose">
                        <div v-html="props.post['content']"></div>
                    </div>
                    <div class="flex items-center mt-5 space-x-4">
                        <!-- Bouton Like -->
                        <button class="flex items-center text-green-500 hover:text-green-700">
                            <Icon name="like" />
                            <span class="ml-2">J'aime(0)</span>
                        </button>

                        <!-- Bouton Dislike -->
                        <button class="flex items-center text-red-500 hover:text-red-700">
                            <Icon name="dislike" />
                            <span class="ml-2">J'aime pas(0)</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-8 border-t border-gray-300">
                    <div class="text-gray-700 cursor-pointer ">
                        <span
                            class="p-5 text-lg font-bold text-white bg-green-500 rounded-lg shadow-md  hover:scale-50 hover:bg-green-600">
                            Article précédent</span>
                        <span class="block mt-8 text-lg font-bold">Titre de l'article précédent</span>
                    </div>
                    <div class="text-gray-700 cursor-pointer ">
                        <span
                            class="p-5 mb-5 text-lg font-bold text-white bg-green-500 rounded-md shadow-lg  hover:scale-50 hover:bg-green-600">
                            Article suivant</span>
                        <span class="block mt-8 text-lg font-bold">Titre de l'article suivant</span>
                    </div>
                </div>

                <!-- Commentaires -->
                <Comment />



            </div>

            <div class="w-3/12 lg:w-3/12 xl:w-3/12 ">
                <AsideRight />
            </div>

        </div>
        <div  class="py-8 lg:py-24 dark:bg-gray-800">
            <div class="max-w-screen-xl px-4 mx-auto">
                <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Articles Liés</h2>
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <article class="max-w-xs p-4 bg-white rounded-lg shadow-lg">
                        <a href="#">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png"
                                class="mb-5 rounded-lg" alt="Image 1">
                        </a>
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#">Our first office</a>
                        </h2>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many
                            changes! After months of preparation.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            Lire en 2 minutes
                        </a>
                    </article>
                    <article class="max-w-xs p-4 bg-white rounded-lg shadow-lg">
                        <a href="#">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png"
                                class="mb-5 rounded-lg" alt="Image 2">
                        </a>
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#">Enterprise design tips</a>
                        </h2>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many
                            changes! After months of preparation.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            Lire en 12 minutes
                        </a>
                    </article>
                    <article class="max-w-xs p-4 bg-white rounded-lg shadow-lg">
                        <a href="#">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png"
                                class="mb-5 rounded-lg" alt="Image 3">
                        </a>
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#">We partnered with Google</a>
                        </h2>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many
                            changes! After months of preparation.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            Lire en 8 minutes
                        </a>
                    </article>
                    <article class="max-w-xs p-2 bg-white rounded-lg shadow-lg">
                        <a href="#">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png"
                                class="mb-5 rounded-lg" alt="Image 4">
                        </a>
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#">Our first project with React</a>
                        </h2>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many
                            changes! After months of preparation.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            Lire en 4 minutes
                    </a>
                </article>
            </div>
        </div>
    </div>


</MainLayout></template>


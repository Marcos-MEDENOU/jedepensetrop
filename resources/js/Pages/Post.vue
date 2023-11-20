<script setup>
import axios from 'axios';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import AsideRight from './Front-end/Partials/AsideRight.vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import Comment from './Front-end/Partials/Comment.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
})

let post = ref(props.post)
console.log(post.value);

// Fonction qui permet d'afficher l'article précédent
const previousPost = (id) => {
    console.log(id);

    router.get(route("previous.post", id))
};

// Fonction qui permet d'afficher l'article suivant
const nextPost = (id) => {
    console.log(id);

    router.get(route("next.post", id))
};

const hasPrevious = ref(false);
const hasNext = ref(false);

// Fontion qui verifie si l'article afficher possède ou non un article suivant
const hasNextPost = async (id) => {
    try {
        const response = await axios.get(route('has-next.post', props.post.id));
        hasNext.value = response.data.hasNext;
        console.error(hasNext.value);
    } catch (error) {
        console.error(error);
    }
}

// Fontion qui verifie si l'article afficher possède ou non un article precedent
const hasPreviousPost = async (id) => {
    try {
        const response = await axios.get(route('has-previous.post', props.post.id));
        hasPrevious.value = response.data.hasPrevious;
        console.error(hasPrevious.value);
    } catch (error) {
        console.error(error);
    }
}
// Fonction permettant de liker le post
const likePost = async () => {
    const response = await axios.post(`/posts/${props.post.id}/like`);
    post.value = response.data.post;
};

// Fonction permettant de disliker le post
const dislikePost = async () => {
    const response = await axios.post(`/posts/${props.post.id}/dislike`);
    post.value = response.data.post;
};


onMounted(async () => {
    await hasNextPost();
    await hasPreviousPost();
});


const setimgSrc = (htmlContent) => {
    //créer une div temporaire sans l'ajouter dans le dom
    let tempElement = document.createElement("div");
    //ajoute le code htmml a l'intérieur de la div
    tempElement.innerHTML = htmlContent;
    //Expression réguliere qui détecte les attributs src a modifier
    let regex = /^http:\/\/127.0.0.1:8000\/post/;
    //Vérification et execution d'un bloc de code pour chacune des attributs src des images
    tempElement.querySelectorAll("img").forEach(function (imgTag) {
        //Cas ou une image verifiant la regex a été détectée
        if (regex.test(imgTag.src)) {
            //Coupure de l'attribut src a partir de /
            let x = imgTag.src.split("/");
            //supression de 2em element du tableau obtenu
            x.splice(1, 1);
            //supression du 1er element du nouveau tableau apres la ligne de split précédente
            x.splice(0, 1);
            //Supresion det remplacement du 1er element du nouveau tableau par l'adresse localhost du serveur
            // x.splice(0, 1, "http://interstis.com/backend/public");
            x.splice(0, 2, "http://127.0.0.1:8000");
            //Association des elements tableau avec pour indice '/'
            let y = x.join("/");
            //Remplacement du src du code html actuelle par le nouveau
            imgTag.src = y;
        }
    });
    // Obtenez le contenu HTML modifié
    let modifiedHtmlContent = tempElement;
    return modifiedHtmlContent.innerHTML;
}

</script>
<template>
    <MainLayout>

        <Head :title="props.post.slug" />

        <div class="relative h-[500px] flex items-center justify-center transition-all ">
            <!-- Fond d'écran en arrière-plan -->
            <transition name="fade" mode="in-out">
                <img :src="'http://127.0.0.1:8000/storage/uploads/' + post.image" :alt="post.title"
                    class="absolute inset-0 object-cover w-full h-full transition-opacity transition-filter"
                    style="filter: brightness(0.5);" />
            </transition>
            <span
                class="absolute text-2xl z-10 inline-flex px-3 py-2 mt-3 ml-3 font-medium text-white bg-[#e39a00] rounded-lg select-none">
                {{ post['category'].name }}
            </span>
        </div>
        <div class="flex justify-center mt-8 ">


            <div class="w-6/12 lg:w-6/12 xl:w-6/12 ">
                <div class="flex items-center justify-between pb-4 italic border-b">
                    <div class="text-gray-700">
                        <p class="text-lg font-semibold">Lire en : {{ post['duree'] }} minutes</p>
                        <p class="text-lg font-semibold">Rédigé par : {{ post['author'].name }}</p>
                    </div>
                    <div class="text-gray-700">
                        <p class="text-lg font-semibold">Publié le : {{ post['published_at'] }}</p>
                        <p class="text-lg font-semibold">Dernière mise à jour : {{ post['updated_at'] }}</p>
                    </div>
                </div>

                <div class="mt-6 mb-12">
                    <h1 class="mb-4 text-5xl font-bold text-[#e39a00]">{{ post.title }}</h1>
                    <div class="prose">
                        <div id="editor" v-html="setimgSrc(post['content'])"></div>
                    </div>
                    <div class="flex items-center mt-5 space-x-4">
                        <!-- Bouton Like -->
                        <span @click="likePost" :class="{ 'text-green-600': post.user_liked }"
                            class="flex items-center text-green-500 cursor-pointer hover:text-green-600">
                            <Icon name="like" />
                            <span class="ml-2">J'aime( {{ post.likes_count }})</span>
                        </span>

                        <!-- Bouton Dislike -->
                        <span @click="dislikePost" :class="{ 'text-red-700': post.user_liked }"
                            class="flex items-center text-red-500 cursor-pointer hover:text-red-700">
                            <Icon name="dislike" />
                            <span class="ml-2">Je n'aime pas({{ post.dislikes_count }})</span>
                        </span>
                    </div>
                </div>

                <div class="relative flex items-center justify-between pt-8 border-t border-gray-300"
                    :class="{ 'justify-end': !hasPrevious }"> <!-- Ajoutez 'justify-end' si hasPrevious est faux -->
                    <div v-if="hasPrevious" @click="previousPost(props.post.id)"
                        class="left-0 text-gray-700 cursor-pointer text-start">
                        <span
                            class="p-4 text-lg font-bold text-white bg-gray-800 rounded-lg shadow-md hover:scale-50 hover:bg-gray-900">
                            Article précédent
                        </span>
                    </div>
                    <div v-if="hasNext" @click="nextPost(props.post.id)"
                        class="absolute right-0 text-gray-700 cursor-pointer">
                        <span
                            class="p-4 mb-5 text-lg font-bold text-white bg-gray-800 rounded-md shadow-lg hover:scale-50 hover:bg-gray-900">
                            Article suivant
                        </span>
                    </div>
                </div>



                <!-- Commentaires -->
                <Comment />



            </div>

            <div class="w-3/12 lg:w-3/12 xl:w-3/12 ">
                <AsideRight />
            </div>

        </div>
        <div class="py-8 lg:py-24 dark:bg-gray-800">
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


    </MainLayout>
</template>

<style>
#editor h1 {
  font-weight: bold;
  margin-block: 1rem;
  font-size: 32pt;
  line-height: 3.5rem;
  /* font-family: DMSans; */
}

#editor h2 {
  font-weight: bold;
  margin-block: 1rem;
  font-size: 24pt;
}

#editor h3 {
  text-decoration: underline;
  font-size: 18pt;
}

#editor p,
#editor ul,
#editor table {
  font-size: 12pt;
  /* font-family: DMSans; */
  padding-block: 5pt;
}

#editor table.full {
  display: block;
  background-color: white;
}

#editor h3 {
  text-decoration: underline
}

#editor ul li{
  list-style: disc;
  margin-left: 2.5rem;
}

#editor ol li{
  list-style: decimal;
  margin-left: 2.5rem;
}


</style>
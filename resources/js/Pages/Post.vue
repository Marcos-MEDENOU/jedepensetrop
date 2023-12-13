<script setup>
import axios from 'axios';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import AsideRight from './Front-end/Partials/AsideRight.vue';
import Publicite from './Front-end/Partials/Publicite.vue'
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { Head } from '@inertiajs/vue3';
import Comment from './Front-end/Partials/Comment.vue';
import Icon from '@/Components/Icons/Icon.vue';
import moment from 'moment';
import 'moment/locale/fr';



const props = defineProps({
    post: {
        type: Object,
        required: true,
    },

    relatedPosts: {
        type: Array,
        required: true,
    },

    TopThreePosts: {
        type: Array,
        required: true,
    },

    categories: {
        type: Object,
        required: true,
    },


})

console.log(props.categories);
let post = ref(props.post)

// Fonction qui permet d'afficher l'article précédent
const previousPost = (id) => {

    router.get(route("previous.post", id))
};

// Fonction qui permet d'afficher l'article suivant
const nextPost = (id) => {

    router.get(route("next.post", id))
};

const hasPrevious = ref(false);
const hasNext = ref(false);

// Fontion qui verifie si l'article afficher possède ou non un article suivant
const hasNextPost = async (id) => {
    try {
        const response = await axios.get(route('has-next.post', props.post.id));
        hasNext.value = response.data.hasNext;
    } catch (error) {
        console.error(error);
    }
}

// Fontion qui verifie si l'article afficher possède ou non un article precedent
const hasPreviousPost = async (id) => {
    try {
        const response = await axios.get(route('has-previous.post', props.post.id));
        hasPrevious.value = response.data.hasPrevious;
    } catch (error) {
        console.error(error);
    }
}
// Fonction permettant de liker le post
const likePost = async () => {

    await axios.post(`/posts/${props.post.id}/like`).then(response => {
        if (response.data.errorMessage == 'Veuillez vous connecter pour aimer le post.') {
            Swal.fire({
                title: "Important!",
                text: "Veuillez vous connecter pour aimer le post!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Annuler",
                confirmButtonText: "Se connecter"
            }).then((result) => {
                if (result.isConfirmed) {

                    router.get(route("login"))

                }
            });
        }
        post.value = response.data.post.original;


    })
};

// Fonction permettant de disliker le post
const dislikePost = async () => {

    await axios.post(`/posts/${props.post.id}/dislike`).then(response => {
        if (response.data.errorMessage == 'Veuillez vous connecter pour désaimer le post.') {
            Swal.fire({
                title: "Important!",
                text: "Veuillez vous connecter pour désaimer le post!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Annuler",
                confirmButtonText: "Se connecter"
            }).then((result) => {
                if (result.isConfirmed) {

                    router.get(route("login"))

                }
            });
        }
        post.value = response.data.post.original;


    })
};


onMounted(async () => {
    await hasNextPost();
    await hasPreviousPost();
    showComment();
});


const setimgSrc = (htmlContent) => {
    //créer une div temporaire sans l'ajouter dans le dom
    let tempElement = document.createElement("div");
    //ajoute le code htmml a l'intérieur de la div
    tempElement.innerHTML = htmlContent;
    //Expression réguliere qui détecte les attributs src a modifier
    let regex = /^https:\/\/jedepensetrop.fr\/post/;
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
            x.splice(0, 2, "");
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

let comment = ref('');
let replyComment = ref('');
let parent_comment_id = ref('');

const addComment = () => {
    axios.post(route('comments.store', {
        content: comment.value,
        post_id: props.post.id,
        parent_comment_id: parent_comment_id.value
    })).then(response => {
        if (response.data.errorMessage == 'Veuillez vous connecter pour commenter le post.') {
            Swal.fire({
                title: "Important!",
                text: "Veuillez vous connecter pour commenter le post!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Annuler",
                confirmButtonText: "Se connecter"
            }).then((result) => {

                // Récupérer l'URL stockée dans localStorage
                const redirectUrl = localStorage.getItem('redirectUrl');

                // Vérifier si une URL de redirection existe
                if (redirectUrl) {
                    // Rediriger l'utilisateur vers l'URL stockée
                    this.$router.push(redirectUrl);

                    // Nettoyer l'élément redirectUrl dans localStorage
                    localStorage.removeItem('redirectUrl');
                } else {
                    // S'il n'y a pas d'URL de redirection, vous pouvez rediriger l'utilisateur vers la page par défaut
                    this.$router.push({ name: 'login' }); // Assurez-vous d'ajuster le nom de la route en conséquence
                }
        
            });
        }
        if (response.data.successMessage) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: response.data.successMessage,
                showConfirmButton: false,
                timer: 1500
            });
            commentaires.value = response.data.commentaires.original.comments
            count.value = response.data.commentaires.original.count
            comment.value = '';
        }

    })
}



const formatCreatedAtDiff = (created_at) => {
    moment.locale('fr');  // Définir la localisation sur le français
    const now = moment();
    const commentDate = moment(created_at);
    const diff = now.diff(commentDate);
    const duration = moment.duration(diff);

    if (duration.asDays() > 1) {
        return commentDate.fromNow();
    } else {
        return commentDate.startOf('minute').fromNow();
    }
};

let commentaires = ref([])
let count = ref(null)
const showComment = () => {
    axios.get(route('comments.show', props.post.id)).then(response => {
        commentaires.value = response.data.comments;
        count.value = response.data.count
    })
}

const isOpen = ref({
    comment: {},
    reply: {},
});

const toggleDropdown = (type, id) => {
    isOpen.value[type][id] = !isOpen.value[type][id];
};


const showReplyForm = ref({});

let isUpdate = ref(false)
const toggleReplyForm = (commentId) => {
    // Assurez-vous que showReplyForm a une propriété pour chaque commentaire
    if (!showReplyForm.value[commentId]) {
        // Si la propriété n'existe pas, initialisez-la à true pour afficher le formulaire
        showReplyForm.value[commentId] = true;
    } else {
        // Sinon, basculez la valeur pour afficher ou masquer le formulaire
        showReplyForm.value[commentId] = !showReplyForm.value[commentId];
    }

    if (isUpdate.value = true) {
        isUpdate.value = false

    }

    comment.value = "";
    replyComment.value = "";

};


const makeCommentUpdate = (commentId) => {
    // Assurez-vous que showReplyForm a une propriété pour chaque commentaire
    if (!showReplyForm.value[commentId]) {
        // Si la propriété n'existe pas, initialisez-la à true pour afficher le formulaire
        showReplyForm.value[commentId] = true;
    } else {
        // Sinon, basculez la valeur pour afficher ou masquer le formulaire
        showReplyForm.value[commentId] = !showReplyForm.value[commentId];
    }

    if (isUpdate.value = false) {
        isUpdate.value = true

    } else {
        isUpdate.value = true
    }

    axios.get(route('comments.edit', commentId)).then(response => {
        replyComment.value = response.data.content
    })

    comment.value = "";
    replyComment.value = "";

}


const showReplyComments = ref({});
const toggleReplyComments = (commentId) => {
    // Assurez-vous que showReplyComments a une propriété pour chaque commentaire
    if (!showReplyComments.value[commentId]) {
        // Si la propriété n'existe pas, initialisez-la à true pour afficher le cshowReplyCommentsulaire
        showReplyComments.value[commentId] = true;
    } else {
        // Sinon, basculez la valeur pour afficher ou masquer le cshowReplyCommentsulaire
        showReplyComments.value[commentId] = !showReplyComments.value[commentId];
    }


};




const submitReply = async (parentCommentId, commentId) => {
    try {
        // Envoyez les données au serveur pour traitement
        await axios.post('/comments-reply', {
            content: replyComment.value,
            post_id: props.post.id,
            parent_comment_id: parentCommentId
        }).then(response => {

            if (response.data.errorMessage == 'Veuillez vous connecter pour commenter le post.') {
                Swal.fire({
                    title: "Important!",
                    text: "Veuillez vous connecter pour commenter le post!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Annuler",
                    confirmButtonText: "Se connecter"
                }).then((result) => {
                    if (result.isConfirmed) {

                        router.get(route("login"))

                    }
                });
            }
            if (response.data.successMessage) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.data.successMessage,
                    showConfirmButton: false,
                    timer: 1500
                });
                commentaires.value = response.data.commentaires.original.comments
                count.value = response.data.commentaires.original.count
                showReplyForm.value[commentId] = false;
                replyComment.value = ''

                // Hide the reply form
            }
        });



    } catch (error) {
        console.error('Erreur lors de la soumission de la réponse :', error);
        // Gérez l'erreur (affichage d'un message d'erreur, journalisation, etc.)
    };
};



const updateComment = (commentId) => {
    axios.post(route('comments.update', {
        post_id: props.post.id,
        commentId: commentId,
        content: replyComment.value
    })).then(response => {

        commentaires.value = response.data.commentaires.original.comments
        count.value = response.data.commentaires.original.count
        showReplyForm.value[commentId] = false;
        replyComment.value = ''

        // Hide the reply form
    })
}

const deleteComment = (commentId) => {
    axios.post(route('comments.delete', {
        post_id: props.post.id,
        commentId: commentId
    })).then(response => {

        commentaires.value = response.data.commentaires.original.comments
        count.value = response.data.commentaires.original.count
        showReplyForm.value[commentId] = false;
        replyComment.value = ''

        // Hide the reply form
    })
}

const showArticle = (slug) => {
    router.get(route("post.show", slug))
};

</script>
<template>
    <MainLayout :categories="props.categories">

        <Head :title="props.post.slug" />

        <div class="relative h-[500px] flex items-center justify-center transition-all ">
            <!-- Fond d'écran en arrière-plan -->
            <transition name="fade" mode="in-out">
                <img :src="'/storage/images/' + post.folder + '/' + post.image" :alt="post.title"
                    class="absolute inset-0 object-cover w-full h-full transition-opacity transition-filter"
                    style="filter: brightness(0.5);" />
            </transition>
            <span
                class="absolute text-2xl z-10 inline-flex px-3 py-2 mt-3 ml-3 font-medium text-white bg-[#e39a00] rounded-lg select-none">
                {{ post['category'].name }}
            </span>
        </div>


        <div class="justify-center px-5 mt-8 2xl:flex xl:mx-0 md:px-20 xl:px-10">
            <!-- <div class="justify-center mx-40 mt-8 2xl:flex"> -->

            <!-- <div class="w-3/12 lg:w-3/12 xl:w-3/12 ">
                <Publicite />
            </div> -->
            <!-- 2xl:w-6/12 lg:12/12  -->

            <div class="2xl:w-6/12 lg:w-8/12 md:container md:mx-auto 2xl:mx-0 ">
                <div class="flex items-center justify-between pb-4 text-sm italic border-b">
                    <div class="text-gray-500">
                        <p class="flex items-center gap-1 text-sm">
                            <Icon name="clock" /> {{ post['duree'] < 10 ? '0' + post['duree'] : post['duree'] }} minutes</p>
                                <p class="text-sm ">Auteur : {{ post['author'].name }}</p>
                    </div>
                    <div class="text-gray-500">
                        <p class="text-sm ">Publié le : {{ post['published_at'] }}</p>
                        <p class="text-sm ">Dernière mise à jour : {{ post['updated_at'] }}</p>
                    </div>
                </div>

                <div class="mt-10 mb-10">
                    <h1 class="mb-4 text-4xl md:text-5xl font-bold text-[#e39a00]">{{ post.title }}</h1>
                    <div class="prose">
                        <div id="editor" v-html="setimgSrc(post['content'])"></div>
                    </div>
                    <div class="flex items-center gap-5 mt-10 space-x-4">
                        <!-- Bouton Like -->
                        <span @click="likePost" class="relative flex items-center cursor-pointer">
                            <Icon name="like" />
                            <span class="absolute ml-2 -top-2 -right-3">{{ post.likes_count }}</span>
                        </span>

                        <!-- Bouton Dislike -->
                        <span @click="dislikePost" class="relative flex items-center cursor-pointer">
                            <Icon name="dislike" />
                            <span class="absolute ml-2 -top-2 -right-3">{{ post.dislikes_count }}</span>
                        </span>
                    </div>
                </div>

                <div class="relative flex items-center justify-between pt-8 border-t border-gray-300"
                    :class="{ 'justify-end': !hasPrevious }"> <!-- Ajoutez 'justify-end' si hasPrevious est faux -->
                    <div v-if="hasPrevious" @click="previousPost(props.post.id)"
                        class="left-0 text-gray-700 cursor-pointer text-start">
                        <span
                            class="p-2 text-sm font-bold text-white bg-gray-800 rounded-lg shadow-md md:p-4 md:text-lg hover:scale-50 hover:bg-gray-900">
                            Article précédent
                        </span>
                    </div>
                    <div v-if="hasNext" @click="nextPost(props.post.id)"
                        class="absolute right-0 text-gray-700 cursor-pointer">
                        <span
                            class="p-2 mb-5 text-sm font-bold text-white bg-gray-800 rounded-md shadow-lg md:p-4 md:text-lg hover:scale-50 hover:bg-gray-900">
                            Article suivant
                        </span>
                    </div>
                </div>



                <!-- Commentaires -->
                <section class="py-8 antialiased dark:bg-gray-900 lg:py-16">
                    <div class="px-4 ">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900 lg:text-2xl dark:text-white">Discussion ({{
                                count < 10 ? '0' + count : count }})</h2>
                        </div>
                        <form class="mb-6">
                            <div
                                class="px-4 py-2 mb-4 bg-white border border-gray-200 rounded-lg rounded-t-lg dark:bg-gray-800 dark:border-gray-700">

                                <textarea id="comment" rows="6" v-model="comment"
                                    class="w-full px-0 text-sm text-gray-900 border-0 max-h-20 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                    placeholder="Ecrire un commentaire..." required></textarea>
                            </div>
                            <span @click="addComment()" v-if="comment.trim() !== ''"
                                class="inline-flex items-center shadow-lg px-4 py-2 font-medium text-center rounded-full cursor-pointer bg-primary-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 hover:bg-black hover:text-white">
                                Ajouter un commentaire
                            </span>
                        </form>

                        <article v-for="(commentaire) in commentaires" :key="commentaire.id"
                            class="p-6 mb-2 text-base bg-white rounded-lg dark:bg-gray-900">
                            <footer class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <p
                                        class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ commentaire.user.name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ formatCreatedAtDiff(commentaire.created_at) }}
                                    </p>
                                </div>
                                <div class="relative inline-block">
                                    <span @click="toggleDropdown('comment', commentaire.id)"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg dark:text-gray-40 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                        <Icon name="param" />
                                    </span>

                                    <!-- Dropdown menu -->
                                    <div v-if="isOpen.comment[commentaire.id]"
                                        class="absolute z-10 mt-2 bg-white divide-y divide-gray-100 rounded shadow left-2 w-36 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                                <a @click="makeCommentUpdate(commentaire.id)"
                                                    class="block px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier</a>
                                            </li>
                                            <li>
                                                <a @click="deleteComment(commentaire.id)"
                                                    class="block px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Supprimer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">{{ commentaire.content }}</p>
                            <div class="flex flex-col mt-4 space-x-4">
                                <!-- Bouton "Répondre" -->
                                <span @click="toggleReplyForm(commentaire.id)"
                                    class="flex items-center text-sm font-medium text-gray-500 cursor-pointer hover:underline dark:text-gray-400">
                                    <Icon name="answers" />
                                    Répondre
                                </span>

                                <!-- Formulaire de réponse conditionnel -->
                                <form v-if="showReplyForm[commentaire.id]">
                                    <div
                                        class="px-4 py-2 mb-4 bg-white border border-gray-200 rounded-lg rounded-t-lg dark:bg-gray-800 dark:border-gray-700">
                                        <textarea id="comment" rows="6" v-model="replyComment"
                                            class="w-full px-0 text-sm text-gray-900 border-0 max-h-20 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                            placeholder="Ecrire un commentaire..." required></textarea>
                                    </div>
                                    <div v-if="replyComment.trim() !== ''" class="flex">
                                        <span v-if="!isUpdate" @click="submitReply(commentaire.id, commentaire.id)"
                                            class="cursor-pointer text-slate-500 hover:text-slate-700">Répondre</span>

                                        <span v-if="isUpdate" @click="updateComment(commentaire.id)"
                                            class="cursor-pointer text-slate-500 hover:text-slate-700">Enrégistrer</span>
                                    </div>
                                </form>
                            </div>

                            <div v-if="commentaire.child_comments.length > 0" @click="toggleReplyComments(commentaire.id)"
                                class="m-2 text-sm font-semibold text-blue-700 cursor-pointer hover:underline ">{{
                                    commentaire.child_comments.length < 10 ? '0' + commentaire.child_comments.length :
                                    commentaire.child_comments.length }} réponse(s)</div>

                                    <article v-for="(reply) in commentaire.child_comments" :key="reply.id"
                                        v-if="showReplyComments[commentaire.id]"
                                        class="p-6 mt-5 mb-3 ml-6 text-base rounded-lg bg-gray-50 lg:ml-12 dark:bg-gray-900">
                                        <footer class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <p
                                                    class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ reply.user.name }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ formatCreatedAtDiff(reply.created_at) }}
                                                </p>
                                            </div>
                                            <div class="relative inline-block">
                                                <span @click="toggleDropdown('reply', reply.id)"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg dark:text-gray-40 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                                    <Icon name="param" />
                                                </span>

                                                <!-- Dropdown menu -->
                                                <div v-if="isOpen.reply[reply.id]"
                                                    class="absolute z-10 mt-2 bg-white divide-y divide-gray-100 rounded shadow left-2 w-36 dark:bg-gray-700 dark:divide-gray-600">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                        <li>
                                                            <a @click="makeCommentUpdate(reply.id)"
                                                                class="block px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier</a>
                                                        </li>
                                                        <li>
                                                            <a @click="deleteComment(reply.id)"
                                                                class="block px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Supprimer</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </footer>
                                        <p class="text-gray-500 dark:text-gray-400">{{ reply.content }}</p>
                                        <div class="flex flex-col mt-4 space-x-4">
                                            <!-- Bouton "Répondre" -->
                                            <span @click="toggleReplyForm(reply.id)"
                                                class="flex items-center text-sm font-medium text-gray-500 cursor-pointer hover:underline dark:text-gray-400">
                                                <Icon name="answers" />
                                                Répondre
                                            </span>

                                            <!-- Formulaire de réponse conditionnel -->
                                            <form v-if="showReplyForm[reply.id]">
                                                <div
                                                    class="px-4 py-2 mb-4 bg-white border border-gray-200 rounded-lg rounded-t-lg dark:bg-gray-800 dark:border-gray-700">
                                                    <textarea id="comment" rows="6" v-model="replyComment"
                                                        class="w-full px-0 text-sm text-gray-900 border-0 max-h-20 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                                        placeholder="Ecrire un commentaire..." required></textarea>
                                                </div>
                                                <div v-if="replyComment.trim() !== ''" class="flex">
                                                    <span v-if="!isUpdate" @click="submitReply(commentaire.id, reply.id)"
                                                        class="cursor-pointer text-slate-500 hover:text-slate-700">Répondre</span>

                                                    <span v-if="isUpdate" @click="updateComment(reply.id)"
                                                        class="cursor-pointer text-slate-500 hover:text-slate-700">Enrégistrer</span>
                                                </div>
                                            </form>
                                        </div>
                                    </article>
                        </article>


                    </div>
                </section>



            </div>

            <!-- <div class="w-3/12 ml-24 lg:w-3/12 xl:w-3/12 "> -->
            <div class="2xl:px-10 2xl:w-3/12 2xl:ml-20">
                <AsideRight :TopThreePosts="props.TopThreePosts" />
                <!-- <Publicite /> -->
            </div>

        </div>
        <div class="container p-10 mx-auto dark:bg-gray-800 ">


            <h2 class="mb-8 ml-10 text-2xl font-bold text-gray-900 dark:text-white">Articles Liés</h2>

            <div class="grid justify-center grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4 xl:px-0">

                <article v-for="article, index in relatedPosts" :key="index" class="p-4 bg-white rounded-lg shadow-lg ">

                    <a @click="showArticle(article.slug)">
                        <img :src="'/storage/images/' + article.folder + '/' + article.image" alt=""
                            class="object-cover w-full h-40 mb-3 cursor-pointer">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white cursor-pointer">
                        <a @click="showArticle(article.slug)">{{ article.title }}</a>
                    </h2>
                    <!-- <p v-html="article.content " class="mb-4 text-gray-500 dark:text-gray-400 truncate"></p> -->
                    <a @click="showArticle(article.slug)"
                        class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline cursor-pointer">
                        Lire l'article
                    </a>
                </article>



            </div>

        </div>


    </MainLayout>
</template>

<style>
/* Styles par défaut pour les grands écrans */
#editor h1 {
    font-weight: bold;
    margin-block: 1rem;
    font-size: 32pt;
    line-height: 3.5rem;
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
    font-weight: lighter;
    padding-block: 5pt;
}

#editor table.full {
    display: block;
    background-color: white;
}

#editor h3 {
    text-decoration: underline
}

#editor ul li {
    list-style: disc;
    margin-left: 2.5rem;
}

#editor ol li {
    list-style: decimal;
    margin-left: 2.5rem;
}


#editor>div>iframe {
    width: 100% !important;
    height: 500px !important;
}


/* Styles pour les écrans de petite taille (mobiles) */
@media only screen and (max-width: 600px) {
    #editor h1 {
        font-size: 20pt;
        line-height: 2.5rem;
    }

    #editor h2 {
        font-size: 20pt;
    }

    #editor h3 {
        font-size: 16pt;
    }


    #editor p span {
        font-size: 12pt !important;
        font-weight: lighter;
    }

    #editor ul {
        font-size: 12pt !important;
    }

    #editor ol {
        font-size: 12pt !important;
    }

    #editor table {
        font-size: 12pt !important;
    }

    #editor>div>iframe {
        width: 100% !important;
        height: 300px !important;
    }


}
</style>

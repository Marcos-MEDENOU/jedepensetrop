<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiShapePlusOutline,
  mdiSquareEditOutline,
  mdiTrashCan,
  mdiAlertBoxOutline, mdiEyeCheck,
} from "@mdi/js"
import { computed, ref, watch } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"
// import Pagination from "@/Components/Admin/Pagination.vue"
import NavBarItemLabel from '@/Components/NavBarItemLabel.vue'
import UserAvatarCurrentUser from '@/Components/UserAvatarCurrentUser.vue'
import Sort from "@/Components/Admin/Sort.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Swal from 'sweetalert2';
import axios from "axios"
const props = defineProps({
  posts: {
    type: Object,
    default: () => ({}),
  },


  category: {
    type: String,
    default: () => ({}),
  },

  filters: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})
const original_post = props.posts.data
const form = useForm({
  search: props.filters.search,
})
const userName = computed(() => usePage().props.authors.name)
const formDelete = useForm({})


function destroy(id, title) {
  Swal.fire({
    title: "Êtes-vous sur de vouloir suprimer " + title + " ?",
    text: "Cette action est irréversible",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Oui, je confirme!",
    cancelButtonText: "Non"
  }).then((result) => {
    if (result.isConfirmed) {
      try {
        formDelete.delete(route("posts.destroy", id));

        // Si la suppression réussit, afficher une notification
        Swal.fire({
          title: "Supprimer",
          text: "L'article' a été supprimée avec succès",
          icon: "success"
        });
      } catch (error) {
        // En cas d'erreur, afficher une notification d'erreur ou effectuer une autre gestion d'erreur
        Swal.fire({
          title: "Erreur",
          text: "Une erreur s'est produite lors de la suppression de l'article.",
          icon: "error"
        });
      }

    }
  });

}


// function destroy(id) {
//   if (confirm("Souhaitez-vous vraiment suprimer cet element?")) {
//     formDelete.delete(route("posts.destroy", id))
//   }
// }

function postSlicing(string) {
  return string.split(' ').slice(0, 3).join(' ').concat('...')
}

function formatDateTimeISO(dateISO) {
  const date = new Date(dateISO);
  const jour = date.getDate().toString().padStart(2, '0');
  const mois = (date.getMonth() + 1).toString().padStart(2, '0'); // Les mois sont indexés de 0 à 11
  const annee = date.getFullYear().toString();
  const heures = date.getHours().toString().padStart(2, '0');
  const minutes = date.getMinutes().toString().padStart(2, '0');
  const secondes = date.getSeconds().toString().padStart(2, '0');

  return `${jour}-${mois}-${annee}`;
}

function differenceInDays(date) {

  let today = new Date();

  // Extraire les composantes de la date
  let jour = today.getDate();
  let mois = today.getMonth() + 1; // Les mois sont indexés à partir de 0
  let annee = today.getFullYear();

  // Créer une nouvelle date avec uniquement la date (sans l'heure, minute, seconde et milliseconde)
  let endDate = new Date(annee, mois - 1, jour);

  // Convertir les dates en objets Date si elles ne le sont pas déjà
  let startDate = new Date(date);

  // Calculer la différence en millisecondes
  let timeDifference = endDate.getTime() - startDate.getTime();

  // Convertir la différence en jours
  let daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) > 0 ? Math.floor(timeDifference / (1000 * 60 * 60 * 24)) : -Math.floor(timeDifference / (1000 * 60 * 60 * 24));

  return daysDifference - 1;
}

function showStatus(post_visible, published_at) {
  // Obtenir la date d'aujourd'hui
  // Obtenir la date d'aujourd'hui
  let today = new Date();

  // Extraire les composantes de la date
  let jour = today.getDate();
  let mois = today.getMonth() + 1; // Les mois sont indexés à partir de 0
  let annee = today.getFullYear();

  // Créer une nouvelle date avec uniquement la date (sans l'heure, minute, seconde et milliseconde)
  var dateWithoutHours = new Date(annee, mois - 1, jour);



  // Créer un objet Date à partir de la chaîne de date
  var providedDates = new Date(published_at);

  // Extraire les composantes de la date
  let jourprovidedDate = providedDates.getDate();
  let moisprovidedDate = providedDates.getMonth() + 1; // Les mois sont indexés à partir de 0
  let anneeprovidedDate = providedDates.getFullYear();


  // Créer un objet Date à partir de la chaîne de date
  var providedDate = new Date(anneeprovidedDate, moisprovidedDate - 1, jourprovidedDate);


  switch (post_visible) {
    case 0:
      if (providedDate > dateWithoutHours) {
        return "en brouillon";
      } else if (providedDate < dateWithoutHours) {
        return "en brouillon";
      } else {
        return "en brouillon";
      }
      break;

    case 1:
      if (providedDate > dateWithoutHours) {
        return "publication dans";
      } else if (providedDate < dateWithoutHours) {
        return "publié";
      } else {
        return "publié";
      }
      break;

    default:
      break;
  }



}

function updateFilteredArticles(searchTerm) {
  searchTerm = searchTerm.trim().toLowerCase();

  searchTerm.trim() !== ""
    ? (props.posts.data = original_post.filter((article, index) => {
      return (
        article.title.toLowerCase().includes(searchTerm) ||
        article.slug.toLowerCase().includes(searchTerm)
        // ||
        // article.meta_description.toLowerCase().includes(searchTerm)
      );
    }))
    : (props.posts.data = original_post);


}

</script>

<template>
  <LayoutAuthenticated>

    <Head title="Articles" />
    <!-- {{ original_post }} -->
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiShapePlusOutline" title="Articles" main>
        <BaseButton v-if="can.create" :route-name="route('posts.create')" :icon="mdiPlus" label="Ajouter un article"
          color="info" rounded-full small />
      </SectionTitleLineWithButton>

      <CardBox class="mb-6" has-table>
        <!-- <form @submit.prevent="form.get(route('posts.index'))"> -->
        <div class="flex py-2">
          <div class="flex pl-2">
            <input type="search" v-model="form.search" @input="updateFilteredArticles(form.search)"
              class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              placeholder="Trouver un article " />
            <!-- <BaseButton label="Rechercher" type="submit" color="info" class="inline-flex items-center px-4 py-2 ml-4" /> -->
          </div>
        </div>
        <!-- </form> -->
      </CardBox>
      <!-- <CardBox class="mb-6" has-table>
        <form @submit.prevent="form.get(route('posts.index'))">
          <div class="flex py-2">
            <div class="flex pl-4">
              <input type="search" v-model="form.search"
                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Trouver un article " />
              <BaseButton label="Rechercher" type="submit" color="info" class="inline-flex items-center px-4 py-2 ml-4" />
            </div>
          </div>
        </form>
      </CardBox> -->

      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                <Sort label="Titre" attribute="title" />
              </th>
              <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Auteur original</span>
              </th>
              <!-- <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Modifier par</span>
              </th> -->
              <th class="flex items-center justify-center">
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Image principale</span>
              </th>
              <th class="items-center justify-center">
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Date de publication</span>
              </th>
              <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Catégorie</span>
              </th>
              <th class="flex items-center justify-center">
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Statut</span>
              </th>
              <!-- <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Prévisualiser</span>
              </th> -->
              <th v-if="can.edit || can.delete" class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody>

            <tr v-for="post in posts.data" :key="post.id">

              <td data-label="Titre">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{ postSlicing(post.title) }}
                </span>
              </td>

              <!-- <td data-label="Name">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{ (post.author_name).split(' ').slice(0,2).join(' ') }}
                </span>
              </td> -->

              <td data-label="Auteur">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{ (post.author_name).split(' ').slice(0, 2).join(' ') }}
                </span>
              </td>

              <td data-label="Image" class="">
                <img v-bind:src="`/storage/images/${post.folder}/${post.image}`" class="w-16 rounded-sm lg:mx-auto">
              </td>

              <td data-label="Date de publication">
                {{ new Date(post.published_at).toLocaleDateString() }}

              </td>

              <td data-label="categorie">
                {{ post.category_name }}
              </td>

              <td data-label="Statut" class="text-center">

                <span v-if="showStatus(post.post_visible, post.published_at) == 'publié'"
                  class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold text-green-600 rounded-full bg-green-50">
                  <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                  {{
                    showStatus(post.post_visible, post.published_at) }}
                </span>
                <span v-if="showStatus(post.post_visible, post.published_at) == 'en brouillon'"
                  class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold text-red-600 rounded-full bg-red-50">
                  <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                  {{
                    showStatus(post.post_visible, post.published_at) }}
                </span>
                <!-- <span v-if="showStatus(post.post_visible, post.published_at) == 'en brouillon'"
                  class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold text-blue-600 rounded-full bg-blue-50">
                  <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                  {{
                    showStatus(post.post_visible, post.published_at) }}
                </span> -->
                <span v-if="showStatus(post.post_visible, post.published_at) == 'publication dans'"
                  class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold text-yellow-600 rounded-full bg-yellow-50">
                  <span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span>
                  {{
                    showStatus(post.post_visible, post.published_at) }} {{ differenceInDays(post.published_at) }} jour(s)
                </span>
              </td>

              <td v-if="can.edit || can.delete" data-label="Actions" class="flex items-center lg:justify-center">
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                  <BaseButton :route-name="route('posts.show', post.id)" color="success" :icon="mdiEyeCheck" small />
                  <BaseButton v-if="can.edit" :route-name="route('posts.edit', post.id)" color="info"
                    :icon="mdiSquareEditOutline" small />
                  <BaseButton v-if="can.delete" color="danger" :icon="mdiTrashCan" small
                    @click="destroy(post.id, post.title)" />

                </BaseButtons>

              </td>
            </tr>
          </tbody>
        </table>
        <div class="py-4">
          <Pagination :data="posts" />
        </div>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>


<style>
.colorText {
  background: rgb(255, 102, 0);
  background: linear-gradient(261deg,
      rgba(255, 102, 0, 1) 0%,
      rgba(230, 151, 3, 1) 100%);
  transition: all 0.5s;
  color: #fff;
  font-weight: bold;
  border-radius: 4px;
}
</style>
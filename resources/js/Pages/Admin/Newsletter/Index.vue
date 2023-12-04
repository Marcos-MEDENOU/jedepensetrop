<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiShapePlusOutline,
  mdiSquareEditOutline,
  mdiTrashCan,
  mdiExport,
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
import * as XLSX from 'xlsx';
import NavBarItemLabel from '@/Components/NavBarItemLabel.vue'
import UserAvatarCurrentUser from '@/Components/UserAvatarCurrentUser.vue'
import Sort from "@/Components/Admin/Sort.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Swal from 'sweetalert2';
import axios from "axios"
const props = defineProps({
  newsletters: {
    type: Object,
    default: () => ({}),
  },


  // category: {
  //   type: String,
  //   default: () => ({}),
  // },

  filters: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})
const form = useForm({
  search: props.filters.search,
})
const userName = computed(() => usePage().props.authors.name)
const formDelete = useForm({})



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
        return "retiré";
      } else if (providedDate < dateWithoutHours) {
        return "en cours d\'édition";
      } else {
        return "retiré";
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


function destroy(id, email) {
  Swal.fire({
    title: "Êtes-vous sur de vouloir suprimer la newsletter de " + email + " ?",
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
        formDelete.delete(route("newsletter.destroy", id));

        // Si la suppression réussit, afficher une notification
        Swal.fire({
          title: "Supprimer",
          text: "La newsletter a été supprimée avec succès",
          icon: "success"
        });
      } catch (error) {
        // En cas d'erreur, afficher une notification d'erreur ou effectuer une autre gestion d'erreur
        Swal.fire({
          title: "Erreur",
          text: "Une erreur s'est produite lors de la suppression de la newsletter.",
          icon: "error"
        });
      }

    }
  });
  // if (confirm("Souhaitez-vous vraiment suprimer cet element?")) {
  //   formDelete.delete(route("newsletter.destroy", id))
  // }
}

function exportToExcel() {

  // Créez une copie des newsletters sans l'ID
  const newslettersWithoutId = props.newsletters.data.map(({ id, created_at, updated_at, ...rest }) => rest);

  const ws = XLSX.utils.json_to_sheet(newslettersWithoutId);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, 'Newsletters');

  const date = new Date();
  const fileName = `newsletters_export_${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}.xlsx`;

  XLSX.writeFile(wb, fileName);
}



</script>

<template>
  <LayoutAuthenticated>

    <Head title="Articles" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiShapePlusOutline" title="Newsletters" main>
        <BaseButton @click="exportToExcel" :icon="mdiExport" label="Exporter" color="info" rounded-full small />
      </SectionTitleLineWithButton>


      <CardBox class="mb-6" has-table>
        <div class="flex py-2">
          <div class="flex pl-2">
            <input type="search" v-model="form.search" @input="updateFilteredArticles(form.search)"
              class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              placeholder="Trouver une newsletter " />
          </div>
        </div>
      </CardBox>


      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                <Sort label="email" attribute="email" />
              </th>
              <th>
                <Sort label="firstname" attribute="firstname" />
              </th>

              <th>
                <Sort label="lastname" attribute="lastname" />
              </th>
              <th>
                <Sort label="question" attribute="question" />
              </th>
              <th v-if="can.delete" class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody>

            <tr v-for="newsletter in newsletters.data" :key="newsletter.id">

              <td data-label="email">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{ newsletter.email }}
                </span>
              </td>

              <td data-label="nom">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{ newsletter.firstname }}
                </span>
              </td>

              <td data-label="prénon" class="">
                {{ newsletter.lastname }}
              </td>

              <td data-label="question">
                {{ newsletter.question }}

              </td>

              <td v-if="can.delete" class="before:hidden lg:w-1 whitespace-nowrap">
                <BaseButtons type="" no-wrap>
                  <BaseButton v-if="can.delete" color="danger" :icon="mdiTrashCan" small
                    @click="destroy(newsletter.id, newsletter.email)" />
                </BaseButtons>
              </td>

            </tr>
          </tbody>
        </table>
        <div class="py-4">
          <Pagination :data="newsletters" />
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
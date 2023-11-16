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
import { computed, ref } from 'vue'
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

const form = useForm({
  search: props.filters.search,
})
const userName = computed(() => usePage().props.authors.name)
const formDelete = useForm({})

function destroy(id) {
  if (confirm("Are you sure you want to delete?")) {
    formDelete.delete(route("posts.destroy", id))
  }
}

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

  return `${jour}-${mois}-${annee} ${heures}:${minutes}:${secondes}`;
}


</script>

<template>
  <LayoutAuthenticated>

    <Head title="Articles" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiShapePlusOutline" title="Articles" main>
        <BaseButton v-if="can.delete" :route-name="route('posts.create')" :icon="mdiPlus" label="Add" color="info"
          rounded-full small />
      </SectionTitleLineWithButton>

      <CardBox class="mb-6" has-table>
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
      </CardBox>

      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                <Sort label="Titre" attribute="name" />
              </th>
              <th>
                <Sort label="Auteur" attribute="name" />
              </th>
              <th class="flex justify-center items-center">
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Image principale</span>
              </th>
              <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Date de publication</span>
              </th>
              <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Catégorie</span>
              </th>
              <th>
                <span class="no-underline hover:underline text-cyan-600 dark:text-cyan-400">Prévisualiser</span>
              </th>
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
           
            <tr v-for="post in posts.data" :key="post.id">
      
              <td data-label="Name">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{ postSlicing(post.title) }}
                </span>
              </td>

              <td data-label="Name">
                <span class="pb-4 no-underline text-cyan-600 dark:text-cyan-400">
                  {{(post.author_name)}}
                </span>
              </td>

              <td data-label="Image" class="">
               
                  <img v-bind:src="`http://127.0.0.1:8000/storage/uploads/${post.image}`" class="w-16 rounded-sm mx-auto">
              </td>
              <td data-label="Published_at">
                {{ formatDateTimeISO(post.published_at) }}
              </td>
              <td data-label="categorie">
                {{ post.category_name }}
              </td>
              <td data-label="prévisualiser">
                <Link :href="route('posts.show', post.id)"
                  class="items-center justify-center pb-4 no-underline hover:underline text-cyan-600 dark:text-cyan-400">
                <BaseButtons type="justify-start lg:justify-start lg:ml-6" no-wrap>
                  <BaseButton color="" class="items-center justify-center" :icon="mdiEyeCheck" small />
                </BaseButtons>
                </Link>
              </td>
              <td v-if="can.edit || can.delete" class="before:hidden lg:w-1 whitespace-nowrap">
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                  <BaseButton v-if="can.edit" :route-name="route('posts.edit', post.id)" color="info"
                    :icon="mdiSquareEditOutline" small />
                  <BaseButton v-if="can.delete" color="danger" :icon="mdiTrashCan" small @click="destroy(post.id)" />
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

<script setup>
import { Head, Link, useForm , usePage, router } from "@inertiajs/vue3"
import { computed, ref } from 'vue'
// import { usePage, router } from '@inertiajs/vue3'
import {
  mdiAccountGroup,
  mdiArrowLeftBoldOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButton from "@/Components/BaseButton.vue"
// const users = computed(() => usePage().props.auth.user)
const props = defineProps({
  user: {
    type: Object,
    default: () => ({}),
  },
  roles: {
    type: Object,
    default: () => ({}),
  },
  userHasRoles: {
    type: Object,
    default: () => ({}),
  }
})
</script>

<template>
  <LayoutAuthenticated>

    <Head title="Infos utilisateur" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountGroup" title="Infos utilisateur" main>
        <BaseButton :route-name="route('user.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <!-- <CardBox class="mb-6">
        <table>
          <tbody>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
                Name
              </td>
              <td data-label="Name">
                {{ user.name }}
              </td>
            </tr>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
                Email
              </td>
              <td data-label="Email">
                {{ user.email }}
              </td>
            </tr>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
                Created
              </td>
              <td data-label="Created">
                {{ new Date(user.created_at).toLocaleString() }}
              </td>
            </tr>
          </tbody>
        </table>
      </CardBox> -->


      <div
        class="relative w-full max-w-md min-w-0 mx-auto mt-24 mb-6 break-words bg-white shadow-lg lg:mt-20 md:container rounded-xl">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="flex justify-center w-full">
              <div class="relative">
                <img :src="user.image" v-if="user.image"
                  class="shadow-xl rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-[150px]" />
                <img v-else
                  src="/images/user.jpg"
                  class="shadow-xl rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-[150px]" />
              </div>
            </div>
            <div class="w-full mt-20 text-center">
              <div class="flex justify-center pt-8 pb-0 lg:pt-4">
                <div class="p-3 text-center">
                  <span class="block text-xl font-bold tracking-wide uppercase text-slate-700">0</span>
                  <span class="text-sm text-slate-400">Commentaires</span>
                </div>
                <div class="p-3 text-center">
                  <span class="block text-xl font-bold tracking-wide uppercase text-slate-700">0</span>
                  <span class="text-sm text-slate-400">Articles</span>
                </div>
                <div class="p-3 text-center">
                  <span class="block text-xl font-bold tracking-wide uppercase text-slate-700">0</span>
                  <span class="text-sm text-slate-400">J'aimes</span>
                </div>


              </div>
            </div>
          </div>
          <div class="mt-2 text-center">
            <h3 class="mb-1 text-2xl font-bold leading-normal text-slate-700"> {{ user.name }}</h3>
            <div class="mt-0 mb-2 text-xs font-bold uppercase text-slate-400">
              <i class="mr-2 opacity-75 fas fa-map-marker-alt text-slate-400"></i> {{ user.email }}
            </div>
          </div>
          <div class="py-6 mt-6 text-center border-t border-slate-200">
            <div class="flex flex-wrap justify-center">
              <div class="w-full px-4">
                <p class="mb-4 font-light leading-relaxed text-slate-600">Explorez les méandres de la réflexion et de
                  l'imagination sur jedepensetrop.fr, où chaque pensée est une étincelle d'inspiration et chaque idée un
                  voyage captivant dans l'univers de la pensée.</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>

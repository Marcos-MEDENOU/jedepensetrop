<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButton from "@/Components/BaseButton.vue"

const props = defineProps({
  authors: {
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

    <Head title="Donnée peronnelle de l'utilisateur" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiShapePlusOutline" title="Voir user" main>
        <BaseButton :route-name="route('author.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox class="mb-6">
        <table>
          <tbody>
            <tr>
              <td class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block">
                Nom de l'auteur
              </td>
              <td data-label="Name">
                {{ authors.name }}
              </td>
            </tr>
            <tr>
              <td class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block">
                Bio auteur
              </td>
              <td data-label="description">
                {{ authors.bio }}
              </td>
            </tr>
            <tr>
              <td class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block">
                email
              </td>
              <td data-label="visibility">
                {{ authors.email }}
              </td>
            </tr>

          </tbody>
        </table>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

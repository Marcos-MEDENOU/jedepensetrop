<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiPostageStamp,
  mdiArrowLeftBoldOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButton from "@/Components/BaseButton.vue"

const props = defineProps({
  categorie: {
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
    <Head title="View user" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiPostageStamp"
        title="Voir la catégorie"
        main
      >
        <BaseButton
          :route-name="route('category.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox class="mb-6">
        <table>
          <tbody>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
                Nom de la catégorie
              </td>
              <td data-label="Name">
                {{ categorie.name }}
              </td>
            </tr>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
               Description
              </td>
              <td data-label="description">
                {{ categorie.description }}
              </td>
            </tr>
         
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
                Created
              </td>
              <td data-label="Created">
                {{ new Date(categorie.created_at).toLocaleString() }}
              </td>
            </tr>
          </tbody>
        </table>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

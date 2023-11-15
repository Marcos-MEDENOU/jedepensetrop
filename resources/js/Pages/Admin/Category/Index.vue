<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiPlus,
  mdiShapePlusOutline,
  mdiSquareEditOutline,
  mdiTrashCan,
  mdiAlertBoxOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"
import Pagination from "@/Components/Admin/Pagination.vue"
import Sort from "@/Components/Admin/Sort.vue"

const props = defineProps({
  categorie: {
    type: Object,
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

const formDelete = useForm({})

function destroy(id) {
  if (confirm("Are you sure you want to delete?")) {
    formDelete.delete(route("category.destroy", id))
  }
}
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Categories" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiShapePlusOutline"
        title="Categories"
        main
      >
        <BaseButton
          v-if="can.delete"
          :route-name="route('category.create')"
          :icon="mdiPlus"
          label="Add"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      




      <CardBox class="mb-6" has-table>
        <form @submit.prevent="form.get(route('category.index'))">
          <div class="flex py-2">
            <div class="flex pl-4">
              <input
                type="search"
                v-model="form.search"
                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Search"
              />
              <BaseButton
                label="Search"
                type="submit"
                color="info"
                class="inline-flex items-center px-4 py-2 ml-4"
              />
            </div>
          </div>
        </form>
      </CardBox>
      <CardBox class="mb-6" has-table>
        <table>
          <thead>
            <tr>
              <th>
                <Sort label="Nom de la catégorie" attribute="name" />
              </th>
              <th>
                <Sort label="Description" attribute="description" />
              </th>
              <th>
                <Sort label="Visibilité" attribute="is_visible" />
              </th>
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <!-- <tr></tr> -->
            <tr v-for="category in categorie.data" :key="category.id">
              <td data-label="Name">
                <Link
                  :href="route('category.show', category.id)"
                  class="no-underline hover:underline text-cyan-600 dark:text-cyan-400"
                >
                  {{ category.name }}
                </Link>
              </td>
              <td data-label="Description">
                {{ category.description }}
              </td>
              <td data-label="visibility">
                {{ category.is_visible }}
              </td>
              <td
                v-if="can.edit || can.delete"
                class="before:hidden lg:w-1 whitespace-nowrap"
              >
                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                  <BaseButton
                    v-if="can.edit"
                    :route-name="route('category.edit', category.id)"
                    color="info"
                    :icon="mdiSquareEditOutline"
                    small
                  />
                  <BaseButton
                    v-if="can.delete"
                    color="danger"
                    :icon="mdiTrashCan"
                    small
                    @click="destroy(category.id)"
                  />
                </BaseButtons>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="py-4">
          <Pagination :data="categorie" />
        </div>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

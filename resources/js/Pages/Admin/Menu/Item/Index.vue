<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiLink,
  mdiPlus,
  mdiMenu,
  mdiTrashCan,
  mdiAlertBoxOutline,
  mdiArrowLeftBoldOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import BaseButton from "@/Components/BaseButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButtons from "@/Components/BaseButtons.vue"
import NotificationBar from "@/Components/NotificationBar.vue"
import MenuItemList from "@/Components/Admin/MenuItemList.vue"

const props = defineProps({
  items: {
    type: Object,
    default: () => ({}),
  },
  menu: {
    type: Object,
    default: () => ({}),
  },
  can: {
    type: Object,
    default: () => ({}),
  },
})

const formDelete = useForm({})

function destroy(id) {
  if (confirm("Are you sure you want to delete?")) {
    formDelete.delete(route("menu.item.destroy", { menu: props.menu.id, item: id }))
  }
}

</script>

<template>
  <LayoutAuthenticated>

    <Head title="Menu Items" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiLink" title="Menu Items" main>
        <BaseButtons type="justify-start lg:justify-end" no-wrap>
          <BaseButton :route-name="route('menu.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
            rounded-full small />
          <BaseButton v-if="can.delete" :route-name="route('menu.item.create', menu.id)" :icon="mdiPlus" label="Ajouter"
            color="info" rounded-full small />
        </BaseButtons>
      </SectionTitleLineWithButton>
      <!-- <NotificationBar
        v-if="$page.props.flash.message"
        color="success"
        :icon="mdiAlertBoxOutline"
      >
        {{ $page.props.flash.message }}
      </NotificationBar> -->
      <CardBox class="mb-6" has-table>
        <table
          class="w-full text-sm bg-white border border-collapse shadow-sm border-slate-400 dark:border-slate-500 dark:bg-slate-800">
          <tbody>
            <tr>
              <td class="hidden p-4 pl-8  text-slate-500 dark:text-slate-400 lg:block">
                Name
              </td>
              <td data-label="Name">
                {{ menu.name }}
              </td>
            </tr>
            <tr>
              <td class="hidden p-4 pl-8  text-slate-500 dark:text-slate-400 lg:block">
                Machine name
              </td>
              <td data-label="Machine Name">
                {{ menu.machine_name }}
              </td>
            </tr>
          </tbody>
        </table>
        <table>
          <thead>
            <tr>
              <th>
                Name
              </th>
              <th>
                Description
              </th>
              <th>
                Enable
              </th>
              <th v-if="can.edit || can.delete">Actions</th>
            </tr>
          </thead>

          <tbody>
            <template v-for="item in items">
              <MenuItemList :item="item" :menu="menu" :can="can" :level=0 />
            </template>
          </tbody>
        </table>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

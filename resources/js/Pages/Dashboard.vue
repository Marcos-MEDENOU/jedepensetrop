<script setup>
import { computed, ref, onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SectionMain from '@/Components/SectionMain.vue'
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue'
import BaseButton from '@/Components/BaseButton.vue'
import { useMainStore } from '@/Stores/main'
import CardBoxWidget from '@/Components/CardBoxWidget.vue'
import CardBox from '@/Components/CardBox.vue'
import TableSampleClients from '@/Components/TableSampleClients.vue'
import { Head } from '@inertiajs/vue3';
import { mdiNoteSearch, mdiAccountMultiple, mdiChartTimelineVariant, mdiEyeSettings } from '@mdi/js'
const mainStore = useMainStore()

const props = defineProps({
  users: {
    type: Number,
    default: () => (null),
  },
  posts: {
    type: Number,
    default: () => (null),
  },
  listusers:{
    type:Array,
    default:([])
  }
})

</script>

<template>
  <AuthenticatedLayout>

    <Head title="Espace d'administration" />

    <SectionMain>

      <SectionTitleLineWithButton :icon="mdiChartTimelineVariant" title="Espace d'administration" main>

      </SectionTitleLineWithButton>

      <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
        <CardBoxWidget trend="Gestionnaire" trend-type="up" color="text-emerald-500" :icon="mdiAccountMultiple" :number="users"
          label="Total Administrateurs" />
        <CardBoxWidget trend="Contenus publié" trend-type="down" color="text-red-500" :icon="mdiNoteSearch" :number="posts" prefix=""
          label="Total Articles" />
        <CardBoxWidget trend="visteurs" trend-type="alert" color="text-yellow-600" :icon="mdiEyeSettings" :number="256"
          suffix="" label="Total vues" />
      </div>
      <CardBox :icon="mdiMonitorCellphone" title="Liste des Admins du site" has-table>
        <TableSampleClients :list="listusers" />
      </CardBox>
    </SectionMain>
  </AuthenticatedLayout>
</template>

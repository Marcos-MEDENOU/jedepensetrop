<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline,
  mdiShapePlusOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
  visibility: {
    type: Object,
    default: () => ({}),
  }
})

const form = useForm({
  name: '',
  bio: '',
  email: '',
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Ajouter un auteur" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiShapePlusOutline"
        title="Ajouter un auteur"
        main
      >
        <BaseButton
          :route-name="route('author.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('author.store'))"
      >
        <FormField
          label="Nom de l'auteur"
          :class="{ 'text-red-400': form.errors.name }"
        >
          <FormControl
            v-model="form.name"
            type="text"
            required="required"
            placeholder="Entrer un nouvel auteur"
            :error="form.errors.name"
          >
            <div class="text-sm text-red-400" v-if="form.errors.name">
              {{ form.errors.name }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Email"
          :class="{ 'text-red-400': form.errors.email }"
        >
          <FormControl
            v-model="form.email"
            type="email"
            placeholder="Adresse électronique *ex:jedepensetrop@exemple.com*"
            :error="form.errors.email"
          >
            <div class="text-sm text-red-400" v-if="form.errors.email">
              {{ form.errors.email }}
            </div>
          </FormControl>
        </FormField>

        <FormField
          label="bio"
          :class="{ 'text-red-400': form.errors.bio }"
        >
          <FormControl
            v-model="form.bio"
            type="text"
            placeholder="Une petite bio"
            :error="form.errors.bio"
          >
            <div class="text-sm text-red-400" v-if="form.errors.slug">
              {{ form.errors.bio }}
            </div>
          </FormControl>
        </FormField>
        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

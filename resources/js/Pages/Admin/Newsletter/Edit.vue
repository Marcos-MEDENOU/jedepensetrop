<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline
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
import FormFilePicker from "@/Components/FormFilePicker.vue"
import { ref, onMounted } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import fileUploads from '@/Components/FormFilePicker.vue'
import Tiny from '@/components/TinyImplements.vue';
import 'tinymce/models/dom';
import FileUpload from 'primevue/fileupload';
import 'primevue/resources/themes/lara-light-teal/theme.css'
import Editor from '@/components/Editor.vue'

import ckeditor from '@/Components/Ckeditor.vue'
const props = defineProps({
  posts: {
    type: Object,
    default: () => ({}),
  },

  visibility: {
    type: Object,
    default: () => ({}),
  },

  category: {
    type: Object,
    default: () => ({}),
  },

  roles: {
    type: Object,
    default: () => ({}),
  },
})
const setDate = (value) => {
  date.value = value;
}
const form = useForm({
  _method: 'put',
  title: props.posts.title,
  slug: props.posts.slug,
  content: props.posts.content,
  published_at: props.posts.published_at,
  seo_title: props.posts.seo_title,
  seo_description: props.posts.seo_description,
  image: props.posts.image,
  is_visible: props.posts.post_visible,
  category: props.posts.blog_category_id,
  // name: props.authors.name,
  // bio: props.authors.bio,
  // email: props.authors.email,
})


const handleFileChange = (event) => {
  form.image = event.target.files[0]['name'];
}


const date = ref(new Date());
// In case of a range picker, you'll receive [Date, Date]
const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();

  return `${day}/${month}/${year}`;
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
</script>

<template>
  <LayoutAuthenticated>

    <Head title="Modifier article" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountKey" title="Mise a jour article" main>
        <BaseButton :route-name="route('posts.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>

      <CardBox form @submit.prevent="form.post(route('posts.update', props.posts.id))">
        <FormField label="Titre de l'article" :class="{ 'text-red-400': form.errors.title }">
          <FormControl v-model="form.title" type="text" required="required"
            placeholder="Entrer un titre pour votre article" :error="form.errors.title">
            <div class="text-sm text-red-400" v-if="form.errors.title">
              {{ form.errors.title }}
            </div>
          </FormControl>
        </FormField>
        <FormField label="slug" :class="{ 'text-red-400': form.errors.slug }">
          <FormControl v-model="form.slug" :readonly="true" type="text" placeholder="un slug pour le referencement"
            :error="form.errors.slug">
            <div class="text-sm text-red-400" v-if="form.errors.slug">
              {{ form.errors.slug }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Contenu de l'article" :class="{ 'text-red-400': form.errors.content }">
          <div class="mt-4"></div>
        </FormField>
        <!-- <editor v-model="form.content" /> -->
        <Tiny v-model="form.content" class=" max-w-none" />

        <!-- zone editeur -->
        <!-- <ckeditor v-model="form.content" /> -->
        <!-- zone editeur -->

        
        <div class="mt-4"></div>

        <FormField label="Date de publication" :class="{ 'text-red-400': form.errors.content }">
          <VueDatePicker v-model="form.published_at" date position="left" :format="format"
            :model-value="form.published_at" utc @update:model-value="setDate" />
        </FormField>

        <FormField label="Mettre une image en avant" :class="{ 'text-red-400': form.errors.content }">
          <fileUploads @change="handleFileChange" v-model="form.image"></fileUploads>
        </FormField>

        <FormField label="Seo titre" :class="{ 'text-red-400': form.errors.seo_title }">
          <FormControl v-model="form.seo_title" type="text" placeholder="Charger une image principale ici"
            :error="form.errors.seo_title">
            <div class="text-sm text-red-400" v-if="form.errors.seo_title">
              {{ form.errors.seo_title }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Seo description" :class="{ 'text-red-400': form.errors.seo_description }">
          <FormControl v-model="form.seo_description" type="text" placeholder="" :error="form.errors.seo_description">
            <div class="text-sm text-red-400" v-if="form.errors.seo_description">
              {{ form.errors.seo_description }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Categories" wrap-body>
          <!-- {{ props.posts.blog_category_id}} -->
          <FormCheckRadioGroup v-model="form.category" aria-checked="true" name="category" type="radio" isRow
            :options="props.category" />
        </FormField>

        <FormField label="Visibilité" wrap-body>
          <FormCheckRadioGroup v-model="form.is_visible" name="is_visible" type="radio" isRow
            :options="props.visibility" />
        </FormField>

        <template #footer>
          <BaseButtons>
            <BaseButton type="submit" color="info" label="Submit" :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

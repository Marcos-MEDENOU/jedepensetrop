<script setup>
// import { Head, Link, useForm } from "@inertiajs/vue3"
import { Head, Link, useForm, usePage, router } from "@inertiajs/vue3"
import { computed } from 'vue'
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
import FormFilePicker from "@/Components/FormFilePicker.vue"
import { ref, onMounted, watch } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import fileUploads from '@/Components/FormFilePicker.vue'
import Tiny from '@/components/TinyImplements.vue';
import slugify from 'slugify';
import 'tinymce/models/dom';
import FileUpload from 'primevue/fileupload';
import 'primevue/resources/themes/lara-light-teal/theme.css'

import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js";
import FilePondPluginImagePreview from "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js";
import Swal from 'sweetalert2';
import axios from "axios"

// Import styles
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

const props = defineProps({
  visibility: {
    type: Object,
    default: () => ({}),
  },
  category: {
    type: Object,
    default: () => ({}),
  },
  files: {
    type: Array,
    default: () => ([])
  }
})

// Create FilePond component
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview
);

const page = usePage();
const pond = ref(null);
const files = ref([]);
const csrf = computed(() => page.props.csrf_token);


const date = ref(new Date());

const setDate = (value) => {
  date.value = value;
}

const handleFileChange = (event) => {
  form.image = event.target.files[0]['name'];
}

const form = useForm({
  title: '',
  slug: '',
  content: '',
  published_at: '',
  seo_title: '',
  seo_description: '',
  image: '',
  is_visible: ['non'],
  category: [],
})

const updateSlug = () => {
  form.slug = generateSlug(form.title);
};

const generateSlug = (title) => {
  const trimmedTitle = title.trim();
  const slug = slugify(trimmedTitle, {
    lower: true,
    remove: /[*+~.()'"!:@?]/g,
  });
  return slug;
};

watch(form.title, updateSlug);

function handleFilePondLoad(response) {
  form.image = response
  return response
}


function handleFilePondRevert(uniqueId, load, error) {

  router.delete('/revert/' + uniqueId);
  load();
}

function handleFilePondRemove(source, load, error) {
  form.image = '';
  load();
}

function addPost() {
  try {
    form.post(route('posts.store'))

    // Si la suppression réussit, afficher une notification
    Swal.fire({
      title: "Du contenu!",
      text: "L'article a été ajouté avec succès",
      icon: "success"
    });
  } catch (error) {
    // En cas d'erreur, afficher une notification d'erreur ou effectuer une autre gestion d'erreur
    Swal.fire({
      title: "Erreur",
      text: "Une erreur s'est produite lors de l'ajout' de la l'article.",
      icon: "error"
    });
  }
}
</script>
<!-- form.post(route('posts.store')) -->

<template>
  <LayoutAuthenticated>

    <Head title="Ajouter un article" />

    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiShapePlusOutline" title="Ajouter un article" main>
        <BaseButton :route-name="route('posts.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox form @submit.prevent="addPost()">

        <FormField label="Titre de l'article" :class="{ 'text-red-400': form.errors.title }">
          <FormControl v-model="form.title" type="text" required="required" @input="updateSlug"
            placeholder="Entrer un titre pour votre article" :error="form.errors.title">
            <div class="text-sm text-red-400" v-if="form.errors.title">
              {{ form.errors.title }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="slug" :class="{ 'text-red-400': form.errors.slug }">
          <FormControl :readonly="true" v-model="form.slug" type="text" placeholder="un slug pour le referencement"
            :error="form.errors.slug">
            <div class="text-sm text-red-400" v-if="form.errors.slug">
              {{ form.errors.slug }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Contenu de l'article" :class="{ 'text-red-400': form.errors.content }">
          <div class="mt-4"></div>
        </FormField>
        <Tiny v-model="form.content" />
        <div class="mt-4"></div>

        <FormField label="Date de publication" :class="{ 'text-red-400': form.errors.content }">
          <VueDatePicker v-model="form.published_at" utc position="left" :model-value="form.published_at"
            @update:model-value="setDate" />
        </FormField>

        <FormField label="Mettre une image en avant" :class="{ 'text-red-400': form.errors.content }">
          <!-- <fileUploads @change="handleFileChange"></fileUploads> -->

          <file-pond style="width: 100% !important;" name="image" ref="pond" class-name="my-pond" max-files="1"
            label-idle="Télécharger une image principale ici..." allow-multiple="false"
            accepted-file-types="image/jpeg, image/png" :files="files" :server="{
              process: {
                url: '/upload',
                method: 'POST',
                onload: handleFilePondLoad
              },
              revert: handleFilePondRevert,
              remove: handleFilePondRemove,
              headers: {
                'X-CSRF-TOKEN': $page.props.csrf_token,
              },
            }" />

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
          <FormCheckRadioGroup v-model="form.category" name="category" type="radio" isRow :options="props.category" />
        </FormField>

        <FormField label="Visibilité" wrap-body>
          <FormCheckRadioGroup v-model="form.is_visible" name="is_visible" type="radio" isRow
            :options="props.visibility" />
        </FormField>

        <template #footer>
          <BaseButtons>
            <BaseButton type="submit" color="info" label="Sauvegarder" :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>


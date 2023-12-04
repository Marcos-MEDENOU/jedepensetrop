<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3"
import { computed } from 'vue'
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
// import { ref, onMounted } from 'vue';
import { ref, onMounted, watch } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import fileUploads from '@/Components/FormFilePicker.vue'
import Tiny from '@/components/TinyImplements.vue';
import 'tinymce/models/dom';
import FileUpload from 'primevue/fileupload';
// import 'primevue/resources/themes/lara-light-teal/theme.css'
import Editor from '@/components/Editor.vue'
import slugify from 'slugify';
import ckeditor from '@/Components/Ckeditor.vue';
import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js";
import FilePondPluginImagePreview from "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js";

import Swal from 'sweetalert2';
import axios from "axios"
// Import styles
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import the plugin styles
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css';


// Import the plugin code
import FilePondPluginFilePoster from 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.esm';

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


// Create FilePond component
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview,
  FilePondPluginFilePoster
);



function handleFilePondRevert(uniqueId, load, error) {

  router.delete('/revert/' + uniqueId);
  load();
}

const page = usePage();



const csrf = computed(() => page.props.csrf_token);


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
  folder: props.posts.folder,
  is_visible: props.posts.post_visible,
  category: props.posts.blog_category_id,
})



function handleFilePondLoad(response) {
  form.folder = response
  return response
}


const files = ref([]);

const handleFileChange = (event) => {
  form.image = event.target.files[0]['name'];
}

function handleFilePondRemove(source, load, error) {
  form.image = '';
  load();
}

const handleFilePondInit = () => {
  if (form.image) {
    files.value = [{

      source: '/storage/images/' + props.posts.folder + '/' + props.posts.image,

      options: {
        type: 'local',
        metadata: {
          poster: '/storage/images/' + props.posts.folder + '/' + props.posts.image
        },
        stylePanelAspectRatio: 16 / 9, // Exemple : ratio largeur/hauteur
        styleItemPanelAspectRatio: 16 / 5, // Exemple : maintenir un carré
        styleItemPosition: 'center center', // Exemple : centrer l'image
      }

    }];
  } else {
    files = [];
  }
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


function updatePost() {
  try {
    form.post(route('posts.update', props.posts.id))

    if (form.title == props.posts.title &&
      form.slug == props.posts.slug &&
      form.content == props.posts.content &&
      form.published_at == props.posts.published_at &&
      form.seo_title == props.posts.seo_title &&
      form.seo_description == props.posts.seo_description &&
      form.image == props.posts.image &&
      form.folder == props.posts.folder &&
      form.is_visible == props.posts.post_visible &&
      form.category == props.posts.blog_category_id
    ) {

      // Si la suppression réussit, afficher une notification
      Swal.fire({
        title: "Tentative de mise a jour annulé!",
        text: "Aucune modification apporté a cet article",
        icon: "success"
      });


    } else {
      // Si la suppression réussit, afficher une notification
      Swal.fire({
        title: "Mise a jour!",
        text: "L'article a été modifié avec succès",
        icon: "success"
      });
    }


  } catch (error) {
    // En cas d'erreur, afficher une notification d'erreur ou effectuer une autre gestion d'erreur
    Swal.fire({
      title: "Erreur",
      text: "Une erreur s'est produite lors de la mise a jour' de la l'article.",
      icon: "error"
    });
  }
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

      <CardBox form @submit.prevent="updatePost()">
        <FormField label="Titre de l'article" :class="{ 'text-red-400': form.errors.title }">
          <FormControl v-model="form.title" type="text" required="required" @input="updateSlug"
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
          <VueDatePicker v-model="form.published_at" date position="left" :model-value="form.published_at" utc
            @update:model-value="setDate" />
          <!-- <VueDatePicker v-model="form.published_at" date position="left" :format="format"
            :model-value="form.published_at" utc @update:model-value="setDate" /> -->
        </FormField>

        <FormField label="Mettre une image en avant" :class="{ 'text-red-400': form.errors.content }">

          <!-- {{ posts }} -->

          <file-pond style="width: 100% !important;" name="image" ref="pond" class-name="my-pond" max-files="1"
            label-idle="Télécharger une nouvelle image principale ici si vous le souhaitez..." allow-multiple="false"
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
            }" v-on:init="handleFilePondInit" />
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
            <BaseButton type="submit" color="info" label="Enrégistrer les nouvelles modification"
              :class="{ 'opacity-25': form.processing }" :disabled="form.processing" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

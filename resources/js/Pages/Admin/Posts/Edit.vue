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

const props = defineProps({
  posts: {
    type: Object,
    default: () => ({}),
  },

  roles: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  _method: 'put',
  title: props.posts.title,
  slug: props.posts.slug,
  content: props.posts.content,
  published_at: props.posts.published_at,
  seo_title: props.posts.seo_title,
  seo_description: props.posts.seo_description,
  image: props.posts.image,
  is_visible: props.posts.is_visible,
  category: props.posts.category,
  // name: props.authors.name,
  // bio: props.authors.bio,
  // email: props.authors.email,
})
</script>

<template>
  <LayoutAuthenticated>
  
    <Head title="Modifier article" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountKey" title="Mise a jour article" main>
        <BaseButton :route-name="route('posts.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>

      <CardBox form @submit.prevent="form.post(route('posts.update', props.authors.id))">
        <FormField label="Titre de l'article" :class="{ 'text-red-400': form.errors.title }">
          <FormControl v-model="form.title" type="text" required="required"
            placeholder="Entrer un titre pour votre article" :error="form.errors.title">
            <div class="text-sm text-red-400" v-if="form.errors.title">
              {{ form.errors.title }}
            </div>
          </FormControl>
        </FormField>
        <FormField label="slug" :class="{ 'text-red-400': form.errors.slug }">
          <FormControl v-model="form.slug" type="text" placeholder="un slug pour le referencement"
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
          <fileUploads @change="handleFileChange"></fileUploads>
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
          
          <FormCheckRadioGroup v-model="form.category" name="category" type="radio" isRow :options="form.category" />
        </FormField>

        <FormField label="Visibilité" wrap-body>
          <FormCheckRadioGroup v-model="form.is_visible" name="is_visible" type="radio" isRow
            :options="form.is_visible" />
        </FormField>
        <!-- <FormField
          label="Nom de l'auteur'"
          :class="{ 'text-red-400': form.errors.name }"
        >
          <FormControl
            v-model="form.name"
            type="text"
            placeholder="Name"
            :error="form.errors.name"
          >
            <div class="text-sm text-red-400" v-if="form.errors.name">
              {{ form.name}}
            </div>
          </FormControl>
        </FormField>

        <FormField
          label="bio"
          :class="{ 'text-red-400': form.errors.description }"
        >
          <FormControl
            v-model="form.bio"
            type="text"
            placeholder="biographie"
            :error="form.errors.bio"
          >
            <div class="text-sm text-red-400" v-if="form.errors.bio">
              {{ form.bio }}
            </div>
          </FormControl>
        </FormField>

        <FormField
          label="email"
          :class="{ 'text-red-400': form.errors.email }"
        >
          <FormControl
            v-model="form.email"
            type="text"
            placeholder="Adresse électronique"
            :error="form.errors.email"
          >
            <div class="text-sm text-red-400" v-if="form.errors.email">
              {{ form.errors.email }}
            </div>
          </FormControl>
        </FormField>

        -->
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

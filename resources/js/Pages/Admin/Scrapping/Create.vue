<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline,
  mdiShapePlusOutline, mdiCableData
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
    remove: /[*+~.()'"!:@]/g,
  });
  return slug;
};

watch(form.title, updateSlug);

</script>


<template>
  <LayoutAuthenticated>

    <Head title="Ajouter un article" />

    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiCableData" title="Scrapper un article" main>
        <BaseButton :route-name="route('posts.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox form @submit.prevent="form.post(route('posts.store'))">
        <FormField label="Thématique" :class="{ 'text-red-400': form.errors.title }">
          <FormControl v-model="form.title" type="text" required="required" @input="updateSlug"
            placeholder="" :error="form.errors.title">
            <div class="text-sm text-red-400" v-if="form.errors.title">
              {{ form.errors.title }}ccc
            </div>
            <p v-if="form.title.length==0" class="mt-1 text-xs italic text-red-600 text-red">*Merci de renseigner une tématique en rapport avec le contenu a scrapper.</p>
          </FormControl>
        </FormField>
        <FormField label="URL" :class="{ 'text-red-400': form.errors.slug }">
          <FormControl  v-model="form.slug" type="text" placeholder=""
            :error="form.errors.slug">
            <div class="text-sm text-red-400" v-if="form.errors.slug">
              {{ form.errors.slug }}
            </div>
            <p class="mt-1 text-xs italic text-red-600 text-red">*Le lien d'acces du site a scrapper.</p>
          </FormControl>
        </FormField>
        <FormField label="Mots clés" :class="{ 'text-red-400': form.errors.slug }">
          <FormControl v-model="form.slug" type="text" placeholder=""
            :error="form.errors.slug">
            <div class="text-sm text-red-400" v-if="form.errors.slug">
              {{ form.errors.slug }}
            </div>
            <p class="mt-1 text-xs italic text-red-600 text-red">*Quelques mots clés pour affiner le resultat</p>
          </FormControl>
        </FormField>

        <!-- <FormField label="Contenu de l'article" :class="{ 'text-red-400': form.errors.content }">
          <div class="mt-4"></div>
        </FormField>
        <Tiny v-model="form.content" />
        <div class="mt-4"></div> -->

        <!-- <FormField label="Date de publication" :class="{ 'text-red-400': form.errors.content }">
          <VueDatePicker v-model="form.published_at" utc position="left" :model-value="form.published_at"
            @update:model-value="setDate" />
        </FormField> -->

        <!-- <FormField label="Mettre une image en avant" :class="{ 'text-red-400': form.errors.content }">
          <fileUploads @change="handleFileChange"></fileUploads>

        </FormField> -->

        <!-- <FormField label="Seo titre" :class="{ 'text-red-400': form.errors.seo_title }">
          <FormControl v-model="form.seo_title" type="text" placeholder="Charger une image principale ici"
            :error="form.errors.seo_title">
            <div class="text-sm text-red-400" v-if="form.errors.seo_title">
              {{ form.errors.seo_title }}
            </div>
          </FormControl>
        </FormField> -->

        <!-- <FormField label="Seo description" :class="{ 'text-red-400': form.errors.seo_description }">
          <FormControl v-model="form.seo_description" type="text" placeholder="" :error="form.errors.seo_description">
            <div class="text-sm text-red-400" v-if="form.errors.seo_description">
              {{ form.errors.seo_description }}
            </div>
          </FormControl>
        </FormField> -->

        <!-- <FormField label="Categories" wrap-body>
          <FormCheckRadioGroup v-model="form.category" name="category" type="radio" isRow :options="props.category" />
        </FormField> -->

        <!-- <FormField label="Visibilité" wrap-body>
          <FormCheckRadioGroup v-model="form.is_visible" name="is_visible" type="radio" isRow
            :options="props.visibility" />
        </FormField> -->

        <template #footer>
          <BaseButtons>
            <BaseButton type="submit" color="info" label="Démarrer le scrapping"
              :class="{ 'opacity-25': form.processing }" :disabled="form.processing" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>


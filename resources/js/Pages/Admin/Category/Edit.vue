<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiPostageStamp,
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
import { ref, onMounted, watch } from 'vue';
import slugify from 'slugify';

import Swal from 'sweetalert2';
import axios from "axios"


const props = defineProps({

  categorie: {
    type: Object,
    default: () => ({}),
  },
  visibility: {
    type: Object,
    default: () => ({}),
  },
  roles: {
    type: Object,
    default: () => ({}),
  },
  all_visibility: {
    type: Object,
    default: () => ({}),
  }
})

const form = useForm({
  _method: 'put',
  name: props.categorie.name,
  description: props.categorie.description,
  slug: props.categorie.slug,
  // seo_title: props.categorie.seo_title,
  // seo_description: props.categorie.seo_description,
  // visibility:props.visibility,
})

const updateSlug = () => {
  form.slug = generateSlug(form.name);
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


function updateCategory() {
  try {
    form.post(route('category.update', props.categorie.id))

    // Si la suppression réussit, afficher une notification
    Swal.fire({
      title: "Mise a jour!",
      text: "L'article a été modifié avec succès",
      icon: "success"
    });
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

    <Head title="Modifier l'utilisateur" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiPostageStamp" title="Mise a jour categorie" main>
        <BaseButton :route-name="route('category.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox form @submit.prevent="updateCategory">
        <FormField label="Nom de la catégorie" @input="updateSlug" :class="{ 'text-red-400': form.errors.name }">
          <FormControl v-model="form.name" type="text" placeholder="Name" :error="form.errors.name">
            <div class="text-sm text-red-400" v-if="form.errors.name">
              {{ form.user.name }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="Description" :class="{ 'text-red-400': form.errors.description }">
          <FormControl v-model="form.description" type="text" placeholder="Mettez une petite description"
            :error="form.errors.description">
            <div class="text-sm text-red-400" v-if="form.errors.description">
              {{ form.category.description }}
            </div>
          </FormControl>
        </FormField>

        <FormField label="slug" :class="{ 'text-red-400': form.errors.slug }">
          <FormControl v-model="form.slug" type="text" placeholder="Un slug pour le reférencement"
            :error="form.errors.slug">
            <div class="text-sm text-red-400" v-if="form.errors.slug">
              {{ form.errors.slug }}
            </div>
          </FormControl>
        </FormField>
        <!-- <FormField
          label="SEO titre"
          :class="{ 'text-red-400': form.errors.seo_title }"
        >
          <FormControl
            v-model="form.seo_title"
            type="text"
            placeholder="Titre optimisé SEO"
            :error="form.errors.seo_title"
          >
            <div class="text-sm text-red-400" v-if="form.errors.seo_title">
              {{ form.errors.seo_title }}
            </div>
          </FormControl>
        </FormField>

        <FormField
          label="SEO Description"
          :class="{ 'text-red-400': form.errors.seo_description }"
        >
          <FormControl
            v-model="form.seo_description"
            type="text"
            placeholder="Description seo"
            :error="form.errors.seo_description"
          >
            <div class="text-sm text-red-400" v-if="form.errors.seo_description">
              {{ form.errors.seo_description }}
            </div>
          </FormControl>
        </FormField> -->


        <!-- <BaseDivider /> -->

        <!-- <FormField
          label="Visibilité"
          wrap-body
        >
          <FormCheckRadioGroup
            v-model="form.visibility"
            name="visibility"
            type="radio"
            is-column
            :options="props.all_visibility"
          />
        </FormField> -->

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

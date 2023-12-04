<script setup>
import { mdiUpload } from '@mdi/js'
import { computed, ref, watch } from 'vue'
import BaseButton from '@/Components/BaseButton.vue'
import axios from 'axios'
const props = defineProps({
  modelValue: {
    type: [Object, File, Array],
    default: null
  },
  label: {
    type: String,
    default: 'Upload'
  },
  icon: {
    type: String,
    default: mdiUpload
  },
  accept: {
    type: String,
    default: null
  },
  color: {
    type: String,
    default: 'info'
  }
})

const emit = defineEmits(['update:modelValue'])

const root = ref(null)

const file = ref(props.modelValue)

const modelValueProp = computed(() => props.modelValue)

watch(modelValueProp, value => {
  file.value = value

  if (!value) {
    root.value.input.value = null
  }
})

const upload = event => {
  const value = event.target.files || event.dataTransfer.files

  file.value = value[0]

  emit('update:modelValue', file.value)
  let formData = new FormData()
  formData.append('image', file.value)

  const mediaStoreRoute = `/upload`

  axios
    .post(mediaStoreRoute, formData, {

      headers: {
        'Content-Type': 'multipart/form-data'
      },
      onUploadProgress: progressEvent
    })
    .then(r => {
     this.$emit('image', r.data);
    })
    .catch(err => {
      // console.error("Une erreur s'est produite");
    })
}

const uploadPercent = ref(0)

const progressEvent = progressEvent => {
  uploadPercent.value = Math.round(
    (progressEvent.loaded * 100) / progressEvent.total
  )
}
</script>

<template>
  <div class="relative flex items-stretch justify-start">
    <label class="inline-flex">
      <BaseButton as="a" :label="label" :icon="icon" :color="color" :class="{ 'rounded-r-none': file }" />
      <input ref="root" type="file" class="absolute top-0 left-0 w-full h-full outline-none opacity-0 cursor-pointer -z-1"
        :accept="accept" @input="upload" >
    </label>
    <div v-if="file">
      <span
        class="inline-flex justify-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-r dark:bg-slate-800 dark:border-slate-700">
        {{ file.name }}
      </span>
      <div class="preview">
        <img id="file-ip-1-preview">
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  username: {
    type: String,
    required: true
  },
  avatar: {
    type: String,
    default: null
  },
  api: {
    type: String,
    default: 'avataaars'
  },

})



const avatar = computed(
  () => props.avatar ? props.avatar : `/images/user.jpg`
)

const username = computed(() => props.username)
</script>

<template>
  <div>
    <img :src="avatar" :alt="username" class="block w-full h-auto max-w-full bg-gray-100 rounded-full dark:bg-slate-800">
  </div>
</template>

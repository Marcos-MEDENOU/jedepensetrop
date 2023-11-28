<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import UserAvatar from '@/Components/UserAvatar.vue'

const userName = computed(() => usePage().props.auth.user.name)
const avatar = computed(() => usePage().props.auth.user)

</script>

<template>

  <UserAvatar :avatar="avatar.image"
    :username="userName"
    api="initials"
  />
</template>
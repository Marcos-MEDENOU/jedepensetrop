<script setup>
import { computed } from 'vue'
import { containerMaxW } from '@/config.js';
import BaseLevel from '@/Components/BaseLevel.vue'
import AppLogo from '@/Components/ApplicationLogo.vue'

const year = computed(() => new Date().getFullYear())
</script>

<template>
  <footer class="container items-center justify-center px-6 py-2 mx-auto">
    <BaseLevel :class="containerMaxW">
      <div class="text-center md:text-left">
        <b>&copy;{{ year }}, <a href="/dashboard" target="_blank">Jedepensetrop</a>.</b>
        Tout droit réservé
      </div>
      <div class="md:py-2">
        <a href="/dashboard">
          <AppLogo class="w-20 h-auto " />
        </a>
      </div>
    </BaseLevel>
  </footer>
</template>

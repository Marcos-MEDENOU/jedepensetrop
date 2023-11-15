<script setup>
import { computed } from 'vue'
import { containerMaxW } from '@/config.js';
import BaseLevel from '@/Components/BaseLevel.vue'
import VippLogo from '@/Components/JustboilLogo.vue'

const year = computed(() => new Date().getFullYear())
</script>

<template>
  <footer class="px-6 py-2">
    <BaseLevel :class="containerMaxW">
      <div class="text-center md:text-left">
        <b>&copy;{{ year }}, <a
          href="127.0.0.1"
          target="_blank"
        >Vipp interstis</a>.</b>
       Tout droit réservé
      </div>
      <div class="md:py-2">
        <a href="127.0.0.1">
          <VippLogo class="w-auto h-8 md:h-6" />
        </a>
      </div>
    </BaseLevel>
  </footer>
</template>

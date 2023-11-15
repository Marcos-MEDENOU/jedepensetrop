<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { useLayoutStore } from '@/Stores/layout.js'
import { useStyleStore } from '@/Stores/style.js'
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import NavBar from '@/Components/NavBar.vue'
import AsideMenu from '@/Components/AsideMenu.vue'
import FooterBar from '@/Components/FooterBar.vue'

const styleStore = useStyleStore()
const layoutStore = useLayoutStore()

const showingNavigationDropdown = ref(false);
</script>

<template>
    
  <div :class="{ 'dark': styleStore.darkMode, 'overflow-hidden lg:overflow-visible': layoutStore.isAsideMobileExpanded }">
    <div
      :class="{ 'ml-60 lg:ml-0': layoutStore.isAsideMobileExpanded }"
      class="w-screen min-h-screen pt-14 xl:pl-60 transition-position lg:w-auto bg-gray-50 dark:bg-slate-800 dark:text-slate-100"
    >
      <NavBar :class="{ 'ml-60 lg:ml-0': layoutStore.isAsideMobileExpanded }" />
      <AsideMenu />
      <slot />
      <FooterBar />
    </div>
  </div>
</template>

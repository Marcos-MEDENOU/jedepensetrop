<script setup>
import AsideMenuItem from '@/Components/AsideMenuItem.vue'

defineProps({
  isDropdownList: Boolean,
  menu: {
    type: Object,
    default: () => { }
  }
})

const emit = defineEmits(['menu-click'])

const menuClick = (event, item) => {
  emit('menu-click', event, item)
}
</script>

<template>
   <!-- <ul>{{ menu }}</ul> -->
    <ul class="mt-4">
      <AsideMenuItem v-for="(item, index) in menu" :key="index" :item="item" :is-dropdown-list="isDropdownList"
        @menu-click="menuClick"  class=""/>
    </ul>

</template>

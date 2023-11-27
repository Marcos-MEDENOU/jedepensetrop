<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useStyleStore } from '@/Stores/style.js'
import * as mdiIcons from '@mdi/js';
// import { mdiMinus, mdiPlus, mdiViewDashboard, mdiAccountKey } from '@mdi/js'
// import { mdiMinus, mdiPlus } from '@mdi/js'
import { getButtonColor } from '@/colors.js'
import BaseIcon from '@/Components/BaseIcon.vue'
import AsideMenuList from '@/Components/AsideMenuList.vue'

const props = defineProps({
  item: {
    type: Object,
    required: true
  },
  isDropdownList: Boolean,
})

const itemHref = computed(() => (props.item && props.item.link) ? props.item.link : '')

const emit = defineEmits(['menu-click'])

const styleStore = useStyleStore()

const hasColor = computed(() => props.item && props.item.color)

const asideMenuItemActiveStyle = computed(() => hasColor.value ? '' : styleStore.asideMenuItemActiveStyle)

const isDropdownActive = ref(false)

const componentClass = computed(() => (
  [
    //Pour changer le positionnement de la navigation verticale
    props.isDropdownList ? 'py-3 px-6 text-sm' : 'py-3 px-2',
    hasColor.value
      ? getButtonColor(props.item.color, false, true)
      : styleStore.asideMenuItemStyle
  ]
))

const hasDropdown = computed(() => props.item.children)

const menuClick = event => {
  emit('menu-click', event, props.item)

  if (hasDropdown.value) {
    isDropdownActive.value = !isDropdownActive.value
  }
}

const activeInactiveStyle = computed(
  () => splitGetter( props.item.uri, '/', 2 ) === splitGetter( route().current(props.item.route), '.', 0 ) ||
  (props.item.uri=="/dashboard" && splitGetter( route().current(props.item.route), '.', 0 )=="dashboard")
    ? styleStore.asideMenuItemActiveStyle : '')
    
// const activeInactiveStyle = computed(
//   () => props.item.uri == route().current(props.item.route)
//     ? styleStore.asideMenuItemActiveStyle : '')

function splitGetter(string, separator, index){
  return string.split(separator)[index]
}
</script>

<template>
  <li :class="activeInactiveStyle">

    <component :is="itemHref ? Link : 'div'" :href="itemHref" :target="item.target ?? null"
      class="flex cursor-pointer dark:text-slate-300 dark:hover:text-white" :class="componentClass" @click="menuClick">
      <!-- :path="mdiIcons[$`item.icon`]" -->
      <BaseIcon v-if="item.icon" :path="mdiIcons[`${item.icon}`]" class="flex-none mr-3 text-black dark:text-white"
       :size="20" :class="{ 'text-white': activeInactiveStyle }"/>
      <span class="text-gray-600 dark:text-gray-100 grow text-ellipsis line-clamp-1"
      :class="{ 'text-white': activeInactiveStyle }">{{
        item.name }}</span>
      <BaseIcon v-if="hasDropdown" :path="isDropdownActive ? mdiMinus : mdiPlus" class="flex-none"
        w="w-12" />
    </component>
    <AsideMenuList v-if="hasDropdown" :menu="item.children"
      :class="[styleStore.asideMenuDropdownStyle, isDropdownActive ? 'block dark:bg-slate-800/50 ' : 'hidden']"
      is-dropdown-list />
  </li> 
</template>

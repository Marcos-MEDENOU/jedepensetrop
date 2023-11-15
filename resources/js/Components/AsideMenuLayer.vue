<script setup>
import { router } from '@inertiajs/vue3'
import { mdiLogout, mdiClose } from '@mdi/js'
import { computed } from 'vue'
import { useLayoutStore } from '@/Stores/layout.js'
import { useStyleStore } from '@/Stores/style.js'
import AsideMenuList from '@/Components/AsideMenuList.vue'
import AsideMenuItem from '@/Components/AsideMenuItem.vue'
import BaseIcon from '@/Components/BaseIcon.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
defineProps({
  menu: {
    type: Object,
    default: () => {}
  }
})
// console.log(menu);

const emit = defineEmits(['menu-click'])

const layoutStore = useLayoutStore()

const styleStore = useStyleStore()

const logoutItem = computed(() => ({
  name: 'Logout',
  icon: mdiLogout,
  color: 'info',
  link: '#'
}))

const logoutItemClick = () => {
  router.post(route('logout'))
}

const menuClick = (event, item) => {
  emit('menu-click', event, item)
}
</script>

<template>
  <aside
    id="aside"
    class="fixed top-0 z-40 flex h-screen overflow-hidden lg:py-2 lg:pl-2 w-60 transition-position"
  >
    <div
      :class="styleStore.asideStyle"
      class="flex flex-col flex-1 overflow-hidden bg-white lg:rounded-xl dark:bg-slate-900 "
    >
      <div
        :class="styleStore.asideBrandStyle"
        class="flex flex-row items-center justify-between bg-white h-14 dark:bg-slate-900 "
      >
        <div class="flex-1 w-20 text-center lg:text-left lg:pl-6 xl:text-center xl:pl-0 ">
          <div class="flex flex-row items-center justify-start h-10 gap-2 mx-auto mt-2 w-44">
            <ApplicationLogo/>
            <div class="text-xs font-bold text-gray-500 text-bold-800 dark:text-white">DASHBOARD</div>
          </div>
          
          
        </div>
        <button 
          class="hidden p-3 lg:inline-block xl:hidden "
          @click.prevent="layoutStore.isAsideLgActive = false"
        >
          <BaseIcon
            :path="mdiClose"
          />
        </button>
      </div>
      <div
        :class="styleStore.darkMode ? 'aside-scrollbars-[slate] ' : styleStore.asideScrollbarsStyle" 
        class="flex-1 ml-1 overflow-y-auto text-black verflow-x-hidden "
      >
        <AsideMenuList 
          :menu="menu"
          @menu-click="menuClick"
        />
      </div>
    </div>
  </aside>
</template>

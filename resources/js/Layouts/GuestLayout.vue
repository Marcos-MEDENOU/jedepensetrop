<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-left bg-origin-padding bg-clip-content flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 bg-cover bg-no-repeat dark:bg-gray-900 bg-[url('https://ik.imagekit.io/q5edmtudmz/peter-lloyd-680526-unsplash_TYZn4kayG.jpg')]"
    >
        

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg"
        >
        <div class="flex flex-col items-center justify-center my-3 ">
            <Link href="/">
                <ApplicationLogo class="h-16 text-gray-500 fill-current " />
            </Link>
            <!-- <div class="text-xs font-bold text-gray-500 text-bold-800">DASHBOARD</div> -->
        </div>
            <slot />
        </div>
    </div>
</template>

<template>

    <form>
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Rechercher</label>
        <div class="relative">

            <input  v-model="searchTerm" @input="updateSearch" placeholder="Rechercher..." type="search" id="default-search"
                class="block p-4 ps-2 w-64  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            <span type="submit" @click="performSearch"
                class="text-white absolute end-2.5 bottom-2.5 cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><Icon name="search" class="cursor-pointer" /></span>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Icons/Icon.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios';

const searchTerm = ref('');

const performSearch = () => {
    // Effectuer la recherche uniquement si le terme de recherche n'est pas vide
    if (searchTerm.value.trim() !== '') {
        router.get(route('search', { query: searchTerm.value }));
    }
};
</script>

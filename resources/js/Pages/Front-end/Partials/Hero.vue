<template>
  <div class="relative h-screen flex items-center justify-center transition-all">
    <!-- Fond d'écran en arrière-plan -->
    <transition name="fade" mode="out-in">
      <img :src="currentBackground" :key="currentBackground" class="absolute inset-0 w-full h-full object-cover" />
    </transition>

    <!-- Contenu au centre -->
    <div class="absolute text-center text-white">
      <h1 class="text-4xl font-bold mb-4">Titre de la page</h1>
      <p class="text-lg mb-8">Description ou message clé ici.</p>

      <!-- Formulaire de recherche -->
      <form @submit.prevent="submitForm" class="flex items-center">
        <input v-model="searchQuery" type="text" placeholder="Rechercher..." class="px-4 py-2 rounded-l-md focus:outline-none" />
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-md focus:outline-none">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';

const backgrounds = [
  'url("/images/antiloppe.jpg")',
  'url("/images/guepart.jpg")',
  'url("/images/antiloppe.jpg")',
];

const currentBackground = ref(backgrounds[0]);
let currentIndex = 0;

const searchQuery = ref('');

const changeBackground = () => {
  currentIndex = (currentIndex + 1) % backgrounds.length;
  currentBackground.value = backgrounds[currentIndex];
};

const submitForm = () => {
  // Logique de soumission du formulaire ici
  console.log('Recherche soumise:', searchQuery.value);
};

onMounted(() => {
  // Change le fond d'écran toutes les 5 secondes
  setInterval(changeBackground, 5000);
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>

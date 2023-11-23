<script setup>
import { ref, onMounted } from 'vue';

const publicites = ref([
    {
        titre: 'Nouvelle offre spéciale',
        description: 'Économisez jusqu\'à 50% sur notre dernier produit !',
        type: 'video', // Peut être 'image', 'video', ou d'autres types que vous prenez en charge
        url: '/images/free.mp4',
        lien: 'https://www.votre-site.com/offres',
    },
    {
        titre: 'Nouvelle offre spéciale',
        description: 'Économisez jusqu\'à 50% sur notre dernier produit !',
        type: 'image', // Peut être 'image', 'video', ou d'autres types que vous prenez en charge
        url: '/images/blogs.jpg',
        lien: 'https://www.votre-site.com/offres',
    }, {
        titre: 'Nouvelle offre spéciale',
        description: 'Économisez jusqu\'à 50% sur notre dernier produit !',
        type: 'video', // Peut être 'image', 'video', ou d'autres types que vous prenez en charge
        url: '/images/freevideo.mp4',
        lien: 'https://www.votre-site.com/offres',
    }
]);


</script>

<template>
    <div class="py-10 ml-24  sticky top-20 ">

        <h1 class="text-2xl font-bold mb-2">Publicités</h1>
        <div v-for="publicite, index in publicites" :key="index"
            class="mb-2 cursor-pointer bg-white p-3 rounded-md shadow-lg">

            <img v-if="publicite.type === 'image'" :src="publicite.url" alt="Publicité" />

            <video v-else :src="publicite.url" loop  autoplay muted></video>

            <a v-if="publicite.lien" :href="publicite.lien" target="_blank" class=" font-semibold ">Obtenir une offre</a>
        </div>
    </div>
</template>


<style scoped>
/* Ajoutez ici le style CSS pour votre composant Publicite */
</style>

<script setup>
import { ref } from 'vue';
import Header from '../Partials/Header.vue';
import Footer from '../Partials/Footer.vue';


</script>

<template>
    <main>
        <Header class="Accueil"/>
        <slot />
        <Footer></Footer>
    </main>
</template>
<style>
main{
/* background-color: whitesmoke; */
background-color: #EEECE1;
}
</style>

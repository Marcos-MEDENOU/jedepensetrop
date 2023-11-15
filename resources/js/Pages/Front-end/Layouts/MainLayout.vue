<script setup>
import { ref } from 'vue';
import Header from '../Partials/Header.vue';
import Footer from '../Partials/Footer.vue';


</script>

<template>
    <Header></Header>
      <slot />
   <Footer></Footer>
</template>

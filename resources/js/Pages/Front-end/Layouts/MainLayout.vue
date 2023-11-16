<script setup>
import { ref } from 'vue';
import Header from '../Partials/Header.vue';
import Footer from '../Partials/Footer.vue';


</script>

<template>
    <main>
        <Header class=""/>
        <slot />
        <Footer></Footer>
    </main>
</template>
<style>
main{
background-color: whitesmoke;
}
</style>

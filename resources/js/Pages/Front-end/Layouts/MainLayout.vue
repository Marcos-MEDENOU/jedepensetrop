<script setup>
import { ref } from 'vue';
import Header from '../Partials/Header.vue';
import Footer from '../Partials/Footer.vue';

const props = defineProps({
    user:{
        type: Object,
        required:true
    }
})
</script>

<template>
    <main>
        <Header class="Accueil" :user="props.user"/>
        <slot />
        <Footer></Footer>
    </main>
</template>
<style>
main{
background-color: whitesmoke;
/* background-color: #EEECE1; */
}
</style>

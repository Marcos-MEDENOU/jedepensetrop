<script setup>
import { ref, onMounted } from 'vue';
import Header from '../Partials/Header.vue';
import Footer from '../Partials/Footer.vue';

const props = defineProps({
    user:{
        type: Object,
        required:true
    },
    categories:{
        type: Object,
        required:true
    },
})

</script>

<template>
    <main>
        <Header class="Accueil" :user="props.user" :categories ="props.categories"/>
        <slot />
        <Footer :user="props.user" :categories ="props.categories" />
    </main>
</template>
<style>
main{
background-color: whitesmoke;
/* background-color: #EEECE1; */
}
</style>

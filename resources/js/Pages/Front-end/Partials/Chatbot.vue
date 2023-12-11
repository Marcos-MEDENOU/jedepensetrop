<script setup>
import Icon from '@/Components/Icons/Icon.vue';
import { ref } from 'vue';

// État pour contrôler la visibilité du chat
const isChatVisible = ref(false);

// Fonction pour basculer la visibilité du chat
const toggleChat = () => {
    isChatVisible.value = !isChatVisible.value;
};

</script>

<template>
    <div class="">
        <transition name="fade-scale" mode="out-in">
        <div v-show="isChatVisible" class="bg-white shadow-xl rounded-t-xl rounded-bl-xl p-5 w-68 md:w-96 text-sm md:text-base md:h-[600px] h-[32em] relative ">
            <div class="bg-indigo-600 text-center mb-5 text-white p-3 rounded-lg">
                <h2 class="font-bold text-xl">ChatBot</h2>
            </div>

            <ul class="p-2 flex flex-col gap-3">
                <li class="flex gap-3 w-56">
                    <div class=" w-10 h-10 justify-center items-center flex rounded-xl">

                        <Icon name="bot" />
                    </div>
                    <p class="bg-indigo-100  rounded-r-lg rounded-bl-lg p-2"><span class="flex gap-2 ">Coucou
                            <Icon name="hello" />
                        </span>
                        Comment puis-je vous aider ?
                    </p>
                </li>

                <!-- Messages de l'utilisateur -->
                <li class="flex gap-3 items-end justify-end ">
                    <p class="bg-gray-300 p-2 rounded-l-lg rounded-tr-lg">
                        J'aimerais prendre un coaching
                    </p>
                </li>
                <li class="flex gap-3 w-56">
                    <div class=" w-10 h-10 justify-center items-center flex rounded-xl">

                        <Icon name="bot" />
                    </div>
                    <p class="bg-indigo-100  rounded-r-lg rounded-bl-lg p-2">
                        Veuillez patienter un instant! Notre assistant vous contact.
                    </p>
                </li>
            </ul>


            <div class=" absolute bottom-5 left-5 right-5 flex gap-3 items-center">
                <textarea placeholder="Ecrire un message..." required id="message" rows="4"
                    class=" h-20 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                <span id="send-btn " class=" cursor-pointer">

                    <Icon name="send" />
                </span>
            </div>
        </div>
        </transition>
        <div class="flex justify-end">
            <div @click="toggleChat"
                class="bg-indigo-600 cursor-pointer hover:bg-indigo-700 w-12 h-12 flex justify-center items-center rounded-lg mt-10 text-right">
                <Icon name="chat" />
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Styles spécifiques au composant ici */

/* Animation de fondu */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>

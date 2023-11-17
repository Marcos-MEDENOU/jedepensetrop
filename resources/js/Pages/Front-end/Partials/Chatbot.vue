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

        <div v-show="isChatVisible" class="bg-white shadow-xl rounded-xl p-5 w-96 h-[600px] relative">
            <div class="bg-indigo-600 text-center mb-5 text-white p-3 rounded-lg">
                <h2 class="font-bold text-xl">ChatBot</h2>
            </div>

            <ul class="p-2">
                <li class="flex gap-3">
                    <div class="bg-indigo-600 w-10 h-10 justify-center items-center flex rounded-xl">

                        <Icon name="bot" />
                    </div>
                    <p><span class="flex gap-2">Coucou
                            <Icon name="hello" />
                        </span>
                        Comment pouis-je vous aider ?
                    </p>
                </li>

            </ul>

            <div class=" absolute bottom-5 left-5 right-5 flex gap-3 items-center">
                <textarea placeholder="Ecrire un message..." required id="message" rows="4"
                    class=" h-20 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                <span id="send-btn" class="">

                    <Icon name="send" />
                </span>
            </div>
        </div>

        <div class="flex justify-end">
            <div @click="toggleChat"
                class="bg-indigo-600 hover:bg-indigo-700 w-12 h-12 flex justify-center items-center rounded-lg mt-10 text-right">
                <Icon name="chat" />
            </div>
        </div>
    </div>
</template>

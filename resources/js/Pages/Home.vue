<script setup>
import axios from 'axios';
import { computed, ref, onMounted } from 'vue'
import MainLayout from './Front-end/Layouts/MainLayout.vue';
import Hero from './Front-end/Partials/Hero.vue';

const props = defineProps({

})



</script>

<template>
    <MainLayout>

        <Head title="Accueil" />


<Hero/>






        <section class="lg:mx-24 py-32">


            <div class="grid grid-cols-2 gap-6 ml-10 lg:mx-auto sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div class="relative w-full mx-auto">
                    <div
                        class="relative inline-block w-full transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                        <div class="p-4 bg-white rounded-lg shadow">
                            <div class="relative flex justify-center overflow-hidden rounded-lg h-52">
                                <div class="w-full transition-transform duration-500 ease-in-out transform hover:scale-110">

                                    <div class="Calque_1">
                                        <svg width="auto" height="13rem" id="Calque_1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 247.12 238.44">
                                            <defs></defs>
                                            <path class="cls-1"
                                                d="m162.83,51.07c-4.92-2.67-7.98,1.4-9.07,3.28-1.87,3.26-3.73,6.54-5.59,9.81l-16.4,28.87c-11.49,20.22-22.99,40.42-34.44,60.66-.66,1.17-1.08,2.48-1.52,3.79l-.48,1.36c.35,2.49,1.68,4.63,3.57,5.71,1.12.64,2.92,1.19,5.12.06,1.6-.81,3.42-2.85,5.11-5.73,5.94-10.13,11.72-20.34,17.5-30.56l16.11-28.34c7.45-13.08,14.9-26.15,22.3-39.24,1.13-2,1.47-4.08.96-5.87-.45-1.59-1.55-2.91-3.17-3.8Z" />
                                            <path class="cls-1"
                                                d="m75.82,71.52h-.06c-1.94.02-4.07,1.17-6.17,3.32-9.31,9.58-18.6,19.18-27.86,28.83-3.54,3.69-3.64,7.39-.28,10.96,8.8,9.37,19.07,20.22,29.65,30.43,1.12,1.09,4.07,1.89,5.74,1.59,3.33-.63,4.55-2.9,4.97-4.19.84-2.6.04-5.62-2.09-7.88-4.76-5.06-9.59-10.07-14.57-15.25l-9.72-10.13,8.86-9.12c5.17-5.31,10.21-10.47,15.16-15.71,3.42-3.61,3.65-7.89.6-10.88-1.34-1.31-2.77-1.98-4.23-1.98Z" />
                                            <path class="cls-1"
                                                d="m196.33,73.27c-1.44-1.45-3.01-1.81-4.22-1.81-.48,0-.91.06-1.24.12-2.19.45-4.01,2.04-4.89,4.24-1.28,3.22-.56,5.82,2.48,8.97l23.63,24.45-9.43,9.8c-5.24,5.43-10.28,10.66-15.23,15.97-2.79,2.99-2.73,7.47.15,10.2,2.77,2.6,6.4,2.56,9.04-.09,9.96-10.09,19.86-20.28,29.58-30.63,3.05-3.25,3.17-7,.32-10.01-9.95-10.52-19.97-20.96-30.2-31.21Z" />
                                        </svg>
                                    </div>

                                    <div class="absolute inset-0 bg-black opacity-5">

                                    </div>
                                </div>



                                <span
                                    class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#FF7619] rounded-lg select-none">
                                    Activités IT
                                </span>
                            </div>


                            <div class="flex flex-col items-center justify-center gap-2 mx-auto mt-8">

                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Codage
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Developpement IT
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        BPO augmenté
                                    </span>
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </section>

    </MainLayout>
</template>


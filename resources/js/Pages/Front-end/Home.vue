<script setup>
import { computed, ref, onMounted } from 'vue'
import MainLayout from '../Front-end/Layouts/MainLayout.vue';
import CardBoxWidget from '@/Components/CardBoxWidget.vue'

const props = defineProps({

})

</script>

<template>
    <MainLayout>

        <Head title="Home" />
        <div class="hidden h-14 lg:flex"></div>
        <section
            class="p-0 m-0 relative bg-center h-[35vh] md:text-sm backdrop: sm:h-[40vh]   lg:h-[85vh] bg-no-repeat bg-[url('/images/giraffe.jpeg')] bg-gray-200 bg-cover bg-blend-multiply">
            <div class="max-w-screen-xl px-4 py-24 mx-auto text-center lg:py-56">
                <h1
                    class="absolute bottom-0 left-0 mb-4 ml-4 text-xl font-extrabold leading-none tracking-tight text-white sm:text-xl md:text-5xl lg:text-6xl">
                    Vipp, The African BPO & CX leader
                </h1>
            </div>
        </section>

        <section class="bg-white dark:bg-gray-900">
            <h2
                class=" mt-12 lg:text-6xl text-[#FF7619] font-extrabold leading-tight tracking-tight text-center lg:mb-8 dark:text-white md:text-4xl">
                Facteurs de différenciation</h2>

            <div class="grid px-4 py-8 mx-auto max-w-screen-2xl xl:gap-0 lg:py-16 lg:grid-cols-12">

                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-4 text-3xl font-extrabold leading-none text-left text-gray-700 lg:text-5xl md:text-5xl dark:text-white">
                        L’agilité est notre talent : être présent, novateur, réactif,
                        proactif, pertinent</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">

                        Vous accompagner dans votre stratégie de développement Inventer
                        des solutions pour coller à l’évolution du comportement de vos
                        consommateurs Challenger en permanence nos solutions
                        technologiques Combiner les prestations pour optimiser vos
                        résultats Suivre, analyser, partager, réagir
                    </p>
                    <a href="#"
                        class="bg-[#FF7619] inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg hover:bg-[#FF7619] focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        En savoir plus
                      
                    </a>

                </div>
                <!-- <div class="hidden lg:mt-0 lg:col-span-5 lg:flex ">
                    <img src="/images/lion.jpg" alt="mockup">
                </div> -->
                <div
                    class="hidden w-full md:block justify-center items-center lg:mx-10 lg:w-[28rem] rounded-xl h-72 lg:h-[27rem] lg:border-solid lg:border-[#FF7619] lg:border-[0.3rem] div_article_img">

                    <img class="object-cover w-full lg:mx-10 lg:w-[30rem] rounded-xl h-72 lg:h-96" src="/images/lion.jpg"
                        alt="animal" />
                </div>
            </div>
        </section>


        <section>
            <div class="flex flex-col ">

                <div class="items-center justify-center gap-8 px-10 mt-10 lg:gap-4 lg:flex ">

                    <div
                        class="flex items-center justify-center p-12 text-center bg-white shadow-lg lg:flex-col rounded-xl">
                        <CardBoxWidget color="text-emerald-500" :number="1500" />
                        <p>dossiers par jour</p>
                    </div>

                    <div class="flex items-center justify-center p-10 bg-white shadow-lg rounded-xl lg:flex-col">
                        <CardBoxWidget color="text-emerald-500" :number="1200" />
                        <p>contacts digitaux par jour</p>

                    </div>
                    <div class="flex items-center justify-center p-10 bg-white shadow-lg just rounded-xl lg:flex-col">
                        <CardBoxWidget color="text-emerald-500" :number="20000" />
                        <p>prises de rendez-vous par jour</p>
                    </div>
                    <div class="flex items-center justify-center p-10 bg-white shadow-lg rounded-xl lg:flex-col">
                        <CardBoxWidget color="text-emerald-500" :number="80000" />
                        <p>contacts ventes par jour</p>

                    </div>
                    <div class="flex items-center justify-center p-10 bg-white shadow-lg rounded-xl lg:flex-col">
                        <CardBoxWidget color="text-emerald-500" :number="19000" />
                        <p>clients accompagnés par jour</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="lg:mx-24">
            <h2 class="lg:mt-10 mt-8 mb-8 text-[#E69803] text-2xl font-bold text-center md:text-4xl">
                Nos prestations
            </h2>

            <h3
                class="block mt-4 mb-8 text-xl font-semibold text-center text-gray-800 hover:underline dark:text-white md:text-2xl">
                Français - Anglais - Langues locales africaines
            </h3>

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
                <div class="relative w-full mx-auto">
                    <div
                        class="relative inline-block w-full transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                        <div class="p-4 bg-white rounded-lg shadow">
                            <div class="relative flex justify-center overflow-hidden rounded-lg h-52">
                                <div class="w-full transition-transform duration-500 ease-in-out transform hover:scale-110">

                                    <div class="Calque_1">
                                        <svg id="Calque_1" width="auto" height="10rem" style="margin-top: 2rem;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 247.12 238.44">
                                            <defs></defs>
                                            <path class="cls-1"
                                                d="m229.71,74.75C214.51,29.98,172.79,0,125.44,0S36.9,29.65,21.47,73.94h-1.91c-10.79,0-19.56,8.78-19.56,19.56v33.56c0,10.79,8.78,19.56,19.56,19.56h6.01c10.79,0,19.56-8.78,19.56-19.56v-33.56c0-7.92-4.86-15.05-12.06-18.05C47.5,37.07,84.35,11.44,125.44,11.44s77.67,25.45,92.21,63.59c-8.93,1.81-15.67,9.72-15.67,19.17v33.56c0,9.23,6.29,16.98,15.02,19.03-12.04,29.9-38.51,52.47-69.89,59.54-3.54-8.82-12.02-14.62-21.67-14.62-12.88,0-23.36,10.48-23.36,23.36s10.48,23.36,23.36,23.36c12.02,0,21.91-8.98,23.21-20.74,36.97-7.97,67.56-34.77,80.4-70.44,10.09-.77,18.06-9.22,18.06-19.51v-33.56c0-10.06-7.63-18.37-17.41-19.44Zm5.97,19.44v33.56c0,4.48-3.65,8.13-8.13,8.13h-6.01c-4.48,0-8.13-3.65-8.13-8.13v-33.56c0-4.48,3.65-8.13,8.13-8.13h6.01c4.48,0,8.13,3.65,8.13,8.13Zm-201.98-.7v33.56c0,4.48-3.65,8.13-8.13,8.13h-6.01c-4.48,0-8.13-3.65-8.13-8.13v-33.56c0-4.48,3.65-8.13,8.13-8.13h6.01c4.48,0,8.13,3.65,8.13,8.13Zm103.68,121.58c0,6.58-5.35,11.93-11.93,11.93s-11.93-5.35-11.93-11.93,5.35-11.93,11.93-11.93,11.93,5.35,11.93,11.93Z" />
                                            <path class="cls-1"
                                                d="m110.56,176.92h.01c3.08,3.33,6.92,7.46,12.55,7.46,5.14,0,8.34-4.11,10.92-7.42.42-.55,1.21-1.56,1.75-2.16,31.33-5.84,53.99-33.12,53.99-65.1,0-36.52-29.71-66.23-66.23-66.23s-66.23,29.71-66.23,66.23c0,30.58,20.66,56.99,50.28,64.3.67.46,2.38,2.3,2.96,2.92Zm-39.41-67.22c0-28.9,23.51-52.4,52.4-52.4s52.4,23.51,52.4,52.4c0,25.7-18.36,47.44-43.67,51.68-4.19.7-6.83,4.1-9.17,7.09-.19.25-.43.55-.68.87-.64-.63-1.29-1.34-1.74-1.82-2.57-2.77-5.48-5.9-9.57-6.89-23.54-5.72-39.98-26.66-39.98-50.93Z" />
                                            <path class="cls-1"
                                                d="m107.32,92.89h32.48c3.15,0,5.72-2.56,5.72-5.72s-2.57-5.72-5.72-5.72h-32.48c-3.15,0-5.72,2.56-5.72,5.72s2.56,5.72,5.72,5.72Z" />
                                            <path class="cls-1"
                                                d="m148.06,114.47c3.14,0,5.71-2.56,5.72-5.7,0-1.53-.58-2.97-1.66-4.05s-2.51-1.68-4.04-1.69l-49.02-.19c-3.14,0-5.71,2.56-5.72,5.7,0,1.53.58,2.97,1.66,4.05,1.08,1.08,2.51,1.68,4.04,1.69l49,.19h.01Z" />
                                            <path class="cls-1"
                                                d="m144.4,129.22c0-3.15-2.57-5.72-5.72-5.72h-30.25c-3.15,0-5.72,2.57-5.72,5.72s2.56,5.72,5.72,5.72h30.25c3.15,0,5.72-2.57,5.72-5.72Z" />
                                        </svg>
                                    </div>

                                    <div class="absolute inset-0 bg-black opacity-5">

                                    </div>
                                </div>



                                <span
                                    class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#FF7619] rounded-lg select-none">
                                    Activités commerciales
                                </span>
                            </div>


                            <div class="flex flex-col items-center justify-center gap-2 mx-auto mt-8">

                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Acquision
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Fidélisation
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Rétention
                                    </span>
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="relative w-full mx-auto">
                    <div
                        class="relative inline-block w-full transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                        <div class="p-4 bg-white rounded-lg shadow">
                            <div class="relative flex justify-center overflow-hidden rounded-lg h-52">
                                <div class="w-full transition-transform duration-500 ease-in-out transform hover:scale-110">

                                    <div class="Calque_1">
                                        <svg id="Calque_1" width="auto" height="10rem" style="margin-top: 2rem;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 247.12 238.44">
                                            <defs></defs>
                                            <g id="BO">
                                                <path class="cls-1"
                                                    d="m116.88,163.26c-12.35,0-24.26,0-36.16,0-6.39,0-12.78.04-19.17,0-12.52-.09-20.46-7.98-20.53-20.53-.08-13.36-.02-26.72-.02-40.08,0-15.2-.04-30.4.02-45.6.04-10.17,4.98-17.11,14.19-19.77,2.18-.63,4.58-.65,6.88-.66,18.01-.05,36.02-.08,54.02.03,2.42.02,3.6-.78,4.56-2.93,1.81-4.06,3.88-8,5.95-11.93,3.66-6.97,9.5-10.53,17.35-10.56,13.84-.06,27.69-.06,41.53,0,11.65.05,19.67,8.11,19.68,19.79.03,37.27.02,74.55,0,111.82,0,12.41-7.84,20.36-20.26,20.41-17.14.08-34.27.02-51.41.02-1.16,0-2.31,0-3.69,0-.09.87-.24,1.6-.24,2.33-.02,7.55.02,15.1-.04,22.66-.01,1.51.31,2.38,1.86,3.06,3.73,1.66,6.72,4.39,8.36,8.12.99,2.25,2.36,2.51,4.44,2.51,26.14-.05,52.28-.04,78.42-.02,1.25,0,2.54.01,3.75.29,3.14.7,5.19,3.54,4.94,6.6-.27,3.27-2.76,5.67-6.14,5.76-3.29.08-6.58.03-9.87.03-23.82,0-47.63.02-71.45-.03-1.91,0-2.91.43-3.9,2.36-3.4,6.64-9.06,10.29-16.56,10.36-7.61.08-13.39-3.44-16.94-10.2-.99-1.89-2.02-2.56-4.17-2.55-26.53.08-53.06.07-79.58.04-5.31,0-8.4-4.5-6.24-8.98,1.16-2.42,3.24-3.51,5.84-3.65,1.64-.09,3.29-.03,4.94-.03,24.98,0,49.96-.03,74.94.05,2.22,0,3.45-.56,4.42-2.66,1.77-3.81,4.9-6.39,8.66-8.25.65-.32,1.55-1.08,1.56-1.65.1-8.59.07-17.19.07-26.14Zm-63.28-88.59c0,1.11,0,1.88,0,2.65,0,21.68,0,43.37,0,65.05,0,5.79,2.48,8.22,8.36,8.22,40.75,0,81.51,0,122.26,0,6.12,0,8.27-2.1,8.27-8.11,0-21.59,0-43.17,0-64.76v-3.06H53.6Zm.15-13.11h138.75c0-10.35.02-20.5-.01-30.65-.02-4.71-2.24-6.92-6.98-6.93-13.65-.03-27.31.04-40.96-.05-3.45-.02-5.66,1.44-7.12,4.44-2.54,5.21-5.28,10.33-7.69,15.6-1.71,3.73-4.27,5.25-8.41,5.22-18.78-.14-37.57.17-56.35-.15-10.21-.17-12.07,2.84-11.23,12.52Zm69.34,152.98c3.47.04,6.35-2.73,6.41-6.14.05-3.29-2.92-6.33-6.25-6.39-3.39-.06-6.28,2.78-6.33,6.22-.05,3.51,2.65,6.26,6.17,6.3Z" />
                                                <path class="cls-1"
                                                    d="m161.04,87.28c4.16,0,8.32-.04,12.48.01,3.69.05,6.37,2.58,6.51,6.02.13,3.18-2.38,6.39-5.8,6.47-8.79.21-17.6.21-26.4,0-3.41-.08-5.94-3.31-5.8-6.48.15-3.44,2.83-5.97,6.52-6.02,4.16-.05,8.32-.01,12.48-.01Z" />
                                                <path class="cls-1"
                                                    d="m161.17,125.09c-4.16,0-8.32.04-12.48-.01-3.75-.04-6.41-2.45-6.64-5.9-.22-3.26,2.39-6.56,5.95-6.64,8.7-.21,17.41-.21,26.11,0,3.56.09,6.14,3.4,5.91,6.67-.25,3.45-2.9,5.83-6.66,5.87-4.06.05-8.13.01-12.19.01Z" />
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="absolute inset-0 bg-black opacity-5">

                                    </div>
                                </div>



                                <span
                                    class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#FF7619] rounded-lg select-none">
                                    Soutien d'activité
                                </span>
                            </div>


                            <div class="flex flex-col items-center justify-center gap-2 mx-auto mt-8">

                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Back office
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Digitalisation
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 text-center xl:mt-0">
                                        Traitement <br>documentaire
                                    </span>
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="relative w-full mx-auto">
                    <div
                        class="relative inline-block w-full transition-transform duration-300 ease-in-out transform hover:-translate-y-2">
                        <div class="p-4 bg-white rounded-lg shadow">
                            <div class="relative flex justify-center overflow-hidden rounded-lg h-52">
                                <div class="w-full transition-transform duration-500 ease-in-out transform hover:scale-110">

                                    <div class="Calque_1">
                                        <svg id="Calque_1" width="auto" height="15rem" style="margin-top: 2rem;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 247.12 238.44">
                                            <defs></defs>
                                            <path class="cls-1"
                                                d="m192.18,80.04c-11.46-11.73-29.84-16.8-47.93-14.92-6.28-7.83-14.97-14.43-25.49-19.01-33.85-14.75-77.03-5.37-96.25,20.93-8.78,12.02-11.53,26.1-7.72,39.63,4.23,15.04,16.24,28.01,33.07,35.84l5.94,23.28,22.74-15.8c14.09,1.18,27.9-.93,39.95-5.73,12.35,6.47,28.11,8.54,43.58,5.13l19.72,9.96,1.97-18.98c11.74-7.74,19.34-18.9,20.84-30.68,1.4-10.82-2.3-21.35-10.41-29.65Zm-83.62,59.02c-10.09,3.21-21.27,4.54-32.7,3.4l-1.45-.15-15.88,11.03-4.12-16.1-1.7-.74c-15.62-6.81-26.75-18.39-30.52-31.78-3.19-11.35-.86-23.21,6.58-33.38,11.62-15.91,33.17-24.85,55.39-24.85,10.66,0,21.49,2.06,31.44,6.4,7.91,3.44,14.65,8.12,19.88,13.62,1.96,2.07,3.65,4.28,5.17,6.56,2.42,3.65,4.32,7.52,5.47,11.58,3.2,11.36.86,23.21-6.57,33.39-5.51,7.54-13.39,13.49-22.55,17.74-2.7,1.25-5.51,2.34-8.43,3.27Zm86.36-30.31c-1.3,10.14-8.19,19.73-18.9,26.29l-1.58.98-1.21,11.57-11.85-5.98-.33-.16-1.42.34c-11.96,2.89-24.13,2.12-34.31-1.75,8.22-4.57,15.26-10.54,20.49-17.71,8.78-12.03,11.52-26.11,7.71-39.64-1.04-3.68-2.57-7.23-4.5-10.62,14.8-.62,28.81,4.17,37.53,13.1,6.49,6.64,9.46,15.02,8.36,23.57Z" />
                                            <path class="cls-1"
                                                d="m107.45,88.62c-1.67-.1-3.01-.76-3.14-2.49-.07-1.02.09-2.31.69-3.07,1.6-2.01,1.37-3.51-.62-5.08-1.28-1.01-2.36-2.27-3.54-3.41-2.53-2.46-2.64-2.6-5.44-.58-1.73,1.24-3.28.82-4.5-.17-.81-.67-1.03-2.13-1.28-3.29-.33-1.55-1.12-2.23-2.78-2.16-1.9.08-3.8.02-5.71.02q-3.9,0-4.82,3.69c-.61,2.47-2.91,3.36-5.16,1.99-.93-.56-1.85-1.13-2.91-1.77-.67.48-1.27.83-1.76,1.29-1.64,1.56-3.17,3.24-4.88,4.71-1.59,1.37-1.78,2.56-.55,4.34,2.33,3.33,1.45,5.24-2.66,6.03-1.87.36-2.77,1.14-2.64,3.09.14,2.06.18,4.16,0,6.21-.21,2.33.75,3.47,3.11,3.62,1.67.1,3.01.76,3.14,2.49.07,1.02-.08,2.31-.69,3.07-1.6,2.01-1.37,3.51.62,5.08,1.29,1.01,2.36,2.27,3.54,3.41,2.53,2.46,2.64,2.59,5.44.59,1.73-1.24,3.28-.82,4.5.17.81.67,1.03,2.13,1.28,3.29.33,1.55,1.12,2.22,2.78,2.16,2.3-.08,4.6-.12,6.9,0,2.05.12,3.04-.59,3.37-2.61.2-1.23.1-2.74,1.93-3.36,1.41-.48,2.44-.51,3.71.35,2.88,1.93,2.94,1.87,5.46-.58,1.29-1.25,2.49-2.59,3.87-3.74,1.61-1.35,1.79-2.56.55-4.34-2.33-3.33-1.45-5.24,2.66-6.03,1.87-.36,2.77-1.14,2.64-3.09-.14-2.06-.18-4.16,0-6.21.21-2.33-.75-3.47-3.11-3.62Zm-38.69-12.21c-.13-.01-.06-.03,0,0h0Zm38.36,21.81c-2.45.6-4.74,1.07-5.93,4.13-1.11,2.88-.67,4.78,1.45,7-1.82,1.38-3.54,2.7-5.27,4.01.17.16.33.33.5.49-.15-.04-.35-.03-.44-.12-3.09-3.31-6.17-1.2-9.14.15-.65.29-1.13,1.48-1.2,2.3-.19,2.09-1.29,2.74-3.28,2.44-.39-.06-.8-.07-1.18,0-2.18.42-3.24-.48-3.36-2.58-.08-1.5-.88-2.39-2.42-2.69-.46-.09-.94-.26-1.31-.52-2.14-1.54-4.08-1.18-5.94.48-.28.25-.66.4-1.05.63-1.53-1.51-3.02-2.97-4.66-4.59,1.39-2.05,2.7-3.89,1.29-6.93-1.3-2.81-3.1-3.76-5.92-4.07v-6.42c2.62-.45,4.66-1.22,5.93-4.18,1.28-2.96.3-4.76-1.22-6.74,1.6-1.48,3.11-2.88,4.9-4.54,3.03,3.18,6.11,1.29,9.08-.1.66-.31,1.19-1.44,1.28-2.25.24-2.13,1.28-2.95,3.43-2.55.23.04.48.04.71,0,2.43-.45,3.59.47,3.87,2.9.09.8,1.25,1.5,1.95,2.22.15.15.45.15.65.27,2.77,1.72,5.42,1.99,7.69-.8,1.71,1.66,3.25,3.15,4.91,4.76-1.62,2.03-2.48,3.95-1.21,6.93,1.25,2.93,3.27,3.58,5.92,4.04v6.3Z" />
                                            <path class="cls-1"
                                                d="m83.21,82.32c-7.21-.04-13.13,5.73-13.13,12.79,0,7.06,5.94,12.83,13.15,12.77,7.15-.06,12.95-5.71,13.01-12.67.06-7.07-5.78-12.85-13.03-12.89Zm-.13,22.4c-5.33-.05-9.71-4.44-9.67-9.7.04-5.24,4.53-9.59,9.83-9.54,5.33.05,9.71,4.44,9.67,9.7-.04,5.24-4.53,9.59-9.83,9.54Z" />
                                        </svg>
                                    </div>

                                    <div class="absolute inset-0 bg-black opacity-5">

                                    </div>
                                </div>



                                <span
                                    class="absolute top-0 left-0 z-10 inline-flex px-3 py-2 mt-3 ml-3 text-sm font-medium text-white bg-[#FF7619] rounded-lg select-none">
                                    Relations clients
                                </span>
                            </div>


                            <div class="flex flex-col items-center justify-center gap-2 mx-auto mt-8">

                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Service client
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        .Modération
                                    </span>
                                </p>
                                <p class="inline-flex flex-col text-gray-800 xl:flex-row xl:items-center">

                                    <span class="mt-2 xl:mt-0">
                                        Réseaux sociaux
                                    </span>
                                </p>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

            <!-- <section class="bande_secteur absent">
            <h3 class="text-4xl font-bold text-[#FF7619] text-center mt-3">
                Secteurs d’activités
            </h3>
            <div class="scroll-container" ref="container">
                <div class="scroll-content secteur" ref="content">
                    <div v-for="(secteurs, index) in secteurs" :key="index" class="mt-10 text-3xl font-bold scroll-item">
                        {{ secteurs }}
                    </div>
                </div>
            </div> -->
        </section>


        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
                <h2
                    class="mb-8 text-4xl text-[#FF7619] font-extrabold leading-tight tracking-tight text-center lg:mb-16 dark:text-white md:text-4xl">
                    Secteurs d'activités</h2>
                <div
                    class="grid grid-cols-2 gap-8 text-3xl text-gray-500 sm:gap-12 md:grid-cols-3 lg:grid-cols-6 dark:text-gray-400">
                    <a href="#" class="flex items-center justify-center text-center">
                        𝙱𝚊𝚗𝚚𝚞𝚎 <br> 𝙰𝚜𝚜𝚞𝚛𝚊𝚗𝚌𝚎
                    </a>
                    <a href="#" class="flex items-center justify-center">
                        𝚃𝚎𝚕𝚎𝚌𝚘𝚖
                    </a>
                    <a href="#" class="flex items-center justify-center">
                        𝙼é𝚍𝚒𝚊
                    </a>

                    <a href="#" class="flex items-center justify-center">
                        𝙴𝚗𝚎𝚛𝚐𝚒𝚎
                    </a>
                    <a href="#" class="flex items-center justify-center">
                        𝙴𝚌𝚘𝚖𝚖𝚎𝚛𝚌𝚎
                    </a>
                    <a href="#" class="flex items-center justify-center">
                        𝙸𝚖𝚖𝚘𝚋𝚒𝚕𝚒𝚎𝚛
                    </a>
                </div>
            </div>
        </section>

        <section class="">
            <h1 class="py-5 text-2xl font-semibold text-center lg:text-4xl dark:text-white">
                Implantations
            </h1>

            <div class="flex mt-8 lg:flex lg:items-center implantation_titre">
                <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6">
                    <div @click="slider('/images/Fond_carte_France.png', 'showFr')"
                        class="mt-6 text-xl lg:text-2xl font-bold text-[#F6CB0C] hover:underline">
                        Vipp en France
                    </div>
                    <div v-if="showFr" id="france" class="mt-2 text-xl ville fr france rounded-xl">
                        <p class="">
                            <span class="font-bold">Relation client</span> <br />
                            Vipp & Philippe - Entreprise Adaptée Anteuil (Doubs)
                        </p>
                        <p class="">
                            <span class="font-bold">Solutions technologiques</span> <br />
                            Vipp Data, Paris
                        </p>
                        <p class="">
                            <span class="font-bold">Conseil & formation</span><br />
                            Vipp Glitter, Paris
                        </p>
                        <a href="">Voir plus</a>
                    </div>
                    <div @click="slider('/images/Fond_carte_Benin.png', 'showBj')"
                        class="mt-6 text-xl lg:text-2xl Benin font-bold text-[#F6CB0C] hover:underline">
                        Vipp au Bénin
                    </div>
                    <div v-if="showBj" id="benin" class="mt-2 text-xl ville bj rounded-xl">
                        <p class="">
                            <span class="font-bold">Relation client & BPO</span> <br />
                            Cotonou, 1 500 positions
                        </p>
                        <p class="">
                            <span class="font-bold">Ecole de codage</span><br />HighFive
                            University, Cotonou
                        </p>
                        <a href="">Voir plus</a>
                    </div>

                    <div @click="slider('/images/Fond_carte_Cameroun.png', 'showCmr')"
                        class="mt-6 text-xl lg:text-2xl font-bold text-[#F6CB0C] hover:underline">
                        Vipp au Cameroun
                    </div>

                    <div v-if="showCmr" id="Cameroun" class="mt-2 text-xl ville cmr cameroun rounded-xl">
                        <p class="">
                            <span class="font-bold">Relation client & BPO</span>
                            <br />Yaoundé, 1 000 positions
                        </p>
                        <a href="">Voir plus</a>
                    </div>

                    <div @click="slider('/images/Fond_carte_Ethiopie.png', 'showEthp')"
                        class="mt-6 text-xl lg:text-2xl font-bold text-[#F6CB0C] hover:underline">
                        Vipp en Ethiopie
                    </div>
                    <div v-if="showEthp" id="Ethiopie" class="mt-2 text-xl ville eth ethiophie rounded-xl">
                        <p class="">
                            <span class="font-bold">Relation client & BPO - anglophone</span>
                            <br />
                            Addis Abeba, 300 positions
                        </p>
                        <a href="">Voir plus</a>
                    </div>

                    <div @click="slider('/images/Fond_carte_Rwanda.png', 'showRwd')"
                        class="mt-6 rwd text-xl lg:text-2xl font-bold text-[#F6CB0C] hover:underline">
                        Vipp au Rwanda
                    </div>
                    <div v-if="showRwd" id="Ethiopie" class="mt-2 text-sm text-xl ville rwanda rounded-xl">
                        <p class="">
                            <span class="font-bold">Relation client & BPO</span> <br />
                            Kigali, 300 positions
                        </p>
                        <a href="">Voir plus</a>
                    </div>

                    <div @click="slider('/images/Fond_carte_Togo.png', 'showTg')"
                        class="tg mt-6 text-xl lg:text-2xl font-bold text-[#F6CB0C] hover:underline">
                        Vipp au Togo
                    </div>
                    <div v-if="showTg" id="Togo" class="mt-2 text-sm text-xl ville togo rounded-xl">
                        <p class="">
                            <span class="font-bold">Relation client & BPO</span> <br />
                            Lomé, 1 000 positions
                        </p>
                        <p class="">
                            <span class="font-bold">Ecole de codage</span> <br />
                            HighFive University, Cotonou
                        </p>
                        <a href="">Voir plus</a>
                    </div>
                </div>
                <div class="implantation_item">
                    <img class="object-cover w-full lg:mx-5 lg:w-1/2 carte" src="/images/Fond_carte_vierge.png" alt="carte"
                        v-if="ShowCartePays" />
                </div>
            </div>
        </section>
        <section class="ville_bande absent">
            <div class="scroll-container bandeau_ville">
                <div class="w-full scroll-content bandeau_ville_item">
                    <div v-for="(pays, index) in pays" :key="index" class="mx-3 text-4xl font-bold scroll-item">
                        {{ pays }}
                    </div>
                </div>
            </div>
        </section>



        <section class="bg-white dark:bg-gray-900">
            <h2
                class=" mt-6 lg:text-6xl text-[#FF7619] font-extrabold leading-tight tracking-tight text-center lg:mb-8 dark:text-white md:text-4xl">
                Un groupe engagé dans la RSE depuis sa création</h2>

            <div class="grid px-4 py-8 mx-auto max-w-screen-2xl xl:gap-0 lg:py-16 lg:grid-cols-12">

                <div class="mr-auto place-self-center lg:col-span-7">
                    <!-- <h1
                        class="max-w-2xl mb-4 text-3xl font-extrabold leading-none text-left text-gray-700 lg:text-5xl md:text-5xl dark:text-white">
                       sss</h1> -->
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">

                        Acteur majeur des centres de contact en Afrique subsaharienne, Vipp inscrit son developpement des sa création
                        en 2010 dans une démarche de Responsabilité Socialeet Environnementale. Depuis 2021, Vipp apporte son soutien Global 
                        Compact des Nations Unies.
                        
                    </p>
                    <a href="#"
                        class="bg-[#FF7619] inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg hover:bg-[#FF7619] focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>

                </div>
                <!-- <div class="hidden lg:mt-0 lg:col-span-5 lg:flex ">
                    <img src="/images/lion.jpg" alt="mockup">
                </div> -->
                <div
                    class="hidden w-full md:block justify-center items-center lg:mx-10 lg:w-[28rem] rounded-xl h-72 lg:h-[27rem] lg:border-solid lg:border-[#FF7619] lg:border-[0.3rem] div_article_img">

                    <img class="object-cover w-full lg:mx-10 lg:w-[30rem] rounded-xl h-72 lg:h-96" src="/images/antiloppe.jpg"
                        alt="animal" />
                </div>
            </div>
        </section>





        <div id="services" class="relative pt-20 pb-8 bg-white section md:pt-16 md:pb-0">
            <div class="container px-4 mx-auto xl:max-w-6xl">
                <!-- Heading start -->
                <header class="mx-auto mb-12 text-center lg:px-20">
                    <h2 class="mb-2 text-2xl font-bold leading-normal text-black">What We Do</h2>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                        y="0px" viewBox="0 0 100 60" style="margin: 0 auto;height: 35px;" xml:space="preserve">
                        <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                            style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                        <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary"
                            style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                        <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary"
                            style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                    </svg>
                    <p class="pb-2 mx-auto text-xl font-light leading-relaxed text-gray-500">Save time managing
                        advertising
                        &amp; Content for your business.</p>
                </header>
                <!-- End heading -->
                <!-- row -->
                <div class="flex flex-row flex-wrap -mx-4 text-center">
                    <div class="flex-shrink w-full max-w-full px-4 sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp"
                        data-wow-duration="1s"
                        style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                        <!-- service block -->
                        <div
                            class="px-12 py-8 mb-12 transition duration-300 ease-in-out transform border-b border-gray-100 bg-gray-50 hover:-translate-y-2">
                            <div class="inline-block mb-4 text-gray-900">
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold leading-normal text-black">SEO Services</h3>
                            <p class="text-gray-500">This is a wider card with supporting text below as a natural
                                content.
                            </p>
                        </div>
                        <!-- end service block -->
                    </div>
                    <div class="flex-shrink w-full max-w-full px-4 sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp"
                        data-wow-duration="1s" data-wow-delay=".1s"
                        style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <!-- service block -->
                        <div
                            class="px-12 py-8 mb-12 transition duration-300 ease-in-out transform border-b border-gray-100 bg-gray-50 hover:-translate-y-2">
                            <div class="inline-block mb-4 text-gray-900">
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                    class="bi bi-chat-square-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z">
                                    </path>
                                    <path
                                        d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold leading-normal text-black">Social Content</h3>
                            <p class="text-gray-500">This is a wider card with supporting text below as a natural
                                content.
                            </p>
                        </div>
                        <!-- end service block -->
                    </div>
                    <div class="flex-shrink w-full max-w-full px-4 sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp"
                        data-wow-duration="1s" data-wow-delay=".3s"
                        style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <!-- service block -->
                        <div
                            class="px-12 py-8 mb-12 transition duration-300 ease-in-out transform border-b border-gray-100 bg-gray-50 hover:-translate-y-2">
                            <div class="inline-block mb-4 text-gray-900">
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                    class="bi bi-badge-ad" viewBox="0 0 16 16">
                                    <path
                                        d="M3.7 11l.47-1.542h2.004L6.644 11h1.261L5.901 5.001H4.513L2.5 11h1.2zm1.503-4.852l.734 2.426H4.416l.734-2.426h.053zm4.759.128c-1.059 0-1.753.765-1.753 2.043v.695c0 1.279.685 2.043 1.74 2.043.677 0 1.222-.33 1.367-.804h.057V11h1.138V4.685h-1.16v2.36h-.053c-.18-.475-.68-.77-1.336-.77zm.387.923c.58 0 1.002.44 1.002 1.138v.602c0 .76-.396 1.2-.984 1.2-.598 0-.972-.449-.972-1.248v-.453c0-.795.37-1.24.954-1.24z">
                                    </path>
                                    <path
                                        d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold leading-normal text-black">Creative ads</h3>
                            <p class="text-gray-500">This is a wider card with supporting text below as a natural
                                content.
                            </p>
                        </div>
                        <!-- end service block -->
                    </div>

                </div>
                <!-- end row -->
            </div>
        </div>



        <button
            class="newsletter group rounded-2xl h-12 px-2 bg-[#FF7619] font-bold text-lg text-center text-white relative overflow-hidden">
            Je souhaites être informé des Actus
            <div
                class="absolute inset-0 w-full h-full transition-all duration-300 scale-0 group-hover:scale-100 group-hover:bg-white/30 rounded-2xl">
            </div>
        </button>
    </MainLayout>
</template>


<script>
// import MainLayout from "../Layouts/MainLayout.vue";
// import { reactive } from "vue";
// import { ref } from "vue";
// import heading2 from "../Components/heading2.vue";
// import paragraph from "../Components/paragraph.vue";
// import Links from "../Components/Links.vue";
// import heading1 from "../Components/heading1.vue";

export default {
    //   layout: MainLayout,
    props: {
        valueDisplays: String,

        articles: {
            type: Array,
            default: () => [],
        },
        data: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            showFr: false,
            showCmr: false,
            showBj: false,
            showEthp: false,
            showRwd: false,
            showTg: false,
            ShowCartePays: true,
            innerHTML: "",
            secteurs: [
                "Banque / Assurance  ",
                "Télécom  ",
                "Médias  ",
                "Energie  ",
                "E-commerce  ",
                "Immobilier  ",
                "Santé / pharmaceutique  ",
                "Tourisme / loisirs  ",
                "Automobile  ",
                "Technologie ",
            ],
            pays: ["Paris", "Addis - Abbeba", "Cotonou", "Kigali", "Lome", "Yaounde"],
            intervals: [],
            imageSrcVierge: "/images/Fond_carte_vierge.png",
            imageSrcFrance: "/images/Fond_carte_France.png",
            imageSrcBenin: "/images/Fond_carte_Benin.png",
            imageSrcCamer: "/images/Fond_carte_Cameroun.png",
        };
    },

    components: {
        // heading2,
        // paragraph,
        // Links,
        // heading1,
    },
    methods: {
        h1regexdetect(data) {
            const regex = /<h1>(.*?)<\/h1>/; // Expression régulière pour correspondre aux balises <h1> et leur contenu
            const match = data.match(regex); // Effectue une correspondance avec l'expression régulière

            let h1Content = ""; // Variable pour stocker le contenu de la balise <h1>

            if (match && match.length > 1) {
                h1Content = match[1]; // Récupère le contenu capturé par la parenthèse de correspondance dans l'expression régulière
            }

            return h1Content;
        },

        h2regexdetect(data) {
            const regex = /<h2>(.*?)<\/h2>/; // Expression régulière pour correspondre aux balises <h1> et leur contenu
            const match = data.match(regex); // Effectue une correspondance avec l'expression régulière

            let h1Content = ""; // Variable pour stocker le contenu de la balise <h1>

            if (match && match.length > 1) {
                h1Content = match[1]; // Récupère le contenu capturé par la parenthèse de correspondance dans l'expression régulière
            }

            return h1Content;
        },
        paragraregexdetect(data) {
            const regex = /<p>(.*?)<\/p>/; // Expression régulière pour correspondre aux balises <h1> et leur contenu
            const match = data.match(regex); // Effectue une correspondance avec l'expression régulière

            let h1Content = ""; // Variable pour stocker le contenu de la balise <h1>

            if (match && match.length > 1) {
                h1Content = match[1]; // Récupère le contenu capturé par la parenthèse de correspondance dans l'expression régulière
            }
            return h1Content;
        },

        // balise_a_regexdetect(data){

        // let parser = new DOMParser();
        //   let doc = parser.parseFromString(data, 'text/html');

        //   let aTag = doc.querySelector('a');
        //   // return aTag;
        //   if (aTag) {
        //     let aContent = aTag.textContent;
        //     return aContent;}
        //},
        balise_a_regexdetect(html) {
            const tempElement = document.createElement("div");
            tempElement.innerHTML = html;

            const anchorTags = Array.from(tempElement.getElementsByTagName("a")).map(
                (anchor) => anchor.outerHTML
            );
            return anchorTags;
        },

        paragraph_regex_detect(data) {
            const regex = /<p\b[^>]*>(.*?)<\/p>/g;
            const matches = [...data.matchAll(regex)];

            const paragraphs = matches.map((match) => match[0]);
            return paragraphs;
        },

        parsedhtml(data) {
            const parser = new DOMParser();
            const html = parser.parseFromString(data, "text/html");
            return html.body.innerHTML;
        },

        img_src_regex_detect(data) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, "text/html");

            const imgTag = doc.querySelector("img");
            if (imgTag) {
                const srcAttribute = imgTag.getAttribute("src");
                return srcAttribute;
            }
        },

        text_format(data, id) {
            // Sélectionnez l'élément dans lequel vous voulez afficher le rendu HTML
            const container = document.getElementById(id);

            // Modifiez le contenu de l'élément container en utilisant innerHTML
            return (container.innerHTML = data);
        },

        setInnerHTML(html, id) {
            element = document.getElementById(id);
            element.innerHTML = html;
            Array.from(element.querySelectorAll("script")).forEach((oldScript) => {
                const newScript = document.createElement("script");
                Array.from(oldScript.attributes).forEach((attr) =>
                    newScript.setAttribute(attr.name, attr.value)
                );
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });
        },

        changeImage() {
            this.imageSrc = "/images/Fond_carte_pays.png";
        },
        resetImage() {
            this.imageSrc = "/images/Fond_carte_vierge.png";
        },
        slider(element, pays) {
        
            document.querySelector(".carte").src = element;
            // document.querySelector(pays).style="overflow"
            // let TableauPays = [this.showBj, this.showCmr, this.showFr, this.showEthp, this.showRwd];
            let TableauPays = [
                "showBj",
                "showCmr",
                "showFr",
                "showEthp",
                "showRwd",
                "showTg",
            ];
            switch (pays) {
                case "showBj":
                    this.showBj = !this.showBj;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showCmr":
                    this.showCmr = !this.showCmr;
                    this.showBj = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showFr":
                    this.showFr = !this.showFr;
                    this.showCmr = false;
                    this.showBj = false;
                    this.showEthp = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showEthp":
                    this.showEthp = !this.showEthp;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showBj = false;
                    this.showRwd = false;
                    this.showTg = false;
                    break;
                case "showRwd":
                    this.showRwd = !this.showRwd;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showBj = false;
                    this.showTg = false;
                    break;
                case "showTg":
                    this.showTg = !this.showTg;
                    this.showCmr = false;
                    this.showFr = false;
                    this.showEthp = false;
                    this.showBj = false;
                    this.showRwd = false;
                    break;
            }
        },
    },

    mounted() {
        const contentWidth = this.$refs.content.offsetWidth;
        const containerWidth = this.$refs.container.offsetWidth;
        const animationDuration = (contentWidth / containerWidth) * 30;
        this.$refs.content.style.animationDuration = `${animationDuration}s`;
        // Récupérez la valeur de la propriété innerHTML de votre élément dans la console
        let valueDisplays = document.querySelectorAll(".num");

        valueDisplays.forEach((valueDisplay) => {
            let startValue = 0;
            let interval = 10000;

            let endValue = parseInt(valueDisplay.getAttribute("data-val"));
            let duration = Math.floor(interval / endValue);
            function count() {
                startValue++;
                valueDisplay.innerHTML = startValue;
                if (startValue == endValue) {
                    clearInterval(intervalId);
                }
            }
            let intervalId = setInterval(count, duration);
            setTimeout(function () {
                clearInterval(intervalId);
                valueDisplay.innerHTML = endValue;
            }, 8000);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                } else {
                    entry.target.classList.remove("show");
                }
            });
        });
        const hiddenElements = document.querySelectorAll(".absent");
        hiddenElements.forEach((el) => observer.observe(el));
    },
};
</script>
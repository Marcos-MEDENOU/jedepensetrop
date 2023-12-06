<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import axios from "axios"
const props = defineProps({
    // status: {
    //     type: String,
    // },
    successMessage: {
        type: String
    },

    expiryMessage: {
        type: String
    },

    defaultMessage:{
        type:String
    }
});
const sucesspasswordchanges = props.successMessage ? props.successMessage : null


const form = useForm({});

const submit = () => {
    router.get(route('login'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>

        <Head title="Email Verification reussie" />

        <div class="flex items-center justify-center ">
            <div class="rounded-lg">
                <div class="flex justify-center">
                    <div class="py-2 rounded-full " v-if="defaultMessage">
                        <div class="flex items-center justify-center w-16 h-16 p-4 bg-green-500 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>



                        </div>


                    </div>

                    <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" v-if="successMessage"
                        role="alert">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <span class="font-medium">Un mail de réinitialisation vous a déja été envoyé par mail. </span>
                            <span class="font-medium">Consultez votre boite mail !</span>
                        </div>
                    </div>
                </div>

                <div class="flex p-2 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg" role="alert"
                    v-if="expiryMessage">
                    <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Mot de passe expiré! </span>Faites une nouvelle demande de lien de
                        réinitialisation pour
                        votre mot de passe
                    </div>
                </div>


                <h3 class="my-2 text-2xl font-semibold text-center text-gray-700" v-if="defaultMessage">Email de
                    réinitialisation envoyé !!!</h3>
                <p class="font-normal text-center text-gray-600" v-if="defaultMessage">Consultez votre boite mail
                    pour changer votre mot de passe
                </p>
                <div class="mt-4">
                    <PrimaryButton class="bg-gradient-to-tr from-blue-600 to-blue-400" @click="submit()"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Revenir sur la page de connexion
                    </PrimaryButton>
                </div>
            </div>
        </div>



        <!-- <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400" v-if="verificationLinkSent">
            A new verification link has been sent to the email address you provided during registration.
        </div> -->
        <!-- 
        <form @submit.prevent="submit">
            <div class="flex items-center justify-between mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >Log Out</Link
                >
            </div>
        </form> -->
</GuestLayout></template>

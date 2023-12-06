<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },

    status: {
        type: String
    }
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    console.log("submit");
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),

    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Reset Password" />



        <form @submit.prevent="submit" v-if="!props.status ">
            <div class="text-center ">
                <p class="text-sm italic font-light leading-5">Entrez vos identifiants de réinitialisation</p>
            </div>
            <div class="flex flex-col px-2 pt-4 mb-4 bg-white rounded ">


                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-grey-darker" for="username">
                        Adresse électronique
                    </label>
                    <input id="email" type="email"
                        class="w-full px-3 py-2 border rounded shadow appearance-none text-grey-darker" v-model="form.email"
                        required autofocus readonly>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-grey-darker" for="password">
                        Nouveau mot de passe
                    </label>
                    <input class="w-full px-3 py-2 border rounded shadow appearance-none border-red text-grey-darker"
                        id="password" type="password" placeholder="******************" v-model="form.password" required
                        autocomplete="new-password">
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-grey-darker" for="password">
                        Confirmation nouveau mot de passe
                    </label>
                    <input class="w-full px-3 py-2 mb-3 border rounded shadow appearance-none border-red text-grey-darker"
                        id="password_confirmation" type="password" placeholder="******************"
                        v-model="form.password_confirmation" required autocomplete="new-password">
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-end">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="bg-gradient-to-tr from-blue-600 to-blue-400">
                        Réinitialiser le mot de passe
                    </PrimaryButton>
                </div>

            </div>
            <!-- <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="block w-full mt-1"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </PrimaryButton>
            </div> -->
        </form>

        <div class="flex p-2 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg" role="alert" v-else>
            <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <div>
                <span class="font-medium">Mot de passe expiré! </span>Faites une nouvelle demande de lien de réinitialisation pour
                votre mot de passe
            </div>
        </div>
</GuestLayout></template>

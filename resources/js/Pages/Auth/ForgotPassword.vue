<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import axios from "axios"
const props = defineProps({
    status: {
        type: String,
    },
    successMessage: {
        type: String
    }

});


const sucesspasswordchanges = props.successMessage ? props.successMessage : null

if (sucesspasswordchanges) {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Un lien de réinitialisation vous a déja été envoyé",
        showConfirmButton: true,
        timer: 2500
    });
}

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>

        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Mot de passe oublié? Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons par
            e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    class="bg-gradient-to-tr from-blue-600 to-blue-400">
                    RECEVOIR UN LIEN DE RÉINITIALISATION DU MOT DE PASSE PAR EMAIL
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

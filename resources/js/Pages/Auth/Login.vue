<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const test=()=>{
    router.get(route('socialite.redirect', 'google'))
}
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class=" rounded-xl">
                    <div class="py-4">

                        <div class="grid space-y-4">
                            <a href="/redirect/google"
                                class="px-6 py-2 transition duration-300 border-2 border-orange-600 rounded-full hover:border-orange-700 ">
                                <div class="relative flex items-center justify-center space-x-4">
                                    <img src="https://tailus.io/sources/blocks/social/preview/images/google.svg"
                                        class="absolute left-0 w-5" alt="google logo">
                                    <span
                                        class="block text-sm font-semibold tracking-wide text-gray-700 transition duration-300 w-max group-hover:text-blue-600 sm:text-base">Se
                                        connecter
                                        avec Google</span>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

        <form @submit.prevent="submit">
            <div>

               

                <div class="flex items-center justify-center py-2">
                    <span class="w-full border border-black"></span>
                    <span class="px-4">Ou</span>
                    <span class="w-full border border-black"></span>
                </div>

                <InputLabel for="email" value="Adresse électronique" />

                <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Mot de passe" />

                <TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required
                    autocomplete="current-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                </label>
            </div>

            <div class="mt-4 ">
                <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Se connecter
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

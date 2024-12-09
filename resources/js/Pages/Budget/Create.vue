<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from "@/Layouts/AppLayout.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Crear Presupuesto
            </h2>
        </template>
    <Head title="Nuevo Presupuesto" />


        <div class=" flex mt-6 justify-center bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="type" value="Tipo de viaje" class="mb-1" />
                        <select id="type"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="oneway">Sencillo</option>
                            <option value="roundtrip">Redondo</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="departure_route" value="Ruta de ida" class="mb-1" />
                        <select id="departure_route"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="1">Opción 1</option>
                            <option value="2">Opción 2</option>
                            <option value="3">Opción 3</option>
                        </select>
                    </div>



                    <div class="mt-4">
                        <InputLabel for="options" value="options" class="mb-1" />
                        <select id="options"
                        class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="1">Opción 1</option>
                            <option value="2">Opción 2</option>
                            <option value="3">Opción 3</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="true">
                            Guardar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>


    </AppLayout>
</template>

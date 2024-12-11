<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Flatpickr from "@/Components/Flatpickr.vue";

const props = defineProps({
    routes: Object,
    units: Object,
    gasprices: Object,
});

const isFormValid = computed(() => {
    return (
        form.type &&
        form.departure_route &&
        form.departure &&
        form.passengers > 0 &&
        form.unit &&
        form.gasprice &&
        (form.type !== 'roundtrip' || (form.return_route && form.return))
    );
});

const form = useForm({
    type: ref(''),
    departure_route: '',
    return_route: '',
    departure: '',
    return: '',
    passengers: '',
    unit: '',
    gasprice: '',
});

const submit = () => {
    form.post(route('budgets.create'), {

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
                <form @submit.prevent="submit" >
                    <div>
                        <InputLabel for="type" value="Tipo de viaje" class="mb-1" />
                        <select id="type" v-model="form.type"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="oneway">Sencillo</option>
                            <option value="roundtrip">Redondo</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.type" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="departure_route" value="Ruta de ida" class="mb-1" />
                        <select id="departure_route" v-model="form.departure_route"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option v-for="route in routes" :key="route.id" :value="route.id" >{{ route.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.departure_route" />
                    </div>
                    <div v-if="form.type === 'roundtrip'" class="mt-4">
                        <InputLabel for="return_route" value="Ruta de regreso" class="mb-1" />
                        <select id="return_route" v-model="form.return_route"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option v-for="route in routes" :key="route.id" :value="route.id" >{{ route.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.return_route" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="departure" value="Fecha de Partida" class="mb-1" />
                        <Flatpickr v-model="form.departure" format="Y-m-d H:i" />
                        <InputError class="mt-2" :message="form.errors.departure" />
                    </div>
                    <div v-if="form.type === 'roundtrip'" class="mt-4">
                        <InputLabel for="return" value="Fecha de Regreso" class="mb-1" />
                        <Flatpickr v-model="form.return" format="Y-m-d H:i" />
                        <InputError class="mt-2" :message="form.errors.return" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="passengers" value="Numero de pasajeros" />
                        <TextInput
                            v-model="form.passengers"
                            id="password_confirmation"
                            type="number"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.passengers" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="unit" value="Tipo de Vehiculo" class="mb-1" />
                        <select id="unit" v-model="form.unit"
                        class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option v-for="unit in units" :key="unit.id" :value="unit.id">{{ unit.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.unit" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="gasprice" value="Tipo de Combustible" class="mb-1" />
                        <select id="gasprice" v-model="form.gasprice"
                        class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option value="" disabled selected>Seleccione...</option>
                            <option v-for="gasprice in gasprices" :key="gasprice.id" :value="gasprice.id">{{ gasprice.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gasprice" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-50 cursor-not-allowed': !isFormValid }"
                            :disabled="!isFormValid">
                            Calcular Presupuesto
                        </PrimaryButton>

                    </div>
                </form>
            </div>
        </div>


    </AppLayout>
</template>

<script setup>
import {ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import SingleTableHeader from '@/Components/SingleTableHeader.vue';
import SingleTable from '@/Components/SingleTable.vue';
import TableFooter from '@/Components/TableFooter.vue';

const props = defineProps({
    budgets: Object,
});

const headers = [
    { key: 'user_name',label:'Creado por' },
    { key: 'type',label:'Tipo' },
    { key: 'departure',label:'Fecha/Hora de Salida' },
    { key: 'return',label:'Fecha/Hora de Retorno' },
    { key: 'passengers',label:'Cantidad Pasajeros' },
];

const add = () => {
    console.log('se activa el boton de agregar');
}
</script>

<template>
    <AppLayout>
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex space-x-4 justify-between">
                <h1 class="text-white text-4xl my-4">Presupuestos</h1>
            </div>
            <SingleTableHeader>
                <template #title> Presupuestos </template>
                <template #subtitle></template>
                <template #buttons>
                    <button type="button"
                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                        </svg>
                        Agregar
                    </button>
                </template>
                <SingleTable :data="budgets.data" :headers="headers"/>

            </SingleTableHeader>
        </div>

        <div class="flex justify-center m-5">
        </div>

    </AppLayout>
</template>

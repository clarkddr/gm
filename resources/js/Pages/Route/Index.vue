<script setup>
import {ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import SingleTableHeader from '@/Components/SingleTableHeader.vue';
import SingleTable from '@/Components/SingleTable.vue';
import TableFooter from '@/Components/TableFooter.vue';

const props = defineProps({
    routes: Object,
});

const headers = [
    { key: 'name',label:'Nombre' },
    { key: 'departure_distance',label:'Distancia' },
];

const add = () => {
    console.log('se activa el boton de agregar');
}
</script>

<template>
    <AppLayout>
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex space-x-4 justify-between">
                <h1 class="text-white text-4xl my-4">Rutas</h1>
            </div>
            <SingleTableHeader>
                <template #title> Rutas </template>
                <template #subtitle></template>
                <SingleTable :data="routes.data" :headers="headers"/>

            </SingleTableHeader>
        </div>

        <div class="flex justify-center m-5">
        </div>

    </AppLayout>
</template>

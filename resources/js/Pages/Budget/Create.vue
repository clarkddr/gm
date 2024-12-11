<script setup>
import {ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import SingleTableHeader from '@/Components/SingleTableHeader.vue';
import SingleTable from '@/Components/SingleTable.vue';
import TableFooter from '@/Components/TableFooter.vue';

const props = defineProps({
    data: Object,

});

const headers = [
    { key: 'name',label:'Nombre carretera' },
];

</script>
<template>
    <AppLayout>
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h1 class="mb-4 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Resumen del viaje</h1>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Tipo de viaje</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ data.type }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Fecha de partida</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ data.departure_date }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Tipo de Vehiculo</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ data.unit_name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Total pasajeros</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ data.passengers }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Tipo de combustible</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ data.gas_name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Precio de combustible</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            $ {{ data.gas_price }} lt.
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Distancia de la ruta</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ data.departure_route.departure_distance }} km.
                        </span>
                    </div>
                </div>
            </div>
            <SingleTableHeader>
                <template #title>
                    <div class="flex space-x-4 justify-between">
                        <h1 class="text-white text-4xl">Itinerario de Viaje</h1>
                    </div>
                </template>
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Carretera</th>
                                <th class="px-6 py-3">Caseta</th>
                                <th class="px-6 py-3">Precio Caseta</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,rowIndex) in data.departure_route.roads" :key="rowIndex" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td :key="item.key" class="px-6 py-4">
                                    {{ item['name'] }}
                                </td>
                                <td :key="item.key" class="px-6 py-4">
                                    {{ item.toll ? item.toll.name : '' }}
                                </td>
                                <td v-for="header in headers" :key="header.key" class="px-6 py-4">
                                    {{ item.toll && item.toll.units[0] ? item.toll.units[0].pivot.price : '' }}
                                </td>
                            </tr>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <td class="px-6 py-4 font-bold text-lg " colspan="2">Total Casetas</td>
                                <td class="px-6 py-4 font-bold text-lg ">
                                    {{ data.total_departure_toll_cost }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-center my-5">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                                <!-- Card 1 -->
                                <p class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gasto Total Gasolina</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">
                                        $ {{ data.total_gas_cost }}
                                    </p>
                                </p>

                                <!-- Card 2 -->
                                <p class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gasto Total Peajes</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">
                                        $ {{ data.total_tolls_cost }}
                                    </p>
                                </p>

                                <!-- Card 3 -->
                                <p class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gasto Total Viaticos</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">
                                        {{'$ '+ data.total_allowance_cost}}
                                    </p>
                                </p>
                                <p class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Gasto Total</h5>
                                    <p class="font-bold text-xl text-gray-700 dark:text-gray-400">
                                        {{'$ '+ data.total_cost}}
                                    </p>
                                </p>
                            </div>
                        </div>
                </div>
            </SingleTableHeader>
        </div>
    </AppLayout>
</template>

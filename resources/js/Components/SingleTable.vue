<script setup>

defineProps({
    data: Object,
    headers: Array,
})
</script>

<template>


<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th v-for="header in headers" :key="header.key" scope="col" class="px-6 py-3">
                    {{ header.label }}
                </th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,rowIndex) in data" :key="rowIndex" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <!-- <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th> -->
                <td v-for="header in headers" :key="header.key" class="px-6 py-4">
                    {{ item[header.key] }}
                </td>

            </tr>
        </tbody>
    </table>
</div>





</template>

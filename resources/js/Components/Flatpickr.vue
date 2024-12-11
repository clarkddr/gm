<template>
    <div>
        <input
            type="text"
            ref="datepicker"
            class="form-input mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
    </div>
</template>

<script>
import { onMounted, watch, ref } from 'vue';
import flatpickr from 'flatpickr';
import "flatpickr/dist/flatpickr.css";

export default {
    props: {
        modelValue: String, // v-model
        format: {
            type: String,
            default: "Y-m-d H:i",
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const datepicker = ref(null);
        let flatpickrInstance = null;

        onMounted(() => {
            flatpickrInstance = flatpickr(datepicker.value, {
                enableTime: true,
                dateFormat: props.format,
                defaultDate: props.modelValue,
                onChange: (selectedDates, dateStr) => {
                    emit('update:modelValue', dateStr);
                },
            });
        });

        watch(() => props.modelValue, (newVal) => {
            if (flatpickrInstance) {
                flatpickrInstance.setDate(newVal, false); // Actualiza la fecha sin disparar eventos
            }
        });

        return { datepicker };
    },
};
</script>

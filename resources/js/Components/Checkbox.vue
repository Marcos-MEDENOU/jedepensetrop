<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="text-orange-700 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-orange-700 dark:focus:ring-orange-700 dark:focus:ring-offset-gray-800"
    />
</template>

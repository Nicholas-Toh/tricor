<script setup>
import { propsToAttrMap } from '@vue/shared';
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: {
        default: null,
    },
    options: {
        type: Array,
        required: true,
    },
    labels: {
        type: Object,
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const getOption = (option) => props.labels[option] ?? option
</script>

<template>
    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <option v-for="option in props.options" :key="option" :value="option">{{ getOption(option) }}</option>
    </select>
</template>

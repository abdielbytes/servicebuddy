<script setup lang="ts">
import { defineProps, defineEmits, onMounted } from 'vue';

const props = defineProps<{
    message: string | null;
}>();

const emit = defineEmits(['close']);

onMounted(() => {
    if (props.message) {
        setTimeout(() => {
            emit('close'); // Emit an event to clear the message after 3 seconds
        }, 3000);
    }
});
</script>

<template>
    <div v-if="message" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-md">
        {{ message }}
        <button class="ml-2 text-white font-bold" @click="emit('close')">×</button>
    </div>
</template>

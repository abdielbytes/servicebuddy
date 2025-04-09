<script setup>
import { ref, defineEmits } from 'vue';

const showModal = ref(false);
const emit = defineEmits(['close']);

const closeModal = () => {
    showModal.value = false;
};

const openModal = () => {
    showModal.value = true;
};
</script>

<template>
    <!-- Button to open modal -->
    <button @click="openModal" class="bg-blue-500 text-white font-bold py-2 px-4 rounded ml-3">
        New Return Visit
    </button>

    <!-- Modal -->
    <transition name="slide-up">
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-end justify-center bg-black bg-opacity-50">
            <div class="w-full max-w-md rounded-t-2xl bg-white p-5 shadow-lg">
                <!-- Modal Header -->
                <div class="flex justify-between items-center border-b pb-3">
                    <h3 class="text-lg font-bold">Add Return Visit</h3>
                    <button @click="closeModal" class="text-gray-600 hover:text-black">✕</button>
                </div>

                <!-- Modal Content -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" placeholder="Enter name">

                    <label class="block mt-3 text-sm font-medium text-gray-700">Location</label>
                    <input type="text" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" placeholder="Enter location">

                    <label class="block mt-3 text-sm font-medium text-gray-700">Notes</label>
                    <textarea class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500" placeholder="Enter details"></textarea>
                </div>

                <!-- Modal Footer -->
                <div class="mt-4 flex justify-end">
                    <button @click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">
                        Cancel
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<style>
/* Slide-up animation */
.slide-up-enter-active, .slide-up-leave-active {
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
}
.slide-up-enter-from, .slide-up-leave-to {
    transform: translateY(100%);
    opacity: 0;
}
</style>

<script setup lang="ts">
import { computed, ref, onMounted, onUnmounted } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Button } from '@/components/ui/button';
import SuccessResponse from "@/components/ui/alert/SuccessResponse.vue";

const page = usePage();
const successMessage = ref<string | null>(page.props.flash?.success || null);
const startTime = ref<string | null>(page.props.start ?? null);
const elapsedTime = ref<string>("00:00:00");
let timer: ReturnType<typeof setInterval> | null = null;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];


// Function to start the timer
const startTimer = () => {
    if (!startTime.value) return;

    const startDate = new Date(startTime.value + "Z"); // Force UTC interpretation

    timer = setInterval(() => {
        const now = new Date();
        const diffMs = now.getTime() - startDate.getTime();

        const hours = Math.floor(diffMs / (1000 * 60 * 60)).toString().padStart(2, "0");
        const minutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, "0");
        const seconds = Math.floor((diffMs % (1000 * 60)) / 1000).toString().padStart(2, "0");

        // console.log("Fixed Time Difference (ms):", diffMs);
        // console.log("Timer Values:", { hours, minutes, seconds });

        elapsedTime.value = `${hours}:${minutes}:${seconds}`;
    }, 1000);
};



// Function to stop the timer
const stopTimer = () => {
    if (timer) clearInterval(timer);
};

// Inertia form submission
const form = useForm({
    start: '',
    end: ''
});

const submit = (action: 'start' | 'end') => {
    if (action === 'start') {
        form.start = new Date().toISOString().slice(0, 19).replace('T', ' ');
        form.post(route('start-service-day'), {
            onSuccess: () => {
                successMessage.value = page.props.flash?.success || "Service day started successfully!";
                startTime.value = form.start;
                startTimer();
            },
            onError: (error) => {
                console.error('Error Response:', error);
            }
        });
    } else {
        form.end = new Date().toISOString().slice(0,19).replace('T', ' ');
        form.post(route('end-service-day'), {
            onSuccess: () => {
                successMessage.value = page.props.flash?.success || "Service day ended successfully!";
                stopTimer();
                elapsedTime.value = "00:00:00"; // Reset the timer display
                startTime.value = null; // Clear startTime
            },
            onError: (error) => {
                console.error('Error Response:', error);
            }
        });
    }
};

// Start timer if there is an active service day
onMounted(() => {
    if (startTime.value) {
        startTimer();
    }
});

// Cleanup on component unmount
onUnmounted(() => {
    stopTimer();
});
</script>

<template>

    <SuccessResponse v-if="successMessage" :message="successMessage" @close="successMessage = null" />

    <div class="flex justify-center pt-4 mt-4">
        <Button class="bg-blue-500 text-white font-bold py-2 px-4 rounded ml-3" @click="submit('start')">
            Start Service Day
        </Button>

        <Button class="bg-red-700 text-white font-bold py-2 px-4 rounded ml-3" @click="submit('end')">
            End Service Day
        </Button>
    </div>

    <!-- Display Elapsed Time -->
    <div class="flex justify-center pt-4 font-bold text-5xl mt-4">
        <h1>{{ elapsedTime }}</h1>
    </div>

    <div class="flex justify-center pt-3 font-semibold text-xl mb-2"
    >
        11 Hrs
    </div>
</template>

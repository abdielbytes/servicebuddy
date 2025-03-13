<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Button } from '@/components/ui/button';
import SuccessResponse from "@/components/ui/alert/SuccessResponse.vue";

const page = usePage();
const successMessage = ref<string | null>(page.props.flash?.success || null);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const currentTime = () => new Date().toISOString();

const form = useForm({
    start: '',
    end: ''
});

const submit = (action: 'start' | 'end') => {
    if (action === 'start') {
        form.start = currentTime();
        form.post(route('start-service-day'), {
            onSuccess: () => {
                successMessage.value = page.props.flash?.success || "Service day started successfully!";
            },
            onError: (error) => {
                console.error('Error Response:', error);
            }
        });
    } else {
        form.end = currentTime();
        form.post(route('end-service-day'), {
            onSuccess: () => {
                successMessage.value = page.props.flash?.success || "Service day ended successfully!";
            },
            onError: (error) => {
                console.error('Error Response:', error);
            }
        });
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Success message display -->
        <SuccessResponse v-if="successMessage" :message="successMessage" @close="successMessage = null" />

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="flex justify-center pt-8">
                        <Button class="bg-blue-500 text-white font-bold py-2 px-4 rounded ml-3" @click="submit('start')">
                            Start Service Day
                        </Button>

                        <Button class="bg-red-700 text-white font-bold py-2 px-4 rounded ml-3" @click="submit('end')">
                            End Service Day
                        </Button>
                    </div>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>

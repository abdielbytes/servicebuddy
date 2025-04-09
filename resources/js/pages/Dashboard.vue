<script setup lang="ts">
import { computed, ref, onMounted, onUnmounted } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Button } from '@/components/ui/button';
import ServiceHour from "@/components/ServiceHour.vue";
import AddReturnVisits  from '@/components/AddReturnVisits.vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];


</script>


<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
<!--        <SuccessResponse v-if="successMessage" :message="successMessage" @close="successMessage = null" />-->

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">

                    <ServiceHour />

                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="flex justify-center pt-4 mt-4">

                        <AddReturnVisits />

                    </div>

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

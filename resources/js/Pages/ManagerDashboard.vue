<script setup>
import ManagerLayout from '@/Layouts/ManagerLayout.vue';
import SalesReportForm from '@/Pages/Sales/Partials/SalesReportForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    views: {
        type: Array,
    },
    viewLabels: {
        type: Object,
    },
    agents: {
        type: Array
    }
})
</script>

<template>
    <ManagerLayout>

        <Head title="Dashboard"></Head>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <SalesReportForm :views="views" :view-labels="viewLabels" :agents="agents" />
                </div>
            </div>
        </div>
    </ManagerLayout>
</template>

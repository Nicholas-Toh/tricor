<script setup>
import Dashboard from '@/Pages/Dashboard.vue';
import SalesReportForm from '@/Pages/Sales/Partials/SalesReportForm.vue';

defineProps({
    views: {
        type: Array,
    },
    viewLabels: {
        type: Object,
    },
})
</script>

<template>
    <Dashboard>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <SalesReportForm :views="views" :view-labels="viewLabels" />
                </div>
            </div>
        </div>
    </Dashboard>
</template>

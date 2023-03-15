<script setup>
import Dashboard from '@/Pages/Dashboard.vue';
import SalesTransactionForm from '@/Pages/Sales/Partials/SalesTransactionForm.vue';
import SalesTransactions from '@/Pages/Sales/Partials/SalesTransactions.vue';

defineProps({
    salesTransactions: {
        type: Array,
    },
})
</script>

<template>
    <Dashboard>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <SalesTransactionForm />
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <SalesTransactions :salesTransactions="salesTransactions" />
                </div>
            </div>
        </div>
    </Dashboard>
</template>

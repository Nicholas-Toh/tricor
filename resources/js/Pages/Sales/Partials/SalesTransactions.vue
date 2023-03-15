<script setup>
import { computed } from 'vue';

const props = defineProps({
    salesTransactions: {
        type: Array,
        required: true,
    },
})


const total = computed(() => props.salesTransactions.reduce((acc, value) => acc + value.amount, 0))
</script>

<template>
    <section id="sales-report">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Recent Transactions</h2>
        </header>

        <div class="w-full mt-4 text-lg">
            <table class="table w-full text-center border border-collapse border-slate-400">
                <thead>
                    <th class="border border-collapse border-slate-400">Sales Item</th>
                    <th class="border border-collapse border-slate-400">Date</th>
                    <th class="border border-collapse border-slate-400">Amount (RM)</th>
                </thead>
                <tbody>
                    <tr v-for="transaction in salesTransactions">
                        <td class="border border-collapse border-slate-400">{{ transaction.sales_item }}</td>
                        <td class="border border-collapse border-slate-400">{{ new
                            Date(transaction.created_at).toLocaleDateString() }}</td>
                        <td class="border border-collapse border-slate-400">{{ transaction.amount }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="mt-6 pr-4 text-lg w-full text-right">
            <span><b>Total: RM{{ total }}</b></span>
        </div>
    </section>
</template>

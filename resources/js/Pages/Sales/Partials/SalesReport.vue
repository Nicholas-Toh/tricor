<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import { computed } from 'vue';

const props = defineProps({
    salesTransactions: {
        type: Array,
        required: true,
    },
    date: {
        type: Date,
        required: true,
    },
    view: {
        type: String
    }
})

const dateString = computed(() => {
    switch (props.view) {
        case 'year':
            return props.date.toLocaleDateString('en-gb', {
                year: 'numeric'
            });
        case 'month':
        default:
            return props.date.toLocaleDateString('en-gb', {
                month: 'long',
                year: 'numeric',
            })
    }
});

const total = computed(() => props.salesTransactions.reduce((acc, value) => acc + value.amount, 0))
</script>

<template>
    <section>
        <header class="text-center">
            <h2 class="text-4xl font-medium text-gray-900">Sales Report</h2>
            <p class="mt-1 text-xl text-gray-600">
                For the period {{ dateString }}
            </p>
        </header>

        <div class="w-full mt-4 text-lg">
            <table class="table w-full text-center border border-collapse border-slate-400">
                <thead>
                    <th class="border border-collapse border-slate-400">Agent</th>
                    <th class="border border-collapse border-slate-400">Sales Item</th>
                    <th class="border border-collapse border-slate-400">Date</th>
                    <th class="border border-collapse border-slate-400">Amount (RM)</th>
                </thead>
                <tbody>
                    <tr v-for="transaction in salesTransactions">
                        <td class="border border-collapse border-slate-400">{{ transaction.user.name }}</td>
                        <td class="border border-collapse border-slate-400">{{ transaction.sales_item }}</td>
                        <td class="border border-collapse border-slate-400">{{ new
                            Date(transaction.created_at).toLocaleDateString() }}</td>
                        <td class="border border-collapse border-slate-400">{{ transaction.amount }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="mt-6 pr-4 text-xl w-full text-right">
            <span><b>Total: RM{{ total }}</b></span>
        </div>
    </section>
</template>

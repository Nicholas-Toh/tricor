<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    sales_item: '',
    amount: '',
});

const createSalesTransaction = () => {
    form.post(route('api.sales-transaction.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('amount');
                amountInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Enter Sales Transaction</h2>
        </header>

        <form @submit.prevent="createSalesTransaction" class="mt-6 space-y-6">
            <div>
                <InputLabel for="sales_item" value="Sales Item" />

                <TextInput id="sales_item" ref="salesItemInput" v-model="form.sales_item" type="text"
                    class="mt-1 block w-full" autocomplete="on" placeholder="e.g. Burger" required />

                <InputError :message="form.errors.sales_item" class="mt-2" />
            </div>

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput id="amount" ref="amountInput" v-model="form.amount" type="number" class="mt-1 block w-full"
                    min="1" step="any" required />

                <InputError :message="form.errors.amount" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    views: {
        type: Array,
        required: true,
    },
    viewLabels: {
        type: Object,
        required: true,
    },
    agents: {
        type: Array,
        required: true,
    }
})
console.log(props)

const form = useForm({
    agent: '',
    month: '',
    year: '',
    view: props.views[0],
});

const getSalesReport = () => {
    form.get(route('sales-reports'), {
        preserveState: true,
        preserveScroll: true,
        onError: () => {
            if (form.errors.agent) {
                form.reset('agent');
                agent.value.focus();
            }
        },
    });
};

const agentOptions = computed(() => props.agents.map(agent => agent.user_id));
const agentOptionLabels = computed(() => {
    let temp = {};
    for (const agent of props.agents) {
        temp[agent.user_id] = agent.user.name;
    }

    return temp;
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Search Latest Reports</h2>
        </header>

        <form @submit.prevent="getSalesReport" class="mt-6 space-y-6">
            <div>
                <InputLabel for="view" value="Format" />

                <Select id="view" class="mt-1 block w-full" v-model="form.view" :options="views" :labels="viewLabels"
                    required>
                </Select>

                <InputError :message="form.errors.view" class="mt-2" />
            </div>

            <div v-if="form.view === 'month'">
                <InputLabel for="month" value="Month" />

                <TextInput id="month" ref="month" v-model="form.month" type="number" class="mt-1 block w-full" min="1"
                    max="12" />

                <InputError :message="form.errors.month" class="mt-2" />
            </div>

            <div>
                <InputLabel for="year" value="Year" />

                <TextInput id="year" ref="year" v-model="form.year" type="number" class="mt-1 block w-full" min="1900"
                    :max="new Date().toLocaleDateString('en-gb', { year: 'numeric' })" />

                <InputError :message="form.errors.year" class="mt-2" />
            </div>

            <div>
                <InputLabel for="agent" value="Marketing Agent ID" />

                <Select id="agent" class="mt-1 block w-full" v-model="form.agent" :options="agentOptions"
                    :labels="agentOptionLabels">
                </Select>

                <InputError :message="form.errors.agent" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Get Report</PrimaryButton>
            </div>
        </form>
    </section>
</template>

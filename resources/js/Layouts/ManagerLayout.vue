<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>

<template>
    <AuthenticatedLayout>
        <template #nav-links>
            <NavLink :href="route('sales-reports')" :active="route().current('sales-reports')">
                Sales Reports
            </NavLink>
        </template>

        <template #responsive-nav-links>
            <ResponsiveNavLink :href="route('sales-reports')" :active="route().current('sales-reports')">
                Sales Reports
            </ResponsiveNavLink>
        </template>

        <template #header>
            <slot name="header"></slot>
        </template>

        <slot />
    </AuthenticatedLayout>
</template>

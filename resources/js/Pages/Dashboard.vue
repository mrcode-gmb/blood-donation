<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import HeadNav from "../Components/HeadNav.vue"


</script>

<template>
    <Head title="Dashboard" />
    <HeadNav/>
    <AuthenticatedLayout>

    </AuthenticatedLayout>

</template>



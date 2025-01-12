<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
defineProps({ user: Object })
</script>
<template>

    <Head title="Home" />
    <h1 class="text-4xl">
        Welcome {{ user.username }}
    </h1>
    <Link :href="route('logout')" method="post" as="button" class="bg-cyan-500 text-black px-5 py-3">Logout</Link>
</template>

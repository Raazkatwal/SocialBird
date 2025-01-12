<script setup>
import Welcome from './Welcome.vue';
import Home from './Home.vue';
defineProps({isLoggedIn: Boolean, loggedUser: Object});
</script>

<template>
    <!-- {{ user }} -->
    <Welcome v-if="isLoggedIn===false"/>
    <Home v-else :user=loggedUser />
</template>
<script setup>
import Welcome from './Profile/Welcome.vue';
import Home from '../Layouts/Home.vue';
defineProps({isLoggedIn: Boolean, loggedUser: Object, posts: Object});
</script>

<template>
    <Welcome v-if="isLoggedIn===false"/>
    <Home v-else :user=loggedUser :posts=posts />
</template>
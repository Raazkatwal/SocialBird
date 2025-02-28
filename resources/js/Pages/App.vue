<script setup>
import Welcome from './Profile/Welcome.vue';
import Home from '../Layouts/Home.vue';
import { provide } from 'vue';
const props = defineProps({isLoggedIn: Boolean, loggedUser: Object, posts: Object, likes: Object});
provide('likes', props.likes);
</script>

<template>
    <Welcome v-if="isLoggedIn===false"/>
    <Home v-else :posts=posts :user="loggedUser"/>
</template>
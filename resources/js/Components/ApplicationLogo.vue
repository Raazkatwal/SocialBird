<script setup>
defineProps({
    width:{
        type: Number,
        default: 500
    },
    height:{
        type: Number,
        default: 500
    },
    })
</script>
<template>
    <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" :width="width" :height="height">
    <path
        d="M190 70H70l10 70h70l10 20 10 50 10 25H50M230 70v165m0-165h70a50 50 0 0 1 0 80h-70m0 0h70a50 50 0 0 1 0 85h-70"
        stroke="#fff" 
        stroke-width="30" 
        stroke-linejoin="bevel" 
        fill="none" />
</svg>
</template>

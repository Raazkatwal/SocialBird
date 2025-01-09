<script setup>
import { Head } from "@inertiajs/vue3";
import { defineEmits } from "vue";

const emit = defineEmits(["opensignup"]);
</script>

<template>
    <Head title="Login" />
    <form action="" class="flex select-none flex-col items-center justify-items-center gap-5 text-2xl">
        <h1 class="text-3xl font-extrabold uppercase">Welcome Back</h1>
        <input type="text" name="" class="h-14 w-3/5 rounded-md bg-transparent text-lg font-medium text-white"
            placeholder="Phone, Email or Username" />
        <input type="password" name="" class="h-14 w-3/5 rounded-md bg-transparent text-lg font-medium text-white"
            placeholder="Password" />
        <div>
            <input type="checkbox" name="" id="rememberMe" class="border-none bg-gray-600 focus:ring-0" /> <label for="rememberMe" class="text-sm">Remember me</label>
        </div>
        <button class="h-12 w-1/2 rounded-full bg-white font-openSans font-bold text-[#30353A] text-lg">
            Login
        </button>
        <button
            class="h-12 w-1/2 rounded-full border border-gray-600 bg-transparent font-openSans font-bold text-white text-sm">
            Forgot Password
        </button>
        <p class="text-lg mt-16">
            Don't have a account ? 
            <a href="#" @click.prevent="emit('opensignup')" class="text-accent">
                Sign Up
            </a>
        </p>
    </form>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { defineEmits } from "vue";

const emit = defineEmits(["opensignup"]);

const form = useForm({
    'email_or_username': '',
    'password': '',
    'remember': false,
})

function submit() {
    form.post(route('login'));
}

</script>

<template>

    <Head title="Login" />
    <form class="flex select-none flex-col items-center justify-items-center gap-5 text-2xl" @submit.prevent="submit">

        <h1 class="text-3xl font-extrabold uppercase">Welcome Back</h1>

        <div class="w-3/4">
            <input type="text" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
                v-model="form.email_or_username" placeholder="Email or Username" required />
            <span v-if="form.errors.email_or_username" class="text-red-500 text-sm">{{ form.errors.email_or_username
                }}</span>
        </div>

        <div class="w-3/4">
            <input type="password" class="h-14 rounded-md bg-transparent text-lg font-medium text-white w-full"
                v-model="form.password" placeholder="Password" required />
            <span v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</span>
        </div>

        <div>
            <input type="checkbox" id="rememberMe" class="border-none bg-gray-600 focus:ring-0"
                v-model="form.remember" /> <label for="rememberMe" class="text-sm">Remember me</label>
        </div>

        <button class="h-12 w-1/2 rounded-full bg-white font-openSans font-bold text-[#30353A] text-lg" type="submit">
            Login
        </button>

        <button type="submit"
            class="h-12 w-1/2 rounded-full border border-gray-600 bg-transparent font-openSans font-bold text-white text-sm">
            Forgot Password
        </button>

        <p class="text-lg mt-10">
            Don't have a account ?
            <a @click.prevent="emit('opensignup')" class="text-accent">
                Sign Up
            </a>
        </p>
    </form>
</template>

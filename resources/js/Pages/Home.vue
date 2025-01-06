<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import LoginForm from "@/Pages/login.vue";
import SignUpForm from "@/Pages/signup.vue";

const showLoginForm = ref(false);
const showSignupForm = ref(false);
const currentModal = ref(null);

// Open the dialog when Login or Create account is clicked
const openDialog = (form) => {
    if (form === 'login') {
        showLoginForm.value = true;
        showSignupForm.value = false;
    } else if (form === 'signup') {
        showLoginForm.value = false;
        showSignupForm.value = true;
    }
    if (currentModal.value) {
        currentModal.value.showModal();
    }
};

const closeDialog = () => {
    if (currentModal.value) {
        showLoginForm.value = false;
        showSignupForm.value = false;
        currentModal.value.close();
    }
};
</script>

<template>
    <Head title="Home" />
    <div class="gap-5 flex h-screen items-center justify-between px-32 py-16">
        <div>
            <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" width="400" height="300">
                <path
                    d="M240 70H120l10 70h70l10 20 10 50 10 25H100M280 70v165m0-165h70a50 50 0 0 1 0 80h-70m0 0h70a50 50 0 0 1 0 85h-70"
                    stroke="#fff" stroke-width="30" stroke-linejoin="bevel" fill="none" />
            </svg>
        </div>

        <div>
            <h1 class="mb-12 font-poppins text-6xl font-extrabold">
                Happening Now.
            </h1>
            <div class="flex flex-col gap-4 w-3/5">
                <h3 class="font-openSans text-4xl font-bold text-left mb-5">Join Today.</h3>
                <button @click="openDialog('login')"
                    class="bg-transparent w-full h-12 font-bold font-openSans rounded-full border border-gray-600 text-accent">Login</button>
                <div class="flex items-center">
                    <hr class="flex-grow border-gray-600">
                    <span class="px-2 text-gray-500">or</span>
                    <hr class="flex-grow border-gray-600">
                </div>
                <button @click="openDialog('signup')" class="bg-accent w-full h-12 font-bold font-openSans rounded-full">Create account</button>
                <p class="text-xs text-gray-500">By signing up, you agree to the <span class="text-accent">Terms of
                        Service</span> and <span class="text-accent">Privacy Policy</span>, including <span
                        class="text-accent">Cookie Use.</span></p>
            </div>
        </div>

        <dialog ref="currentModal" class="backdrop:bg-white backdrop:bg-opacity-10 bg-black text-white p-5 rounded-xl">
            <button @click="closeDialog"><i class="fa-solid fa-x"></i></button>
            <div class="overflow-x-hidden overflow-y-visible size-52">
                <LoginForm v-if="showLoginForm" />
                <SignUpForm v-if="showSignupForm" />
            </div>
        </dialog>
    </div>
</template>

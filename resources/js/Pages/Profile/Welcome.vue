<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import LoginForm from "@/Components/loginForm.vue";
import SignUpForm from "@/Components/signupForm.vue";
import Logo from "@/Components/ApplicationLogo.vue"

const showLoginForm = ref(false);
const showSignupForm = ref(false);
const currentModal = ref(null);

const openDialog = (form) => {
    if (form === "login") {
        showLoginForm.value = true;
        showSignupForm.value = false;
    } else if (form === "signup") {
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
    <div class="flex min-h-screen flex-col items-center justify-items-center lg:justify-between gap-5 xl:px-32 lg:py-16 lg:flex-row lg:px-12 py-10">
        <div class="lg:w-96 sm:w-72 xs:w-52 w-32">
            <Logo />
        </div>

        <div class="flex flex-col items-center lg:items-start gap-10 lg:gap-0">
            <h1 class="mb-12 font-poppins sm:text-6xl text-3xl xs:text-4xl font-extrabold">
                Happening Now.
            </h1>
            <div class="flex lg:w-3/5 w-5/6 flex-col gap-4">
                <h3 class="mb-5 text-left font-openSans sm:text-3xl text-xl font-bold">
                    Join Today.
                </h3>
                <button @click="openDialog('login')"
                    class="h-12 w-full rounded-full border border-gray-600 bg-transparent font-openSans font-bold text-accent">
                    Login
                </button>
                <div class="flex items-center">
                    <hr class="flex-grow border-gray-600" />
                    <span class="px-2 text-gray-500">or</span>
                    <hr class="flex-grow border-gray-600" />
                </div>
                <button @click="openDialog('signup')"
                    class="h-12 w-full rounded-full bg-accent font-openSans font-bold">
                    Create account
                </button>
                <p class="text-xs text-gray-500">
                    By signing up, you agree to the
                    <span class="text-accent">Terms of Service</span> and
                    <span class="text-accent">Privacy Policy</span>, including
                    <span class="text-accent">Cookie Use.</span>
                </p>
            </div>
        </div>

        <dialog ref="currentModal"
            class="min-w-[40%] rounded-xl bg-black p-5 text-white backdrop:bg-white backdrop:bg-opacity-10">
            <div class="flex items-center justify-end justify-items-center">
                <button @click="closeDialog"><font-awesome-icon icon="fa-x" /></button>
            </div>
            <div class="mt-5 size-full overflow-x-hidden overflow-y-visible">
                <LoginForm v-if="showLoginForm" @opensignup="openDialog('signup')" />
                <SignUpForm v-if="showSignupForm" @openlogin="openDialog('login')" />
            </div>
        </dialog>
    </div>
</template>

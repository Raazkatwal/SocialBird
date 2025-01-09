<script setup>
import { Head } from "@inertiajs/vue3";
import { defineEmits, ref } from "vue";

const emit = defineEmits(['openlogin']);

const currentYear = new Date().getFullYear(); // Get the current year
const startYear = 1905; // Starting year
const years = ref([]);
const months = ref([
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
]);
const days = ref([]);
for (let year = currentYear; year >= startYear; year--) {
    years.value.push(year);
}

for (let i = 1; i <= 31; i++) {
    days.value.push(i);
}
</script>

<template>

    <Head title="Create Account" />
    <form action="" class="flex select-none flex-col items-center justify-items-center gap-5 text-2xl w-[40rem] px-12">
        <h1 class="text-3xl font-extrabold uppercase">Create Your Account</h1>
        <input type="text" name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
            placeholder="Name" />
        <input type="email" name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
            placeholder="Email" />
        <input type="password" name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
            placeholder="Password" />
        <div class="w-full">
            <p class="text-lg">Date of birth</p>
            <div class="flex gap-3">
                <select name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white">
                    <option value="" class="bg-black text-white" disabled selected>Year</option>
                    <option v-for="year in years" :key="year" :value="year" class="bg-black text-white">
                        {{ year }}
                    </option>

                </select>
                <select name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white">
                    <option value="" class="bg-black text-white" disabled selected>Month</option>
                    <option v-for="month in months" :key="month" :value="month" class="bg-black text-white">
                        {{ month }}
                    </option>
                </select>
                <select name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white">
                    <option value="" class="bg-black text-white" disabled selected>Day</option>
                    <option v-for="day in days" :key="day" :value="day" class="bg-black text-white">
                        {{ day }}
                    </option>
                </select>
            </div>
        </div>
        <button class="h-12 w-1/2 rounded-full bg-white font-openSans font-bold text-[#30353A] text-lg">
            Next
        </button>
        <p class="text-lg">
            Already have a account ?
            <a href="#" @click.prevent="emit('openlogin')" class="text-accent">
                Login
            </a>
        </p>
    </form>
</template>

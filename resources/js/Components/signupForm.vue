<script setup>
import { Head, useForm } from "@inertiajs/vue3";
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

const form = useForm({
    name: null,
    email: null,
    password: null,
    day: '',
    month: '',
    year: '',
})

function submit() {
    form.post(route('signup'));
}
</script>

<template>

    <Head title="Create Account" />
    <form @submit.prevent="submit"
        class="flex select-none flex-col items-center justify-items-center gap-5 text-2xl md:w-[40rem] md:px-12 px-2">
        <h1 class="text-3xl font-extrabold uppercase">Create Your Account</h1>

        <div class="w-full">
            <input type="text" name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
                placeholder="Username" v-model="form.name" required />
            <span v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</span>
        </div>

        <div class="w-full">
            <input type="email" name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
                placeholder="Email" v-model="form.email" required />
            <span v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</span>
        </div>

        <div class="w-full">
            <input type="password" name="" class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
                placeholder="Password" v-model="form.password" required />
            <span v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</span>
        </div>

        <div class="w-full">
            <p class="text-lg">Date of birth</p>

            <div class="flex gap-3 flex-col md:flex-row">

                <select class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white" v-model="form.day"
                    required>
                    <option value="" class="bg-black text-white" disabled>Day</option>
                    <option v-for="day in days" :key="day" :value="day" class="bg-black text-white">
                        {{ day }}
                    </option>
                </select>

                <select class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white"
                    v-model="form.month" required>
                    <option value="" class="bg-black text-white" disabled>Month</option>
                    <option v-for="month in months" :key="month" :value="month" class="bg-black text-white">
                        {{ month }}
                    </option>
                </select>

                <select class="h-14 w-full rounded-md bg-transparent text-lg font-medium text-white" v-model="form.year"
                    required>
                    <option value="" class="bg-black text-white" disabled>Year</option>
                    <option v-for="year in years" :key="year" :value="year" class="bg-black text-white">
                        {{ year }}
                    </option>
                </select>

            </div>
        </div>

        <button class="h-12 w-1/2 rounded-full bg-white font-openSans font-bold text-[#30353A] text-lg" type="submit">
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

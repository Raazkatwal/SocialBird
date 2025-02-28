<script setup>
import { Link } from "@inertiajs/vue3";
import { House, Compass, Inbox, Bookmark, Users, Settings, User, Ellipsis } from 'lucide-vue-next';
import Logo from "@/Components/ApplicationLogo.vue";
</script>
<template>
    <aside class="flex h-[100vh] flex-col justify-between p-5">
        <!-- <svg viewBox="0 0 128 128" height="30">
            <path
                d="M75.916 54.2 122.542 0h-11.05L71.008 47.06 38.672 0H1.376l48.898 71.164L1.376 128h11.05L55.18 78.303 89.328 128h37.296L75.913 54.2ZM60.782 71.79l-4.955-7.086-39.42-56.386h16.972L65.19 53.824l4.954 7.086 41.353 59.15h-16.97L60.782 71.793Z"
                fill="#fff" style="stroke-width:.104373"></path>
        </svg> -->
        <nav class="flex flex-col justify-items-center gap-2 text-lg">
            <Logo :width="200" :height="70"/>
            <Link class="sidebar-links">
            <House /> Home</Link>
            <Link class="sidebar-links">
            <Compass /> Explore</Link>
            <Link class="sidebar-links">
            <Inbox /> Inbox</Link>
            <Link class="sidebar-links">
            <Bookmark />
            Bookmarks</Link>
            <Link class="sidebar-links">
            <Users /> Connect</Link>
            <Link class="sidebar-links">
            <Settings /> Settings</Link>
            <Link class="sidebar-links">
            <User /> Profile</Link>
            <Link class="sidebar-links">
            <Ellipsis /> More</Link>
        </nav>
        <div>
            <!-- <span>
                <font-awesome-icon icon="fa-square-caret-left" class="text-xl" />
            </span> -->
            <button class="w-full rounded-full bg-emerald-500 px-5 py-3 text-black">
                Post
            </button>
        </div>
    </aside>
</template>

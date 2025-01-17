<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import dayjs from "dayjs";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({ user: Object, posts: Object });

const allPosts = ref(props.posts.data);
const currentPage = ref(props.posts.current_page);
const totalPages = ref(props.posts.last_page);
const isLoading = ref(false);
const noMorePosts = ref(false);

const formatDate = (date) => dayjs(date).format("hh:mm A - YYYY/MM/DD");

// Fetch posts on scroll
const fetchMorePosts = async () => {
    if (isLoading.value || currentPage.value >= totalPages.value){
        noMorePosts.value = true;
        return;
    } // Stop if no more posts

    isLoading.value = true;

    try {
        const response = await axios.get(route("posts.load"), {
            params: { page: currentPage.value + 1 },
        });
        
        const { posts, current_page, last_page } = response.data;

        allPosts.value.push(...posts); // Append new posts
        currentPage.value = current_page; // Update current page
        totalPages.value = last_page; // Update total pages
    } catch (error) {
        console.error("Error fetching posts:", error);
    } finally {
        isLoading.value = false;
    }
};

// Add scroll event listener
const handleScroll = () => {
    const section = document.querySelector("section"); // The section with the scrollable posts
    if (
        section.scrollHeight - section.scrollTop <= section.clientHeight + 200 && 
        !isLoading.value
    ) {
        fetchMorePosts();
    }
};

// Lifecycle hooks
onMounted(() => {
    const section = document.querySelector("section"); // The section with the scrollable posts
    section.addEventListener("scroll", handleScroll);
});


</script>


<template>
    <Head title="Home" />
    <main class="grid grid-cols-[20%_55%_25%]">
        <aside class="flex h-[100vh] flex-col justify-between p-5">
            <nav class="flex flex-col justify-items-center gap-5">
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-house" /> Home</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-compass" /> Explore</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-inbox" /> Inbox</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-bookmark" />
                Bookmarks</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-users" /> Connect</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-cog" /> Settings</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-user" /> Profile</Link>
                <Link class="sidebar-links">
                <font-awesome-icon icon="fa-ellipsis" /> More</Link>
            </nav>
            <div>
                <span> <font-awesome-icon icon="fa-square-caret-left" class="text-xl" /> </span>
                <Link :href="route('logout')" method="post" as="button"
                    class="w-full bg-emerald-500 px-5 py-3 text-black">
                Logout
                </Link>
            </div>
        </aside>

        <section class="border-x border-x-gray-800  overflow-x-hidden overflow-y-scroll max-h-[100vh]" id="posts-section">
            <div class="flex justify-between items-center border-b border-b-gray-700">
                <div class="text-center w-full border-r border-b-4 border-b-emerald-500 border-r-gray-700 py-5">For You
                </div>
                <div class="text-center w-full py-5">Following</div>
            </div>
            <div v-for="post in allPosts" :key="post.id"
                class="border-b border-b-gray-700 p-5 flex flex-col gap-5 justify-items-center">
                <div class="flex gap-3 items-center">
                    <div class="size-10 rounded-full bg-emerald-700 grid place-items-center">
                        {{ post.user.username.charAt(0).toUpperCase() }}
                    </div>
                    <h1 class="font-bold text-lg">{{ post.user.username }}</h1>
                </div>
                <p>
                    {{ post.content }}
                </p>
                <span class="text-gray-600 text-sm">
                    {{ formatDate(post.created_at) }}
                </span>
            </div>

            <div v-if="isLoading" class="text-center p-5">
                Loading more posts...
            </div>
            <div v-if="noMorePosts" class="text-center p-5 text-red-500">
                No more posts available
            </div>
        </section>

        <section class="p-5">
            <h1 class="font-bold">{{ user.username }}</h1>
        </section>
    </main>

</template>

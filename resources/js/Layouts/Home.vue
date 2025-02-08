<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { Head, Link } from "@inertiajs/vue3";
import sidebar from "@/Components/SideBar.vue";
import Post from "@/Components/Post.vue";

const props = defineProps({ user: Object, posts: Object });

const allPosts = ref(props.posts.data);
const currentPage = ref(props.posts.current_page);
const totalPages = ref(props.posts.last_page);
const isLoading = ref(false);
const noMorePosts = ref(false);


// Fetch posts on scroll
const fetchMorePosts = async () => {
    if (isLoading.value || currentPage.value >= totalPages.value) {
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
        section.scrollHeight - section.scrollTop <=
        section.clientHeight + 200 &&
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
        
        <sidebar />

        <section class="max-h-[100vh] overflow-x-hidden overflow-y-scroll border-x border-x-gray-800"
            id="posts-section">
            <div class="static top-96 flex items-center justify-between border-b border-b-gray-700">
                <div class="w-full border-b-4 border-r border-b-emerald-500 border-r-gray-700 py-5 text-center">
                    For You
                </div>
                <div class="w-full py-5 text-center">Following</div>
            </div>

            <Post :posts="allPosts" />
            
            <div v-if="isLoading" class="p-5 text-center">
                Loading more posts...
            </div>
            <div v-if="noMorePosts" class="p-5 text-center text-red-500">
                No more posts available
            </div>
        </section>

        <section class="p-5 flex flex-col gap-5">
            <!-- userinfo -->
            <div class="rounded-full w-full flex items-center border border-gray-500 p-2 gap-2">
                <div class="row-span-2 grid size-10 place-items-center rounded-full bg-emerald-700">
                    {{ user.username.charAt(0).toUpperCase() }}
                </div>
                <div class="flex flex-col">
                    <p class="font-bold text-lg">{{ user.username }}</p>
                    <p class="text-sm text-gray-500">@{{ user.username }}</p>
                </div>
            </div>
            <Link :href="route('logout')" method="post" as="button"
                class="w-full rounded-full bg-emerald-500 px-5 py-3 text-black">
            Logout </Link>
            <!-- search bar -->
            <div>
                <input type="text" placeholder="Search..."
                    class="w-full rounded-full bg-transparent focus-within:border-transparent focus-within:ring-accent" />
            </div>
            <!-- trending  -->
            <div class="border border-gray-500 rounded-xl p-2">
                <h1 class="font-bold">Trends for you</h1>
            </div>
        </section>
    </main>
</template>

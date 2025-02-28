<script setup>
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import { Bookmark, Heart, MessageCircle, Repeat2, Share2 } from "lucide-vue-next";
import { inject, onUpdated, ref } from "vue";

const user = inject('user');


dayjs.extend(relativeTime);
const props = defineProps({ posts: Object });


const formatDate = (date) => dayjs(date).fromNow();

const toggleLike = async (postId) => {
    try {
        const response = await axios.post(route("posts.like", postId));            
        const post = props.posts.find(p => p.id === postId);
        if (post) {
            post.total_likes = response.data.likes_count;
            user.liked_posts = response.data.liked_posts;
        }
    } catch (error) {
        console.error("Error liking post:", error);
    }
};
</script>

<template>
    <div v-for="post in posts" :key="post.id"
        class="grid select-none grid-cols-[5%_95%] justify-items-center gap-5 border-b border-b-gray-700 p-5">
        <div class="row-span-2 grid size-10 place-items-center rounded-full bg-accent text-black">
            {{ post.user.username.charAt(0).toUpperCase() }}
        </div>
        <div class="flex w-full flex-col">
            <div>
                <h1 class="text-left text-lg font-bold">
                    {{ post.user.username }}
                </h1>
                <span class="text-sm text-gray-600">
                    {{ formatDate(post.created_at) }}
                </span>
            </div>
            <p>{{ post.caption }}</p>
        </div>
        <div class="max-w-[95%]">
            <p class="text-left">
                {{ post.content }}
            </p>
        </div>
        <div class="col-span-2 flex w-full justify-around">
            <div
                class="duration-400 grid size-8 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-accent">
                <MessageCircle :size="20" />
            </div>
            <div
                class="duration-400 grid size-8 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-violet-500">
                <Repeat2 :size="20" />
            </div>
            <div class="flex gap-1 items-center">
                <div @click="toggleLike(post.id)"
                    class="duration-400 grid size-8 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-red-500">
                    <Heart :size="20" :class="user.liked_posts.map(p=>{return p.id === post.id ? 'fill-red-500 text-red-500' : ''}) "/>
                </div>
                {{ post.total_likes }}
            </div>
            <div
                class="duration-400 grid size-8 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-yellow-500">
                <Bookmark :size="20" />
            </div>
            <div
                class="duration-400 grid size-8 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-blue-500">
                <Share2 :size="20" />
            </div>
        </div>
    </div>
</template>

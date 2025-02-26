<script setup>
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);
defineProps({ posts: Object });
const formatDate = (date) => dayjs(date).fromNow();
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
                <span class="text-xs text-gray-600">
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
                class="duration-400 grid size-7 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-accent">
                <font-awesome-icon :icon="['far', 'comment']" />
            </div>
            <div
                class="duration-400 grid size-7 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-violet-500">
                <font-awesome-icon icon="fa-retweet" />
            </div>
            <div class="flex gap-1 items-center" @click="post.total_likes++">
                <div
                    class="duration-400 grid size-7 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-red-500">
                    <font-awesome-icon :icon="['far', 'heart']" />
                </div>{{ post.total_likes }}
            </div>
            <div
                class="duration-400 grid size-7 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-yellow-500">
                <font-awesome-icon :icon="['far', 'bookmark']" />
            </div>
            <div
                class="duration-400 grid size-7 place-items-center rounded-full transition-all ease-in-out hover:cursor-pointer hover:bg-gray-900 hover:text-blue-500">
                <font-awesome-icon icon="fa-share-alt" />
            </div>
        </div>
    </div>
</template>

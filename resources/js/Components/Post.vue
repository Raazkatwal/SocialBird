<script setup>
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);
defineProps({ posts: Object });
const formatDate = (date) => dayjs(date).fromNow();
</script>

<template>
    <div v-for="post in posts" :key="post.id"
        class="grid grid-cols-[5%_95%] justify-items-center gap-5 border-b border-b-gray-700 p-5">
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
        <div class="flex justify-around w-full col-span-2">
            <font-awesome-icon :icon="['far', 'comment']" />
            <font-awesome-icon icon="fa-retweet" />
            <font-awesome-icon :icon="['far', 'heart']" />
            <font-awesome-icon :icon="['far', 'bookmark']" />
            <font-awesome-icon :icon="['far', 'sharesquare']" />
            <font-awesome-icon icon="fa-share-alt" />
        </div>
    </div>
</template>
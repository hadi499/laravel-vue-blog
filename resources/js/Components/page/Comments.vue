<template>

    <div v-for="comment in comments" class="mb-2 border p-3">
        <div class="flex gap-3 items-stretch">
            <img class="w-10 h-10 rounded-full"
                src="https://cdn.cloudflare.steamstatic.com/steamcommunity/public/images/avatars/91/91a09746173fa3251cd6c1cce849d77d8444f816_full.jpg"
                alt="">
            <div>
                <div class="flex gap-2 items-baseline">
                    <div class="font-semibold">{{ comment.user.name }}</div>
                    <div class="text-sm text-slate-500">{{ comment.created_at }}</div>

                </div>
                <div class="text-lg ">{{ comment.body }}</div>

            </div>
        </div>

    </div>
</template>

<script setup>

const props = defineProps({
    comments: Object
});

</script>
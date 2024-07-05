<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    posts: Object,
})


</script>

<template>

    <Head title="Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-3 flex justify-end">
                    <Link href="/posts/create" class=" px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white
                        rounded-md
            ">New Post</Link>
            </div>


                <div class="flex justify-start gap-3">
                    <!-- <pre>{{ posts }}</pre> -->
                    <div v-for="post in posts.data" key="post.id">
                        <div class="border-2 border-gray-400">
                            <Link :href="`/posts/${post.slug}`">
                            <div v-if="post.image == null">
                                <img src="../../Components/image/no-image.jpg" alt="No image available"
                                    class="w-60 h-52" />
                            </div>
                            <div v-else>
                                <img :src="post.image_url + '/' + post.image" class="w-60 h-52" />
                            </div>
                            <Link :href="`/categories/${post.category.slug}`">
                            <div class="text-blue-700 text-lg mt-3 ml-2">#{{ post.category.name }}</div>

                            </Link>


                            <div class="ml-2 text-xl mb-3">
                                {{ post.title }}

                            </div>

                            </Link>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

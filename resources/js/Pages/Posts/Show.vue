<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    post: Object,
    category: Object
});
const deletePost = (id) => {
    if (confirm('Are you sure you want to delete this post?')) {
        Inertia.delete(route('posts.destroy', id), {
            onSuccess: () => {
                // Logika setelah berhasil menghapus post
                console.log('Post has been deleted!');
            }
        });
    }
};

</script>

<template>

    <Head title="Detail Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Post</h2>
        </template>
 
     

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-[500px] mx-auto">
                    <div v-if="post.image == null">
                        <img src="../../Components/image/no-image.jpg" alt="No image available"  />
                    </div>
                    <div v-else>
                        <img :src="post.image_url" class="h-[300px]" alt="">

                    </div>
                    <div >
                        <h5 class="text-2xl font-semibold mt-2">{{ post.title }}</h5>
                       
                        <Link :href="`/categories/${category.slug}`">
                            <div class="text-blue-700">#{{ category.name }}</div>
                        
                        </Link>
                        <div class="my-3 prose max-w-none" v-html="post.body"></div>
                        <!-- <p class="">{{ post.body }}</p> -->
                        <div class="flex gap-5 mt-3" v-if="$page.props.auth.user.id == post.user_id">

                            <Link :href="`/posts/${post.slug}/edit`" class="px-2 bg-blue-400 rounded-md hover:bg-blue-800 hover:text-white">edit</Link>
                            <!-- <Link :href="route('posts.destroy', post.id)" method="delete" as="button" type="button"
                                class="px-2 bg-red-500 hover:text-red-700 mr-2">Delete</Link> -->
                                <button @click="deletePost(post.id)" class="px-2 bg-red-400 rounded-md hover:bg-red-800 hover:text-white">Delete Post</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

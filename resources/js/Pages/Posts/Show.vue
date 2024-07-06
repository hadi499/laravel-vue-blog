<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue'
import TextAreaInput from '@/Components/TextArea.vue'
import InputError from '@/Components/InputError.vue'



const props = defineProps({
    post: Object,  
    comments: Object
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

const form = useForm({
    body: "",
    post_id: props.post.id



})

const submit = () => {
    form.post(route("comments.store"), {
        onSuccess: () => {
            form.reset('body', 'post_id');
        },

    });
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
                <div class="w-[700px] mx-auto" >
                    <div v-if="post.image == null">
                        <img src="../../Components/image/no-image.jpg" alt="No image available" />
                    </div>
                    <div v-else>
                        <img :src="post.image_url" class="w-full" alt="">

                    </div>
                    <div>
                        <h5 class="text-2xl font-semibold mt-2">{{ post.title }}</h5>
                        <Link :href="`/categories/${post.category.slug}`">
                            <div class="text-blue-700">#{{ post.category.name }}</div>                            
                        </Link>
                        <div class="flex items-baseline gap-2">
                            <div class="font-semibold">@{{ post.user.name }}</div>
                            <div class="text-slate-500 text-sm">{{ post.created_at }}</div>

                        </div>
                        <div class="my-3 prose max-w-none" v-html="post.body"></div>
                        <!-- <p class="">{{ post.body }}</p> -->
                        <div class="flex gap-5 mt-3" v-if="$page.props.auth.user.id == post.user_id">

                            <Link :href="`/posts/${post.slug}/edit`"
                                class="px-2 bg-blue-400 rounded-md hover:bg-blue-800 hover:text-white">edit</Link>
                            <!-- <Link :href="route('posts.destroy', post.id)" method="delete" as="button" type="button"
                                class="px-2 bg-red-500 hover:text-red-700 mr-2">Delete</Link> -->
                            <button @click="deletePost(post.id)"
                                class="px-2 bg-red-400 rounded-md hover:bg-red-800 hover:text-white">Delete
                                Post</button>
                        </div>
                        <div class="mt-5">
                            <form class="flex mt-2 flex-col gap-3 border-2 p-3" @submit.prevent="submit">
                                <div class="flex flex-col gap-2">
                                    <input type="hidden" name="post_id" v-model="form.post_id">
                                    <TextAreaInput class="w-full" rows="3" placeholder="Your comment..." id="body"
                                        type="text" v-model="form.body" />
                                    <InputError :message="form.errors.body" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <Button class="ml-4" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Comment
                                    </Button>
                                </div>
                            </form>
                        </div>
                        <div class="mt-4">
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

                        </div>

                    </div>
                </div>



            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue'
import TextAreaInput from '@/Components/TextArea.vue'
import InputError from '@/Components/InputError.vue'
import FormComment from '@/Components/page/FormComment.vue'
import CommentLists from '@/Components/page/Comments.vue'



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

// const submit = () => {
//     form.post(route("comments.store"), {
//         onSuccess: () => {
//             form.reset('body', 'post_id');
//         },

//     });
// };

</script>

<template>

    <Head title="Detail Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Post</h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-[700px] mx-auto">
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

                        <div class="flex gap-5 mt-3" v-if="$page.props.auth.user.id == post.user_id">

                            <Link :href="`/posts/${post.slug}/edit`"
                                class="px-2 bg-blue-400 rounded-md hover:bg-blue-800 hover:text-white">edit</Link>

                            <button @click="deletePost(post.id)"
                                class="px-2 bg-red-400 rounded-md hover:bg-red-800 hover:text-white">Delete
                                Post</button>
                        </div>
                        <div class="mt-5">
                            <FormComment />
                        </div>
                        <div class="mt-4">
                            <CommentLists :comments="comments" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

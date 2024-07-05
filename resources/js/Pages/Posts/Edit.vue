<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue'
import TextAreaInput from '@/Components/TextArea.vue'
import { Inertia } from "@inertiajs/inertia";
import Editor from '@/Components/Editor.vue'

const props = defineProps({
  categories: Array,
  post: Object,

})

const form = useForm({
  title: props.post?.title,
  slug:  props.post?.slug,
  image: null, 
  oldImage: props.post?.image,
  category_id:  props.post?.category_id,
  body:  props.post?.body,
})

const submit = () => {
  Inertia.post(`/posts/${props.post.slug}/edit`, {
    _method: "put",
    title: form.title,
    slug: form.slug,
    image: form.image,
    oldImage: form.oldImage,   
    category_id: form.category_id,
    body: form.body,
  });
}



</script>

<template>
  <Head title="Edit Post" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Post</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form class="p-4 bg-white flex flex-col gap-3 w-[600px]" @submit.prevent="submit">
          <div class="flex flex-col gap-2">
            <InputLabel for="title" value="Title" />
            <Input class="w-full" id="title" type="text" v-model="form.title" />
          </div>
          <div class="flex flex-col gap-2">
            <InputLabel for="slug" value="Slug" />
            <Input class="w-full" id="slug" type="text" v-model="form.slug" />
          </div>
          <div class="flex flex-col gap-2">
            <InputLabel for="image" value="Image" />
            <input type="hidden" name="oldImage" v-model="form.oldImage">
            <Input id="image" type="file" @input="form.image = $event.target.files[0]" />
          </div>
          <div>
            <InputLabel for="category_id" value="Category" />
            <select v-model="form.category_id" id="category_id" name="category_id" class="
                mt-1
                block
                w-full
                pl-3
                pr-10
                py-2
                text-base
                border-gray-300
                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
                sm:text-sm
                rounded-md
              ">
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
          <div class="flex flex-col gap-2">
            <InputLabel for="body" value="Body" />
            <!-- <TextAreaInput class="w-full" rows="8" id="body" type="text" v-model="form.body" /> -->
            <Editor v-model="form.body" />
          </div>
          <div class="flex items-center justify-end mt-4">
            <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Edit
            </Button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

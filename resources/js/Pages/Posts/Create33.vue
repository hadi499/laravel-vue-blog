<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue'

defineProps({
  categories: Array,
})

const form = useForm({
  title: "",
  slug: "",
  image: null,
  category_id: "",
  body: "",
})

const submit = () => {
  form.post(route("posts.store"), {
    onSuccess: () => {
      form.reset();
    }
  });
};
</script>

<template>
  <Head title="Create Post" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form class="p-4 bg-white flex flex-col gap-3 w-[600px]" @submit.prevent="submit">
          <div class="flex flex-col gap-2">
            <InputLabel for="title" value="Title" />
            <Input class="w-full" id="title" type="text" v-model="form.title" required />
          </div>
          <div class="flex flex-col gap-2">
            <InputLabel for="slug" value="Slug" />
            <Input class="w-full" id="slug" type="text" v-model="form.slug" required />
          </div>
          <div class="flex flex-col gap-2">
            <InputLabel for="image" value="Image" />
            <Input id="image" type="file" @change="e => form.image = e.target.files[0]" required />
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
              " required>
              <option value="" disabled>Select a category</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
          <div class="flex flex-col gap-2">
            <InputLabel for="body" value="Body" />
            <textarea id="body" v-model="form.body" class="w-full" required></textarea>
          </div>
          <div class="flex items-center justify-end mt-4">
            <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Create
            </Button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

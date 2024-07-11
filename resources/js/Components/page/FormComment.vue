<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { ref, nextTick } from 'vue';
import InputLabel from '@/Components/InputLabel.vue'

import Button from '@/Components/Button.vue'
import TextAreaInput from '@/Components/TextArea.vue'
import InputError from '@/Components/InputError.vue'

const commentFormRef = ref(null);

defineProps({
  post: Object,

});
const page = usePage()
const form = useForm({
  body: "",
  post_id: null,


})



const submit = () => {
  form.post_id = page.props.post.id
  form.post(route("comments.store"), {
    onSuccess: () => {
      form.reset()
      nextTick(() => {
        commentFormRef.value.scrollIntoView({ behavior: 'smooth' });
      });

    },

  });
};




</script>

<template>
  <div class="flex justify-center mt-3">
    <form ref="commentFormRef" class="p-4 flex flex-col gap-3 w-full border" @submit.prevent="submit">


      <div class="flex flex-col gap-2">
        <input type="hidden" name="post_id" value="post.id">
        <TextAreaInput class="w-full" rows="3" placeholder="Your comment..." id="body" type="text"
          v-model="form.body" />

        <InputError :message="form.errors.body" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Comment
        </Button>
      </div>
    </form>
  </div>

</template>
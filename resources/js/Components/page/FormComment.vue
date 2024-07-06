<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'

import Button from '@/Components/Button.vue'
import TextAreaInput from '@/Components/TextArea.vue'
import InputError from '@/Components/InputError.vue'

defineProps({
    post: Object,
   
});

const form = useForm({ 
  body: "",

  
})

const submit = () => {
  form.post(route("comments.store"), {
    onSuccess: () => {
      // Perform any additional actions after success
    },
    onFinish: () => {
      form.reset('body');
      // Optionally, you can redirect to another page here if needed
    }
  });
};




</script>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center mt-3">
        <form class="p-4 flex flex-col gap-3 w-[600px]" @submit.prevent="submit">
       
          
          <div class="flex flex-col gap-2">
            <input type="hidden" name="post_id" value="post.id" >
            <TextAreaInput class="w-full" rows="3" placeholder="Your comment..." id="body" type="text" v-model="form.body" />
           
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
<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  title: '',
  date: '',
});

const submit = () => {
  // dynamicaly post to update or store rout
  form.post(route('bookings.store'), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>
<template>
  <Head title="Create Booking" />

  <AuthenticatedLayout>
    <div class="flex flex-col min-h-screen items-center justify-center bg-white">
      <h1 class="text-center mb-5 font-bold text-xl uppercase">book</h1>
      <div
        class="grid grid-cols-1 gap-3 items-center mx-auto max-w-md"
        style="width: 80vw"
      >
        <form @submit.prevent="submit">
          <div>
            <InputLabel for="title" value="Title" />

            <TextInput
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              required
              autofocus
            />

            <InputError class="mt-2" :message="form.errors.title" />
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Password" />

            <TextInput
              id="date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.date"
              required
            />

            <InputError class="mt-2" :message="form.errors.password" />
          </div>
          <PrimaryButton
            class="ms-4 mt-4 ml-auto"
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Book
          </PrimaryButton>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref, computed } from 'vue';

const { props } = usePage();
const prop = defineProps<{
  bookings: {
    id: number;
    title: string;
    date: string;
  }[];
}>();

const success = ref(props.flash.success);
const form = useForm({});
const bookings = ref(prop.bookings);
const search = ref('');

const form2 = useForm({
  start: new Date().toISOString().split('T')[0],
  end: '',
});

const form3 = useForm({});

const handleDeletion = (id: number) => {
  if (confirm('Are you sure you want to delete this booking?')) {
    // a delete request
    form.delete(route('bookings.destroy', id), {
      onSuccess: () => {
        bookings.value = bookings.value.filter((booking) => booking.id !== id);
      },
    });
  }
};

const handleDateFilter = () => {
  // filter bookings by date
  form2.get('/dashboard?start=' + form2.start + '&end=' + form2.end);
};

const filterBookings = computed(() => {
  if (search.value === '') {
    return bookings.value;
  } else {
    return bookings.value.filter((booking) => {
      return booking.title.toLowerCase().includes(search.value.toLowerCase());
    });
  }
});

onMounted(() => {
  setTimeout(() => {
    success.value = '';
  }, 2000);
});
</script>

<template>
  <Head title="Dashboard" />

  <div v-if="success" class="mb-4 font-medium text-sm text-green-600 ml-auto">
    {{ success }}
  </div>
  <AuthenticatedLayout>
    <!-- Table of bookings with fields title firstname email date and actions reschedule and cancel -->
    <div class="flex flex-col min-h-screen items-center justify-center bg-white">
      <h1 class="my-16 text-2xl font-bold">My Bookings</h1>

      <!-- search input -->
      <div class="flex flex-col gap-5">
        <div class="flex gap-5 justify-center">
          <input
            type="search"
            v-model="search"
            name="search"
            id="search"
            placeholder="Search for a booking"
            class="rounded-xl focus:border-blue-500"
          />

          <!-- all button -->
          <button
            @click.prevent="form3.get(route('dashboard'))"
            class="font-semibold hover:text-blue-500"
          >
            All
          </button>
        </div>

        <form @submit.prevent="handleDateFilter">
          <h1 class="text-center font-semibold">Filter</h1>
          <label for="start">
            Start date:
            <input type="date" name="start" v-model="form2.start" required />
          </label>
          <label for="end">
            End date:
            <input type="date" :min="form2.start" v-model="form2.end" required />
          </label>
          <button type="submit" class="bg-blue-500 text-white rounded-xl px-3 py-2 ml-4">
            Filter
          </button>
        </form>
      </div>

      <div class="p-6 overflow-scroll px-0">
        <table class="w-full min-w-max table-auto text-left">
          <thead>
            <tr>
              <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                <p
                  class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70"
                >
                  firstname
                </p>
              </th>
              <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                <p
                  class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70"
                >
                  Title
                </p>
              </th>
              <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                <p
                  class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70"
                >
                  Date
                </p>
              </th>
              <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                <p
                  class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70"
                >
                  Email
                </p>
              </th>
              <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                <p
                  class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70"
                >
                  Edit
                </p>
              </th>
              <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4">
                <p
                  class="block antialiased font-sans text-sm text-blue-gray-900 font-normal leading-none opacity-70"
                >
                  Delete
                </p>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in filterBookings" :key="booking.id">
              <td class="p-4 border-b border-blue-gray-50">
                <div class="flex items-center gap-3">
                  <img
                    src="https://docs.material-tailwind.com/img/logos/logo-spotify.svg"
                    alt="Spotify"
                    class="inline-block relative object-center rounded-full w-12 h-12 border border-blue-gray-50 bg-blue-gray-50/50 object-contain p-1"
                  />
                  <p
                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold"
                  >
                    {{ $page.props.auth.user.name }}
                  </p>
                </div>
              </td>
              <td class="p-4 border-b border-blue-gray-50">
                <p
                  class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal"
                >
                  {{ booking.title }}
                </p>
              </td>
              <td class="p-4 border-b border-blue-gray-50">
                <p
                  class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal"
                >
                  {{ new Date(booking.date).toDateString() }}
                </p>
              </td>
              <td class="p-4 border-b border-blue-gray-50">
                {{ $page.props.auth.user.email }}
              </td>
              <td class="p-4 border-b border-blue-gray-50">
                <Link
                  class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                  type="button"
                  :href="route('bookings.edit', booking.id)"
                >
                  <span
                    class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      aria-hidden="true"
                      class="h-4 w-4"
                    >
                      <path
                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"
                      ></path>
                    </svg>
                  </span>
                </Link>
              </td>
              <td class="p-4 border border-blue-gray-50">
                <!-- Delete form -->
                <form
                  @submit.prevent="handleDeletion(booking.id)"
                  class="flex items-center justify-center"
                >
                  <button
                    type="submit"
                    class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      height="24px"
                      viewBox="0 -960 960 960"
                      width="24px"
                      fill="red"
                    >
                      <path
                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"
                      />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

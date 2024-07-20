<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <!-- Table of bookings with fields title firstname email date and actions reschedule and cancel -->
    <div class="flex flex-col min-h-screen items-center justify-center bg-white">
      <h1>My Bookings</h1>

      <!-- search input -->
      <input
        type="search"
        name="search"
        id="search"
        class="rounded-xl focus:border-blue-500"
      />

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
            <tr>
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
                    John
                  </p>
                </div>
              </td>
              <td class="p-4 border-b border-blue-gray-50">
                <p
                  class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal"
                >
                  This is a title
                </p>
              </td>
              <td class="p-4 border-b border-blue-gray-50">
                <p
                  class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal"
                >
                  Wed 3:00pm
                </p>
              </td>
              <td class="p-4 border-b border-blue-gray-50">email@email.com</td>
              <td class="p-4 border-b border-blue-gray-50">
                <button
                  class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                  type="button"
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
                </button>
              </td>
              <td class="p-4 border border-blue-gray-50">
                <button
                  class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                  type="button"
                >
                  <!-- delete icon -->
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
                        d="M3 6a1 1 0 011-1h16a1 1 0 011 1v1h2v2h-1v11a3 3 0 01-3 3H6a3 3 0 01-3-3V9H2V7h1V6zm2 2v11a1 1 0 001 1h14a1 1 0 001-1V8H5zm5 2v7a1 1 0 002 0V10a1 1 0 00-2 0zm4 0v7a1 1 0 002 0V10a1 1 0 00-2 0z"
                      ></path>
                    </svg>
                  </span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

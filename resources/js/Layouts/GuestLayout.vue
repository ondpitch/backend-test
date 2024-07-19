<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div
      class="h-screen content-center w-full mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>

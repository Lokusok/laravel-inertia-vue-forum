<template>
    <MainLayout>
        <div class="flex items-center">
            <h3 class="mr-4 text-xl">Разделы</h3>
            <Link
                :href="route('sections.create')"
                class="block w-8 px-2 py-1 text-center bg-white border border-gray-300 rounded-lg hover:bg-gray-100 active:bg-gray-200"
            >
                +
            </Link>
        </div>
    </MainLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import MainLayout from "../../Layouts/MainLayout.vue";
</script>

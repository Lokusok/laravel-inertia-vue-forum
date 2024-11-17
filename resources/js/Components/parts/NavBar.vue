<template>
    <div class="w-1/2 mx-auto max-w-[1170px]">
        <Link
            :href="route('sections.index')"
            class="mr-4 text-blue-500 hover:underline active:opacity-70"
        >
            Форум
        </Link>

        <Link
            :href="route('users.personal')"
            class="mr-4 text-blue-500 hover:underline active:opacity-70"
        >
            Личный кабинет
        </Link>

        <Link
            :href="route('admin.main.index')"
            class="text-blue-500 hover:underline active:opacity-70"
        >
            Админ-панель
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

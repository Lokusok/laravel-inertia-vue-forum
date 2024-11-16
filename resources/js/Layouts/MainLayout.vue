<template>
    <div>
        <div class="py-4 bg-white border-b border-b-gray-300">
            <div class="w-1/2 mx-auto max-w-[1170px]">
                <Link
                    :href="route('sections.index')"
                    class="mr-4 text-blue-500 hover:underline active:opacity-70"
                >
                    Форум
                </Link>

                <Link
                    :href="route('users.personal')"
                    class="text-blue-500 hover:underline active:opacity-70"
                >
                    Личный кабинет
                </Link>
            </div>
        </div>

        <div class="w-1/2 py-4 mx-auto max-w-[1170px]">
            <slot />
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
        <div class="py-4 bg-white border-b border-b-gray-300">
            <NavBar />
        </div>

        <div class="w-1/2 py-4 flex mx-auto max-w-[1170px]">
            <div class="w-1/4 p-4 mr-4 bg-white border border-gray-300">
                <h3 class="mb-4 text-xl">Меню</h3>

                <div class="flex flex-col gap-y-2">
                    <div>
                        <Link
                            :href="route('admin.main.index')"
                            class="mr-4 text-blue-500 hover:underline active:opacity-70"
                        >
                            Статистика
                        </Link>
                    </div>

                    <div>
                        <Link
                            :href="route('admin.complaints.index')"
                            class="mr-4 text-blue-500 hover:underline active:opacity-70"
                        >
                            Жалобы
                        </Link>
                    </div>

                    <div>
                        <Link
                            :href="route('admin.roles.index')"
                            class="mr-4 text-blue-500 hover:underline active:opacity-70"
                        >
                            Роли
                        </Link>
                    </div>

                    <div>
                        <Link
                            :href="route('admin.users.index')"
                            class="mr-4 text-blue-500 hover:underline active:opacity-70"
                        >
                            Пользователи
                        </Link>
                    </div>
                </div>
            </div>

            <div class="w-3/4 p-4 bg-white border border-gray-300">
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import NavBar from "@/Components/parts/NavBar.vue";
</script>

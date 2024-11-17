<template>
    <AdminLayout>
        <div class="mb-4">
            <h3 class="mr-4 text-xl">Жалобы</h3>
        </div>

        <div>
            <div class="border border-gray-200 rounded-lg">
                <table class="w-full text-sm text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2">ID</th>
                            <th class="p-2">Текст</th>
                            <th class="p-2">Пользователь</th>
                            <th class="p-2">Ссылка (Сообщение)</th>
                            <th class="p-2">Статус</th>
                            <th class="p-2">Действия</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="complaint in props.complaints"
                            class="text-gray-500"
                        >
                            <td class="p-2">{{ complaint.id }}</td>
                            <td class="p-2">{{ complaint.body }}</td>
                            <td class="p-2">{{ complaint.user.name }}</td>
                            <td class="p-2">
                                <Link
                                    :href="
                                        route(
                                            'themes.show',
                                            complaint.theme_id
                                        ) + `#${complaint.message_id}`
                                    "
                                    class="text-blue-500 hover:underline active:opacity-70"
                                >
                                    Ссылка
                                </Link>
                            </td>
                            <td class="p-2">{{ complaint.is_solved }}</td>
                            <td class="p-2">
                                <Link
                                    class="block mx-auto size-6 hover:opacity-80 active:opacity-50"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                        />
                                    </svg>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    complaints: {
        type: Array,
        required: true,
    },
});
</script>

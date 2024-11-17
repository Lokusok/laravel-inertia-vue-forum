<template>
    <Head title="Жалобы" />

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
                            <td class="p-2 whitespace-nowrap">
                                {{
                                    complaint.is_solved ? "Решено" : "В работе"
                                }}
                            </td>
                            <td class="p-2">
                                <button
                                    class="block mx-auto size-6 hover:opacity-80 active:opacity-50"
                                    @click="update(complaint)"
                                >
                                    <CheckIcon
                                        :class="{
                                            'stroke-green-600':
                                                complaint.is_solved,
                                            'stroke-red-600':
                                                !complaint.is_solved,
                                        }"
                                    />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import axios from "axios";
import { Link, Head } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import CheckIcon from "@/Components/icons/CheckIcon.vue";

const props = defineProps({
    complaints: {
        type: Array,
        required: true,
    },
});

const update = async (complaint) => {
    const res = await axios.patch(
        route("admin.complaints.update", complaint.id)
    );

    complaint.is_solved = res.data.is_solved;
};
</script>

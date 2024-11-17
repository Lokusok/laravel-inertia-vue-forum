<template>
    <Head title="Роли" />

    <AdminLayout>
        <div class="flex items-center gap-2 mb-4">
            <h3 class="mr-4 text-xl">Роли</h3>

            <LongButton :href="route('admin.roles.create')" :is-link="true">
                + Роль
            </LongButton>
        </div>

        <div>
            <div class="border border-gray-200 rounded-lg">
                <table class="w-full text-sm text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2">ID</th>
                            <th class="p-2">Название</th>
                            <th class="p-2">Код</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="role in props.roles" class="text-gray-500">
                            <td class="p-2">{{ role.id }}</td>
                            <td class="p-2">{{ role.title }}</td>
                            <td class="p-2">{{ role.code }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LongButton from "@/Components/ui/LongButton.vue";

const props = defineProps({
    roles: {
        type: Array,
        required: true,
    },
});
</script>

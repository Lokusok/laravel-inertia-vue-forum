<template>
    <Head title="Роли" />

    <AdminLayout>
        <div class="flex items-center gap-2 mb-4">
            <h3 class="mr-4 text-xl">Пользователи</h3>

            <LongButton :href="route('admin.roles.create')" :is-link="true">
                + Пользователь
            </LongButton>
        </div>

        <div>
            <div class="border border-gray-200 rounded-lg">
                <table class="w-full text-sm text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2">ID</th>
                            <th class="p-2">Имя</th>
                            <th class="p-2">Роли</th>
                            <th class="p-2">Изменить роль</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="user in props.users" class="text-gray-500">
                            <td class="p-2">{{ user.id }}</td>
                            <td class="p-2">{{ user.name }}</td>
                            <td class="p-2">
                                <div>
                                    <p v-for="role in user.roles" :key="role">
                                        {{ role.code }}
                                    </p>
                                </div>
                            </td>
                            <td class="relative p-2">
                                <button
                                    class="p-2 mb-2 text-sm rounded-sm bg-gray-50 hover:bg-gray-100 active:opacity-70"
                                    @click="handleRoleSelectionClick(user)"
                                >
                                    {{
                                        user.is_role_change
                                            ? "Закрыть"
                                            : "Выбрать"
                                    }}
                                </button>

                                <div
                                    v-if="user.is_role_change"
                                    class="absolute left-0 z-50 p-4 text-left bg-white border border-gray-300"
                                >
                                    <div
                                        v-for="role in props.roles"
                                        :key="role.id"
                                        class="mb-2 cursor-pointer hover:opacity-80 active:opacity-50"
                                    >
                                        <input
                                            :checked="
                                                user.roles.some(
                                                    (r) => r.id === role.id
                                                )
                                            "
                                            :id="`${user.id}_${role.id}`"
                                            type="checkbox"
                                            @change="toggleRole(user, role.id)"
                                        />
                                        <label
                                            :for="`${user.id}_${role.id}`"
                                            class="pl-2 cursor-pointer"
                                        >
                                            {{ role.code }}
                                        </label>
                                    </div>
                                </div>
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
import { Head } from "@inertiajs/vue3";

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LongButton from "@/Components/ui/LongButton.vue";

const props = defineProps({
    users: {
        type: Array,
        required: true,
    },

    roles: {
        type: Array,
        required: true,
    },
});

const toggleRole = async (user, roleId) => {
    const res = await axios.post(route("admin.users.roles.store", user.id), {
        role_id: roleId,
    });

    user.roles = res.data.roles;
};

const handleRoleSelectionClick = (user) => {
    props.users.forEach((u) => {
        if (u.id !== user.id) {
            u.is_role_change = false;
        }
    });

    user.is_role_change = !user.is_role_change;
};
</script>

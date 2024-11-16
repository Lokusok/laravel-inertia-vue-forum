<template>
    <Head title="Личный кабинет" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">Личный кабинет</h3>
        </div>

        <div class="p-4 bg-white border border-gray-300">
            <div class="mb-4">
                <p>Приветствую, {{ user.name }}</p>
            </div>

            <div class="mb-4">
                <p class="mb-2">Сменить аватар</p>

                <button
                    class="w-24 h-24 overflow-hidden bg-gray-300 rounded-full blog hover:opacity-80 active:opacity-50"
                    @click="handleAvatarClick"
                >
                    <img
                        v-if="user.avatar_url"
                        :src="user.avatar_url"
                        :alt="user.name"
                    />
                </button>

                <div hidden>
                    <input
                        ref="avatarLoader"
                        type="file"
                        @change="storeAvatar"
                    />
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { toRefs, useTemplateRef } from "vue";
import { Head } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const { user } = toRefs(props);

const avatarLoaderNodeRef = useTemplateRef("avatarLoader");

const handleAvatarClick = () => {
    avatarLoaderNodeRef.value.click();
};

const storeAvatar = async (e) => {
    const file = e.target.files[0];

    const formData = new FormData();
    formData.append("avatar", file);
    formData.append("_method", "patch");

    const res = await axios.post(route("users.update"), formData);

    user.value.avatar_url = res.data.avatar_url;
};
</script>

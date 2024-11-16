<template>
    <Head title="Просмотр темы" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">
                Просмотр темы | {{ props.theme.title }}
            </h3>
        </div>

        <div v-if="props.theme.messages.length">
            <div
                v-for="message in props.theme.messages"
                :key="message.id"
                class="flex bg-white border border-gray-300"
            >
                <div class="w-2/6 p-4 border-r border-r-gray-300">
                    <div
                        class="w-24 h-24 mx-auto mb-2 overflow-hidden bg-gray-300 rounded-full"
                    >
                        <img
                            v-if="message.user.avatar_url"
                            :src="message.user.avatar_url"
                            :alt="message.user.name"
                            class="w-24 h-24"
                        />
                    </div>

                    <div>
                        <h3 class="text-center">
                            {{ message.user.name }}
                        </h3>
                    </div>
                </div>

                <div class="w-4/6 p-4">
                    <div>
                        <p class="text-sm italic text-gray-700">
                            {{ message.time }}
                        </p>
                    </div>

                    <div>
                        <div class="mb-4">
                            <p v-html="message.content" />
                        </div>

                        <div class="flex items-center justify-end">
                            <div class="flex items-center gap-1">
                                <span>
                                    {{ message.likes }}
                                </span>

                                <button
                                    class="hover:opacity-80 active:opacity-50"
                                    @click="toggleLike(message)"
                                >
                                    <HeartIcon
                                        :class="{
                                            'fill-red-600': message.is_liked,
                                            'stroke-sky-600': !message.is_liked,
                                        }"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border border-gray-300">
            <div class="mb-4">
                <h3 class="text-xl">Добавить сообщение</h3>
            </div>

            <div>
                <div
                    ref="editor"
                    class="w-full p-2 border border-gray-300 rounded-md"
                    contenteditable
                />
            </div>

            <div class="mt-3">
                <button
                    class="px-5 py-2 font-bold text-white bg-orange-700 rounded-lg hover:bg-orange-600 active:bg-orange-500 active:opacity-80 disabled:opacity-60"
                    @click="publish"
                >
                    Опубликовать
                </button>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { useTemplateRef } from "vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";

import MainLayout from "@/Layouts/MainLayout.vue";
import HeartIcon from "@/Components/icons/HeartIcon.vue";

const props = defineProps({
    theme: {
        type: Object,
        required: true,
    },
});

const editorNodeRef = useTemplateRef("editor");

const publish = async () => {
    const res = await axios.post(route("messages.store"), {
        theme_id: props.theme.id,
        content: editorNodeRef.value.innerHTML,
    });

    editorNodeRef.value.innerHTML = "";
};

const toggleLike = async (message) => {
    const res = await axios.post(route("messages.likes.toggle", message.id));

    if (message.is_liked) message.likes--;
    else message.likes++;

    message.is_liked = !message.is_liked;
};
</script>

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
                <div class="w-1/6 p-4 border-r border-r-gray-300">
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

                <div class="flex flex-col justify-between w-5/6 p-4">
                    <div>
                        <div>
                            <p class="text-sm italic text-gray-700">
                                {{ message.time }}
                            </p>
                        </div>

                        <div
                            v-if="message.is_not_solved_complaint"
                            class="my-2"
                        >
                            <div
                                class="flex items-center w-full p-2 bg-red-100 border-red-200 gap-x-2"
                            >
                                <ClockIcon class="size-5" />

                                <p>Ваша жалоба в рассмотрении</p>
                            </div>
                        </div>

                        <div>
                            <p v-html="message.content" />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-x-3">
                            <div
                                class="flex items-center justify-end w-full gap-x-3"
                            >
                                <button
                                    class="inline-block px-3 py-2 text-sm text-center text-white bg-red-600 border border-red-700 rounded-lg hover:bg-red-700 active:bg-red-800"
                                    @click="openComplaint(message)"
                                >
                                    {{
                                        message.is_complaint
                                            ? "Скрыть"
                                            : "Пожаловаться"
                                    }}
                                </button>

                                <button
                                    class="inline-block px-3 py-2 text-sm text-center text-white border rounded-lg bg-sky-600 border-sky-700 hover:bg-sky-700 active:bg-sky-800"
                                    @click="quote(message.content)"
                                >
                                    Цитировать
                                </button>

                                <button
                                    class="inline-block px-3 py-2 text-sm text-center text-white bg-indigo-600 border border-indigo-700 rounded-lg hover:bg-indigo-700 active:bg-indigo-800"
                                    @click="answer(message)"
                                >
                                    Ответить
                                </button>
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
                                                'fill-red-600':
                                                    message.is_liked,
                                                'stroke-sky-600':
                                                    !message.is_liked,
                                            }"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div v-if="message.is_complaint" class="flex mt-2">
                            <input
                                v-model="message.body"
                                class="w-5/6 p-2 border border-gray-300 rounded-lg rounded-r-none"
                                type="text"
                                placeholder="Ваша жалоба"
                            />
                            <button
                                class="block w-1/6 p-2 text-sm text-white bg-red-800 rounded-lg rounded-l-none hover:bg-red-900 active:opacity-70"
                                @click="complaint(message)"
                            >
                                Отправить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border border-gray-300">
            <div class="mb-4">
                <h3 class="text-xl">Добавить сообщение</h3>
            </div>

            <div class="mb-4">
                <div class="w-full p-2 border border-gray-100 bg-gray-50">
                    <div>
                        <button
                            class="w-6 hover:opacity-80 active:opacity-60"
                            @click="handleEditorBarImageClick"
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
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                />
                            </svg>
                        </button>

                        <input
                            hidden
                            ref="commentImageUploader"
                            type="file"
                            @change="storeImage"
                        />
                    </div>
                </div>
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
import ClockIcon from "@/Components/icons/ClockIcon.vue";

const props = defineProps({
    theme: {
        type: Object,
        required: true,
    },
});

const editorNodeRef = useTemplateRef("editor");
const commentImageUploaderNodeRef = useTemplateRef("commentImageUploader");

const handleEditorBarImageClick = () => {
    commentImageUploaderNodeRef.value.click();
};

const publish = async () => {
    const res = await axios.post(route("messages.store"), {
        theme_id: props.theme.id,
        content: editorNodeRef.value.innerHTML,
    });

    editorNodeRef.value.innerHTML = "";

    props.theme.messages.push(res.data);
};

const toggleLike = async (message) => {
    const res = await axios.post(route("messages.likes.toggle", message.id));

    if (message.is_liked) message.likes--;
    else message.likes++;

    message.is_liked = !message.is_liked;
};

const quote = (messageContent) => {
    const selectionContent = window.getSelection().toString();
    const content = selectionContent ? selectionContent : messageContent;

    const editor = editorNodeRef.value;
    const oldText = editor.innerHTML;

    if (oldText) {
        editor.innerHTML = `${oldText}<br><blockquote> ${content} </blockquote><br>`;
    } else {
        editor.innerHTML = `<blockquote> ${content} </blockquote><br>`;
    }
};

const answer = (message) => {
    const title = `<div class="w-full p-2 bg-gray-200 border border-gray-300">Ответ пользователю @${message.user.id} ${message.user.name} ${message.time}</div>`;

    const editor = editorNodeRef.value;
    const oldText = editor.innerHTML;

    if (oldText) {
        editor.innerHTML = `${oldText} ${title}<blockquote> ${message.content} </blockquote><br>`;
    } else {
        editor.innerHTML = `${title}<blockquote> ${message.content} </blockquote><br>`;
    }
};

const openComplaint = (message) => {
    message.body = "";
    message.is_complaint = !message.is_complaint;
};

const complaint = async (message) => {
    const res = await axios.post(
        route("messages.complaints.store", message.id),
        {
            body: message.body,
            theme_id: message.theme_id,
        }
    );

    message.body = "";
    message.is_complaint = false;
    message.is_not_solved_complaint = res.data.is_not_solved_complaint;
};

const storeImage = async (e) => {
    const file = e.target.files[0];

    const formData = new FormData();
    formData.append("image", file);

    const res = await axios.post(route("images.store"), formData);

    const image = `<span hidden>img_id=${res.data.id}</span><img src="${res.data.url}" />`;

    const editor = editorNodeRef.value;
    const oldText = editor.innerHTML;

    editor.innerHTML = `${oldText}<br>${image}<br>`;
};
</script>

<style>
blockquote {
    display: block;
    padding: 4px;
    padding-left: 6px;
    border-left: 4px solid #a0aec0;
    background-color: #f6f6f6;
}
</style>

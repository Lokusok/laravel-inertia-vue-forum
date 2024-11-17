<template>
    <div class="w-1/2 mx-auto max-w-[1170px] flex items-center justify-between">
        <div>
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

        <div class="w-1/4">
            <div class="relative">
                <button
                    class="text-blue-500 hover:underline active:opacity-70"
                    @click="openNotificationsBar"
                >
                    Оповещения ({{ $page.props.auth.notifications_count }})
                </button>
                <div
                    v-if="$page.props.auth.notifications.length && isOpen"
                    class="absolute w-full"
                >
                    <div
                        v-for="notification in $page.props.auth.notifications"
                        class="z-30 p-4 text-left bg-white border-t border-b border-gray-300"
                    >
                        <p>{{ notification.title }}</p>
                        <Link
                            :href="notification.url"
                            class="text-blue-500 hover:underline active:opacity-70"
                            >Перейти</Link
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import axios from "axios";

const page = usePage();

const isOpen = ref(false);

const openNotificationsBar = async () => {
    isOpen.value = !isOpen.value;

    const ids = page.props.auth.notifications.map(
        (notification) => notification.id
    );

    const res = await axios.patch(route("notifications.updateCollection"), {
        ids,
    });

    page.props.auth.notifications_count = res.data.count;
    page.props.auth.notifiications = [];
};
</script>

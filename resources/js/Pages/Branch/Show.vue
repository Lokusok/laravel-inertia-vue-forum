<template>
    <Head title="Просмотр ветки" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">
                Просмотр ветки | {{ props.branch.title }}
            </h3>
        </div>

        <div>
            <div
                v-for="branch in props.branch.children"
                :key="branch.id"
                class="flex items-center"
            >
                <Link
                    :href="route('branches.show', branch.id)"
                    class="block w-full p-4 mr-4 bg-white border border-gray-300 hover:bg-gray-100 active:bg-gray-200 active:opacity-80"
                >
                    <h3>{{ branch.title }}</h3>
                </Link>

                <div class="flex gap-2">
                    <Link
                        :href="route('branches.edit', branch.id)"
                        class="w-[35px] h-[35px] flex items-center justify-center rounded-sm hover:opacity-80 active:opacity-50 bg-sky-600"
                    >
                        <PenIcon class="stroke-white" />
                    </Link>

                    <Link
                        :href="route('branches.destroy', branch.id)"
                        method="DELETE"
                        class="w-[35px] h-[35px] flex items-center justify-center rounded-sm hover:opacity-80 active:opacity-50 bg-red-600"
                    >
                        <TrashIcon class="stroke-white" />
                    </Link>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";
import PenIcon from "@/Components/icons/PenIcon.vue";
import TrashIcon from "@/Components/icons/TrashIcon.vue";

const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
});
</script>

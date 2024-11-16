<template>
    <MainLayout>
        <div class="flex items-center pb-4 mb-4 border-b border-b-gray-400">
            <h3 class="mr-4 text-xl">Разделы</h3>
            <Link
                :href="route('sections.create')"
                class="block w-1/4 px-2 py-1 mr-4 text-center bg-white border border-gray-300 rounded-lg hover:bg-gray-100 active:bg-gray-200"
            >
                + Раздел
            </Link>

            <Link
                :href="route('branches.create')"
                class="block w-1/4 px-2 py-1 text-center bg-white border border-gray-300 rounded-lg hover:bg-gray-100 active:bg-gray-200"
            >
                + Ветка
            </Link>
        </div>

        <div v-if="props.sections">
            <div
                v-for="section in props.sections"
                :key="section.id"
                class="mb-8"
            >
                <div v-if="section.branches.length > 0">
                    <div class="mb-4">
                        <h3 class="text-lg">{{ section.title }}</h3>
                    </div>

                    <div v-for="branch in section.branches" :key="branch.id">
                        <Link
                            :href="route('branches.show', branch.id)"
                            class="block p-4 bg-white border border-gray-300 hover:bg-gray-100 active:bg-gray-200 active:opacity-80"
                        >
                            <h3>{{ branch.title }}</h3>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import MainLayout from "../../Layouts/MainLayout.vue";

const props = defineProps({
    sections: {
        type: Array,
        required: true,
    },
});
</script>

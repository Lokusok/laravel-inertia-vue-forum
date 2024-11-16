<template>
    <Head title="Разделы" />

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

        <div
            v-if="$page.props.flash.message"
            class="p-3 bg-white rounded-lg shadow-sm"
        >
            {{ $page.props.flash.message }}
        </div>

        <div v-if="props.sections">
            <div
                v-for="section in props.sections"
                :key="section.id"
                class="mb-8"
            >
                <div v-if="section.branches.length > 0">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="mr-2 text-lg">{{ section.title }}</h3>

                        <div class="flex gap-2">
                            <Link
                                :href="route('sections.edit', section.id)"
                                class="hover:opacity-80 active:opacity-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"
                                    />
                                </svg>
                            </Link>

                            <Link
                                :href="route('sections.destroy', section.id)"
                                method="DELETE"
                                class="hover:opacity-80 active:opacity-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                            </Link>
                        </div>
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
import { Link, usePage, Head } from "@inertiajs/vue3";

import MainLayout from "../../Layouts/MainLayout.vue";

const props = defineProps({
    sections: {
        type: Array,
        required: true,
    },
});

const page = usePage();

console.log(page.props.flash.message);
</script>

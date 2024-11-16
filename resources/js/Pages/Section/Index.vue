<template>
    <Head title="Разделы" />

    <MainLayout>
        <div class="flex items-center pb-4 mb-4 border-b border-b-gray-400">
            <h3 class="mr-4 text-xl">Разделы</h3>

            <LongButton :href="route('sections.create')" :is-link="true">
                + Раздел
            </LongButton>

            <LongButton :href="route('branches.create')" :is-link="true">
                + Ветка
            </LongButton>
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
                                <PenIcon />
                            </Link>

                            <Link
                                :href="route('sections.destroy', section.id)"
                                method="DELETE"
                                class="hover:opacity-80 active:opacity-50"
                            >
                                <TrashIcon />
                            </Link>
                        </div>
                    </div>

                    <div
                        v-for="branch in section.branches"
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
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Link, usePage, Head } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";
import TrashIcon from "@/Components/icons/TrashIcon.vue";
import PenIcon from "@/Components/icons/PenIcon.vue";
import LongButton from "@/Components/ui/LongButton.vue";

const props = defineProps({
    sections: {
        type: Array,
        required: true,
    },
});

const page = usePage();
</script>

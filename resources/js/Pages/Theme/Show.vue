<template>
    <Head title="Просмотр темы" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">
                Просмотр темы | {{ props.theme.title }}
            </h3>
        </div>

        <div></div>
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";
import ErrorLabel from "@/Components/ui/ErrorLabel.vue";

const props = defineProps({
    theme: {
        type: Object,
        required: true,
    },
});
</script>

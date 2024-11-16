<template>
    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">
                Просмотр ветки | {{ props.branch.title }}
            </h3>
        </div>

        <div></div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
});
</script>

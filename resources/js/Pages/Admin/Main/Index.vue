<template>
    <AdminLayout>
        <div class="mb-4">
            <h3 class="mr-4 text-xl">Статистика</h3>
        </div>

        <div>
            <div
                v-if="props.stats"
                class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4"
            >
                <div
                    v-for="stat in props.stats"
                    :key="stat.title"
                    class="flex flex-col gap-1 p-2 text-sm border border-gray-300"
                >
                    <h3>{{ stat.title }}</h3>
                    <p>{{ stat.count }}</p>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    stats: {
        type: Object,
        required: true,
    },
});
</script>

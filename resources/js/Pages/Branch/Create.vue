<template>
    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">Добавить ветку</h3>
        </div>

        <div>
            <div>
                <div v-if="props.sections.length > 0" class="mb-3">
                    <select
                        v-model="sectionId"
                        class="w-1/2 p-2 border-gray-300"
                    >
                        <option value="null" selected disabled>
                            Выберите раздел
                        </option>

                        <option
                            v-for="section in props.sections"
                            :value="section.id"
                            :key="section.id"
                        >
                            {{ section.title }}
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <input
                        v-model="title"
                        type="text"
                        class="w-1/2 p-2 border-gray-300"
                        placeholder="Название ветки"
                    />
                </div>

                <div>
                    <button
                        @click="store"
                        class="px-5 py-2 font-bold text-white bg-green-700 rounded-lg hover:bg-green-600 active:bg-green-500 active:opacity-80 disabled:opacity-60"
                        :disabled="isButtonDisabled"
                    >
                        Добавить
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

import MainLayout from "../../Layouts/MainLayout.vue";

const props = defineProps({
    sections: {
        type: Array,
        required: true,
    },
});

const title = ref("");
const sectionId = ref(null);
const isButtonDisabled = ref(false);

const store = () => {
    isButtonDisabled.value = true;

    router.post(
        route("branches.store"),
        {
            section_id: sectionId.value,
            title: title.value,
        },
        {
            onSuccess: () => {
                title.value = "";
                isButtonDisabled.value = false;
            },
        }
    );
};
</script>

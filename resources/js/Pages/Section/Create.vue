<template>
    <Head title="Создание раздела" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">Добавить раздел</h3>
        </div>

        <div>
            <div>
                <div class="mb-3">
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-1/2 p-2 border-gray-300"
                        placeholder="Название раздела"
                    />

                    <ErrorLabel v-if="form.errors.title">
                        {{ form.errors.title }}
                    </ErrorLabel>
                </div>

                <div>
                    <button
                        @click="store"
                        class="px-5 py-2 font-bold text-white bg-blue-700 rounded-lg hover:bg-blue-600 active:bg-blue-500 active:opacity-80 disabled:opacity-60"
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
import { useForm, Head } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";
import ErrorLabel from "@/Components/ui/ErrorLabel.vue";

const isButtonDisabled = ref(false);

const form = useForm({
    title: "",
});

const store = () => {
    isButtonDisabled.value = true;

    form.post(route("sections.store"), {
        onSuccess: () => {
            form.title = "";
        },

        onFinish: () => {
            isButtonDisabled.value = false;
        },
    });
};
</script>

<template>
    <Head title="Создание темы" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">Добавить тему</h3>
        </div>

        <div>
            <div>
                <div class="mb-3">
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-1/2 p-2 border-gray-300"
                        placeholder="Название темы"
                    />

                    <ErrorLabel v-if="form.errors.title">
                        {{ form.errors.title }}
                    </ErrorLabel>
                </div>

                <div class="mb-3">
                    <textarea
                        v-model="form.description"
                        class="w-1/2 p-2 border-gray-300"
                        placeholder="Описание"
                    />

                    <ErrorLabel v-if="form.errors.description">
                        {{ form.errors.description }}
                    </ErrorLabel>
                </div>

                <div>
                    <button
                        @click="store"
                        class="px-5 py-2 font-bold text-white bg-purple-700 rounded-lg hover:bg-purple-600 active:bg-purple-500 active:opacity-80 disabled:opacity-60"
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

const props = defineProps({
    branch: {
        type: Object,
        required: true,
    },
});

const isButtonDisabled = ref(false);

const form = useForm({
    title: "",
    description: "",
    branch_id: props.branch.id,
});

console.log(props, form);

const store = () => {
    isButtonDisabled.value = true;

    console.log(form.branch_id);

    form.post(route("themes.store"), {
        onSuccess: () => {
            form.title = "";
        },

        onFinish: () => {
            isButtonDisabled.value = false;
        },
    });
};
</script>

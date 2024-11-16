<template>
    <Head title="Изменение темы" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">Изменить тему</h3>
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
                        @click="update"
                        class="px-5 py-2 font-bold text-white bg-purple-700 rounded-lg hover:bg-purple-600 active:bg-purple-500 active:opacity-80 disabled:opacity-60"
                        :disabled="isButtonDisabled"
                    >
                        Изменить
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
    theme: {
        type: Object,
        required: true,
    },
});

const isButtonDisabled = ref(false);

const form = useForm({
    title: props.theme.title,
    description: props.theme.description,
});

const update = () => {
    isButtonDisabled.value = true;

    form.patch(route("themes.update", props.theme.id), {
        onSuccess: () => {
            form.title = "";
            form.description = "";
        },

        onFinish: () => {
            isButtonDisabled.value = false;
        },
    });
};
</script>

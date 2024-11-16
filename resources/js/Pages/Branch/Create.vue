<template>
    <Head title="Создание ветки" />

    <MainLayout>
        <div class="flex items-center mb-3">
            <h3 class="mr-4 text-xl">Добавить ветку</h3>
        </div>

        <div>
            <div>
                <div v-if="props.sections.length > 0" class="mb-3">
                    <select
                        v-model="form.section_id"
                        class="w-1/2 p-2 border-gray-300"
                        @change="getBranches"
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

                    <ErrorLabel v-if="form.errors.section_id">
                        {{ form.errors.section_id }}
                    </ErrorLabel>
                </div>

                <div v-if="branches.length > 0" class="mb-3">
                    <select
                        v-model="form.parent_id"
                        class="w-1/2 p-2 border-gray-300"
                    >
                        <option value="null" selected disabled>
                            Выберите ветку
                        </option>

                        <option
                            v-for="branch in branches"
                            :value="branch.id"
                            :key="branch.id"
                        >
                            {{ branch.title }}
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-1/2 p-2 border-gray-300"
                        placeholder="Название ветки"
                    />

                    <ErrorLabel v-if="form.errors.title">
                        {{ form.errors.title }}
                    </ErrorLabel>
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
import { useForm, Head } from "@inertiajs/vue3";
import axios from "axios";

import MainLayout from "../../Layouts/MainLayout.vue";
import ErrorLabel from "@/Components/ui/ErrorLabel.vue";

const props = defineProps({
    sections: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: "",
    section_id: null,
    parent_id: null,
});

const isButtonDisabled = ref(false);

const branches = ref([]);

const store = () => {
    isButtonDisabled.value = true;

    console.log(form);

    form.post(route("branches.store"), {
        onSuccess: () => {
            form.title = "";
        },

        onFinish: () => {
            isButtonDisabled.value = false;
        },
    });
};

const getBranches = async () => {
    form.parent_id = null;

    const url = route("sections.branches.index", [form.section_id]);

    const res = await axios.get(url);

    branches.value = res.data;
};
</script>

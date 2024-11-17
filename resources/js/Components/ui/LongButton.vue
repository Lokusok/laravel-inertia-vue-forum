<template>
    <component
        :is="props.isLink ? Link : 'button'"
        :href="route('sections.create')"
        class="block px-2 py-1 mr-4 text-center bg-white border border-gray-300 rounded-lg hover:bg-gray-100 active:bg-gray-200 whitespace-nowrap"
    >
        <slot />
    </component>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    isLink: {
        type: Boolean,
        default: false,
    },
});
</script>

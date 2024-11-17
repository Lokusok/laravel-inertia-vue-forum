<template>
    <div>
        <div class="py-4 bg-white border-b border-b-gray-300">
            <NavBar />
        </div>

        <div class="w-1/2 py-4 mx-auto max-w-[1170px]">
            <slot />
        </div>
    </div>
</template>

<script setup>
import NavBar from "@/Components/parts/NavBar.vue";
</script>

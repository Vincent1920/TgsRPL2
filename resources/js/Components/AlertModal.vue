<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-2xl p-8 w-full max-w-sm text-center transform transition-all scale-100">
            
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full border-4 border-green-100 bg-green-50 mb-6">
                <svg class="h-10 w-10 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-3xl font-serif font-bold text-gray-700 mb-2">{{ title }}</h2>
            <p class="text-gray-500 mb-8">{{ message }}</p>

            <button @click="$emit('confirm')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-8 rounded shadow-md transition duration-200 ease-in-out outline-none focus:ring-2 focus:ring-blue-300">
                {{ buttonText }}
            </button>
        </div>
    </div>
</template>

<script setup>
defineProps({
    show: Boolean,
    title: String,
    message: String,
    buttonText: { type: String, default: "OK" }
});
defineEmits(['confirm']);
</script>
<template>
    <Transition name="fade">
        <div v-if="show" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm p-4">
            <div class="bg-white rounded-[35px] shadow-2xl p-8 w-full max-w-sm text-center transform transition-all">
                
                <div :class="[
                    'mx-auto flex items-center justify-center h-20 w-20 rounded-full border-4 mb-6',
                    type === 'success' ? 'border-green-100 bg-green-50' : 'border-red-100 bg-red-50'
                ]">
                    <svg v-if="type === 'success'" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <svg v-else class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ title }}</h2>
                <p class="text-gray-500 mb-8 px-2">{{ message }}</p>

                <button @click="$emit('confirm')" 
                    :class="[
                        'w-full text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-200 active:scale-95',
                        type === 'success' ? 'bg-blue-500 hover:bg-blue-600' : 'bg-red-500 hover:bg-red-600'
                    ]">
                    OK
                </button>
            </div>
        </div>
    </Transition>
</template>

<script setup>
defineProps({
    show: Boolean,
    title: String,
    message: String,
    type: { type: String, default: 'success' }
});
defineEmits(['confirm']);
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.3s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>
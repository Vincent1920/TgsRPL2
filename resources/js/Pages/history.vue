<template>
  <Navbar />
  <div class="container mx-auto px-4 py-8">
    <h1 class="font-kaushan text-4xl text-center mb-10">History Tugas</h1>

    <div v-if="isLoading" class="text-center text-gray-500">Memuat History...</div>

    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div 
        v-for="(task, index) in tugasList" 
        :key="task.id"
        :class="[
          getColor(index).bg,
          'relative w-full min-h-[16rem] rounded-[40px] shadow-lg p-6 flex flex-col justify-center items-center transition-all hover:scale-105'
        ]"
      >
        <div class="absolute top-0 left-0 flex items-center">
          <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-br-[25px] flex items-center gap-2 shadow-sm">
            <CalendarDaysIcon class="w-5 h-5 text-gray-600" />
            <span class="text-xs font-bold text-gray-700">{{ task.tanggal }}</span>
          </div>
          <div class="px-4 py-2 font-dancing text-lg text-gray-800 opacity-70">
            {{ task.kategori?.nama_kategori || 'Kategori' }}
          </div>
        </div>

        <div class="absolute top-4 right-6">
          <div v-if="task.isChecked" class="text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div v-else class="text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
        </div>

        <div class="text-center mt-6">
          <h2 :class="[getColor(index).text, 'font-kaushan text-3xl mb-3']">
            {{ task.tugas }}
          </h2>
          <p v-if="task.deskripsi" class="font-poppins text-sm text-gray-700 line-clamp-3">
            {{ task.deskripsi }}
          </p>
        </div>
      </div>
    </div>

    <div v-if="tugasList.length === 0" class="text-center py-20 opacity-40">
      <p class="font-kaushan text-2xl">Belum ada riwayat tugas.</p>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useTugasStore } from '@/stores/Tugas';
import { CalendarDaysIcon } from '@heroicons/vue/24/solid';
import Navbar from '../Components/Navbar.vue';

const tugasStore = useTugasStore();
const { tugasList, isLoading } = storeToRefs(tugasStore);

const colorPalette = [
  { bg: 'bg-green-100', text: 'text-green-800' },
  { bg: 'bg-pink-100', text: 'text-pink-800' },
  { bg: 'bg-blue-200', text: 'text-blue-900' }
];

const getColor = (index) => colorPalette[index % colorPalette.length];

onMounted(() => {
  tugasStore.fetchHistory();
});
</script>

<style scoped>
.font-kaushan { font-family: 'Kaushan Script', cursive; }
.font-dancing { font-family: 'Dancing Script', cursive; }
.font-poppins { font-family: 'Poppins', sans-serif; }
</style>
<template>
    <Navbar />
  <div class="relative w-full max-w-[320px] mt-8 group">
    
    <div class="absolute -top-5 -right-3 z-30 filter drop-shadow-sm transition-transform group-hover:scale-110">
      <svg v-if="statusIcon === 'check'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-blue-700">
        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
      </svg>
      <svg v-else-if="statusIcon === 'x'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-red-600">
         <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
      </svg>
    </div>

    <div class="relative filter drop-shadow-sm">
      
      <div :class="[
        'absolute -top-8 left-0 w-5/12 h-12 rounded-t-xl z-0 flex items-center px-4 border-b-0',
        colorStyles.tabBg
      ]">
        <div class="flex items-center space-x-2 text-gray-700 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 opacity-70">
                <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0117.25 3v1.5h1.375c.75 0 1.375.625 1.375 1.375v11.25c0 .75-.625 1.375-1.375 1.375h-13.5A1.375 1.375 0 013.75 17.25V5.875c0-.75.625-1.375 1.375-1.375H6.5V3a.75.75 0 01.75-.75zM5.25 7.5h13.5v9.75H5.25V7.5z" clip-rule="evenodd" />
            </svg>
            <span>{{ date }}</span>
        </div>
      </div>

      <div :class="[
        'relative z-10 w-full rounded-r-2xl rounded-bl-2xl rounded-tl-none p-6 min-h-[180px] flex flex-col',
        colorStyles.bodyBg
      ]">
        <div class="flex justify-end mb-2">
            <span class="font-script text-xl text-gray-800 opacity-90">{{ category }}</span>
        </div>

        <div class="flex-grow flex items-center justify-center text-center">
             <slot>
                <h3 class="font-script text-3xl text-gray-800">Tugas</h3>
             </slot>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import { computed } from 'vue';

// Props yang diterima komponen
const props = defineProps({
  date: { type: String, default: '10-3-2025' },
  category: { type: String, default: 'Kategori' },
  // variant menentukan warna dasar: 'green', 'pink', 'blue'
  variant: { type: String, default: 'green' }, 
  // statusIcon menentukan ikon di pojok: 'check', 'x', atau null
  statusIcon: { type: String, default: null } 
});

// Logika untuk memilih warna berdasarkan prop 'variant'
const colorStyles = computed(() => {
    switch (props.variant) {
        case 'green':
            return { bodyBg: 'bg-[#DCFCE7]', tabBg: 'bg-[#d1fadf]' }; // Hijau muda
        case 'pink':
            return { bodyBg: 'bg-[#FCE7E7]', tabBg: 'bg-[#fadcdc]' }; // Pink muda
        case 'blue':
            return { bodyBg: 'bg-[#8EC6DF]', tabBg: 'bg-[#7eb5ce]' }; // Biru seperti di gambar (agak gelap sedikit untuk tab)
        default:
            return { bodyBg: 'bg-gray-100', tabBg: 'bg-gray-200' };
    }
});
</script>

<style scoped>
/* Menerapkan font script yang sudah di-load di index.html */
.font-script {
    font-family: 'Dancing Script', cursive;
}
</style>import Navbar from '../Components/Navbar.vue'

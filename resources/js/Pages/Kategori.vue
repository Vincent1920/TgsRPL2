<template>

<Navbar/>
  <div class="container mx-auto px-4 py-8 md:py-12">
    <div class="flex flex-col items-center justify-center mb-10">
      
      <h1 class="font-kaushan text-4xl text-gray-800 mb-8">Kategori</h1>

      <button
        class="flex items-center gap-3 px-6 py-3 bg-pink-100 text-pink-700 rounded-full shadow-md hover:bg-pink-200 transition-colors duration-200 text-xl font-kaushan mb-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
        <router-link to="/Create_kategori" class="hover:text-black">
                    <!-- Buat Tugas -->
                    <span>Buat Kategori</span>
                </router-link>
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="(category, index) in categories"
        :key="index"
        :class="[
          category.bgColor,
          'relative w-full h-48 rounded-3xl shadow-xl flex items-center justify-center',
          'transform transition-transform hover:scale-105 duration-300 cursor-pointer group',
          {'bg-opacity-70': category.bgColor === 'bg-pink-100' || category.bgColor === 'bg-green-100' || category.bgColor === 'bg-blue-200'}
        ]"
      >
        <h2
          :class="[
            category.bgColor === 'bg-pink-100' ? 'text-pink-800' : 
            category.bgColor === 'bg-green-100' ? 'text-green-800' : 
            category.bgColor === 'bg-blue-200' ? 'text-indigo-800' : 'text-black',
            'font-poppins text-4xl select-none'
          ]"
        >
          {{ category.name }}
        </h2>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Navbar from '../Components/Navbar.vue';

const categories = ref([
  {
    name: 'nama kategori',
    bgColor: 'bg-green-100', // Hijau muda
  },
  {
    name: 'Kategori',
    bgColor: 'bg-pink-100', // Pink muda
  },
  {
    name: 'Kerjaan',
    bgColor: 'bg-blue-200', // Biru keunguan / Lavender
  },
]);
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Dancing+Script:wght@600;700&family=Kaushan+Script&display=swap');

d
.font-poppins {
  font-family: 'Poppins', sans-serif;
}
</style>
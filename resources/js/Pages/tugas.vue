<template>
    <Navbar />
    <div class="container mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col items-center justify-center mb-10">
            <h1 class="font-kaushan text-4xl text-gray-800 mb-8">Tugas</h1>

            <div class="flex items-center space-x-4">
                <button
                    class="flex items-center gap-3 px-6 py-3 bg-pink-100 text-pink-700 rounded-full shadow-md hover:bg-pink-200 transition-colors duration-200 text-xl font-kaushan">
                    <PlusCircleIcon class="size-8 text-black-500" />
                <router-link to="/Create_Tugas" class="hover:text-black">
                    Buat Tugas
                </router-link>
                    
                </button>

                <div class="relative">
                    <button @click="toggleFilterDropdown"
                        class="p-3 bg-gray-200 rounded-full shadow-md hover:bg-gray-300 transition-colors duration-200">
                        <funnelIcon class="size-6 text-black-500" />

                    </button>

                    <div v-if="filterDropdownOpen"
                        class="absolute right-0 mt-3 w-64 bg-white rounded-lg shadow-xl p-4 border border-gray-200 z-20">
                        <div class="flex items-center gap-2">

                            <div class="relative w-1/2">
                                <input type="text" placeholder="Tanggal awal"
                                    class="w-full pl-9 pr-2 py-1.5 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" />
                                <CalendarDaysIcon
                                    class="w-5 h-5 absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" />
                            </div>

                            <div class="relative w-1/2">
                                <input type="text" placeholder="Tanggal akhir"
                                    class="w-full pl-9 pr-2 py-1.5 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" />
                                <CalendarDaysIcon
                                    class="w-5 h-5 absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" />
                            </div>

                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <div class="space-y-1">
                                <label v-for="cat in categories" :key="cat" class="flex items-center cursor-pointer">
                                    <input type="checkbox" :value="cat" v-model="selectedCategories"
                                        class="form-checkbox h-4 w-4 text-blue-600 rounded-sm border-gray-300 focus:ring-blue-500" />
                                    <span class="ml-2 text-sm text-gray-800">{{ cat }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="(task, index) in filteredTasks" :key="index" :class="[
      task.bgColor,
      'relative w-full h-56 rounded-3xl shadow-xl overflow-hidden transform transition-transform hover:scale-105 duration-300 group',
      {'bg-opacity-70': task.bgColor === 'bg-pink-100' || task.bgColor === 'bg-green-100'}
    ]">

                <div class="absolute top-0 left-0 z-10">
                    <div :class="[
              task.bgColor === 'bg-pink-100' ? 'bg-white text-gray-800' : 'bg-white text-gray-800',
              'px-5 py-3 rounded-br-[30px] flex items-center gap-3 shadow-sm'
            ]">
                        <CalendarDaysIcon class="w-6 h-6" />

                        <span class="font-semibold font-sans text-sm pt-0.5 select-none">{{ task.date }}</span>
                    </div>
                </div>

                <div class="absolute top-4 right-6 flex items-center gap-3 z-20">
                    <span :class="[
              task.bgColor === 'bg-pink-100' ? 'text-pink-700' : 
              task.bgColor === 'bg-green-100' ? 'text-green-700' : 'text-black/80',
              'font-dancing text-xl select-none'
            ]">Kategori</span>

                    <div @click="toggleCheck(index)"
                        class="w-7 h-7 bg-white border-2 border-black rounded-md cursor-pointer flex items-center justify-center transition-colors hover:bg-gray-100">

                        <CheckIcon v-if="task.isChecked" class="w-5 h-5 text-black" stroke-width="3" />

                    </div>
                </div>

                <div class="flex flex-col items-center justify-center h-full w-full p-4 transition-opacity duration-300"
                    :class="{ 'opacity-40 line-through': task.isChecked }">
                    <h1 :class="[
              task.bgColor === 'bg-pink-100' ? 'text-pink-800' : 
              task.bgColor === 'bg-green-100' ? 'text-green-800' : 'text-black',
              'font-kaushan text-5xl select-none'
            ]">{{ task.title }}</h1>

                    <p v-if="task.description" class="font-poppins text-sm mt-2 text-center" :class="{ 
              'text-pink-700': task.bgColor === 'bg-pink-100',
              'text-green-700': task.bgColor === 'bg-green-100',
              'text-gray-700': task.bgColor !== 'bg-pink-100' && task.bgColor !== 'bg-green-100'
            }">
                        {{ task.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {
        ref,
        computed
    } from 'vue';
    import {
        FunnelIcon,
        PlusCircleIcon,
        CalendarDaysIcon,
        CheckIcon
    } from '@heroicons/vue/24/solid'
    // import { BeakerIcon } from '@heroicons/vue/24/solid'
    import Navbar from '../Components/Navbar.vue';
    const filterDropdownOpen = ref(false);
    const selectedCategories = ref([]);
    const categories = ['Kategori 1', 'Kategori 2', 'Pribadi', 'Kerja']; // Contoh kategori

    const tasks = ref([{
            date: '10-3-2025',
            title: 'Tugas Pariatur cillum quis labore',
            description: 'ad enim. Fugiat minim commodo ea minimhm quis commodo duis',
            bgColor: 'bg-green-100', // Warna hijau untuk kartu pertama
            category: 'Kategori 1',
            isChecked: false,
        },
        {
            date: '10-3-2025',
            title: 'Tugas',
            bgColor: 'bg-pink-100', // Warna pink untuk kartu kedua
            category: 'Kategori 2',
            isChecked: false,
        },
        {
            date: '10-3-2025',
            title: 'Tugas',
            bgColor: 'bg-[#22C5FD]', // Warna biru untuk kartu ketiga
            category: 'Pribadi',
            isChecked: false,
        },
    ]);

    const toggleFilterDropdown = () => {
        filterDropdownOpen.value = !filterDropdownOpen.value;
    };

    const toggleCheck = (index) => {
        tasks.value[index].isChecked = !tasks.value[index].isChecked;
    };

    // Computed property untuk memfilter tugas berdasarkan kategori yang dipilih
    const filteredTasks = computed(() => {
        if (selectedCategories.value.length === 0) {
            return tasks.value;
        }
        return tasks.value.filter(task => selectedCategories.value.includes(task.category));
    });
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Dancing+Script:wght@600;700&family=Kaushan+Script&display=swap');

    .font-kaushan {
        font-family: 'Kaushan Script', cursive;
    }

    .font-dancing {
        font-family: 'Dancing Script', cursive;
    }

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }
</style>
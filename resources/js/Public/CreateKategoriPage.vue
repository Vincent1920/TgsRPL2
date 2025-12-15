<template>
    <Navbar />

    <div class="min-h-screen flex flex-col items-center justify-center bg-white py-10">
        <h1 class="font-kaushan text-4xl text-black mb-8">Buat Kategori</h1>

        <div class="w-full max-w-md bg-[#D0C9FF] rounded-[40px] p-8 shadow-xl flex flex-col items-center gap-5">
            
            <!-- INPUT FORM -->
            <div class="w-full">
                <input 
                    type="text" 
                    v-model="namaKategori" 
                    placeholder="Nama Kategori (cth: Kuliah)"
                    class="w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-700 placeholder-gray-400 shadow-sm" 
                />
                <!-- Tampilkan Error jika ada -->
                <p v-if="store.errors.nama_kategori" class="text-red-500 text-sm mt-1 ml-1">
                    {{ store.errors.nama_kategori[0] }}
                </p>
            </div>

            <br>

            <!-- TOMBOL SUBMIT -->
            <button 
                @click="handleSubmit"
                :disabled="store.isLoading"
                class="mt-4 flex items-center gap-2 bg-[#FFD6D6] px-8 py-2 rounded-full shadow-md hover:bg-pink-200 hover:scale-105 transform transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                
                <!-- Icon Loading jika sedang proses -->
                <svg v-if="store.isLoading" class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <PlusCircleIcon v-else class="w-7 h-7 text-black" stroke-width="1.5" />
                
                <span class="font-kaushan text-2xl text-black pt-1">
                    {{ store.isLoading ? 'Menyimpan...' : 'Simpan Kategori' }}
                </span>
            </button>

        </div>
    </div>

    <!-- ALERT MODAL -->
    <AlertModal 
        :show="showAlert" 
        title="Berhasil!" 
        message="Kategori berhasil dibuat."
        @confirm="goToKategoriList"
    />
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from "vue-router";
import { PlusCircleIcon } from '@heroicons/vue/24/outline';

// Import Komponen & Store
import Navbar from '../Components/Navbar.vue';
import AlertModal from "@/Components/AlertModal.vue"; 
import { useKategoriStore } from "@/Stores/Kategori.js"; // Pastikan path sesuai nama file kamu

const router = useRouter();
const store = useKategoriStore();

// State Lokal
const namaKategori = ref("");
const showAlert = ref(false);

// Fungsi Submit
const handleSubmit = async () => {
    // Validasi sederhana di frontend
    if (!namaKategori.value) {
        alert("Nama kategori tidak boleh kosong");
        return;
    }

    // Panggil action dari Store
    // id_user otomatis diambil dari token di backend (Laravel)
    const success = await store.createKategori({ 
        nama_kategori: namaKategori.value 
    });

    if (success) {
        showAlert.value = true; // Tampilkan modal sukses
        namaKategori.value = ""; // Reset input
    } else {
        // Jika gagal, error sudah dihandle di dalam store.errors
        // Kita bisa tampilkan alert global jika mau
        if(store.errors.general) {
            alert(store.errors.general[0]);
        }
    }
};

// Redirect setelah sukses
const goToKategoriList = () => {
    showAlert.value = false;
    router.push('/kategori');
};
</script>

<style scoped>
/* Pastikan font Kaushan Script sudah di-load di index.html atau CSS global */
@import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap');

.font-kaushan {
    font-family: 'Kaushan Script', cursive;
}
</style>
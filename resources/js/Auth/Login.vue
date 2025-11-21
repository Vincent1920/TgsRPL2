<template>
    <Navbar />

    <AlertModal 
        :show="showSuccessModal" 
        title="Hey!" 
        message="Login Berhasil! Selamat datang kembali."
        button-text="OK"
        @confirm="goToDashboard"
    />

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-10">
        <div class="w-full max-w-5xl bg-white shadow-xl rounded-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">
            
            <div class="bg-[#7EC4E3] flex flex-col items-center justify-center p-10 relative">
                <h1 class="text-4xl font-bold text-white mb-4">Halo!</h1>
            </div>

            <div class="bg-[#FFFCE7] p-12 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Login to Your Account</h2>
                <p class="text-gray-600 text-sm mb-8">Please enter your credentials to access your dashboard.</p>

                <form @submit.prevent="handleLogin" class="space-y-4">
                    <input v-model="email" type="email" placeholder="Email" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-400 outline-none" />
                    <input v-model="password" type="password" placeholder="Password" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-400 outline-none" />

                    <p v-if="errorMessage" class="text-red-500 text-sm text-center font-medium">{{ errorMessage }}</p>

                    <button type="submit" :disabled="isLoading" class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-900 transition disabled:opacity-50">
                        <span v-if="isLoading">Loading...</span>
                        <span v-else>Log In</span>
                    </button>
                </form>

                <div class="flex items-center justify-between mt-6">
                    <button class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-100">Forgot Password?</button>
                    <router-link to="/registrasi">
                        <button class="bg-black text-white px-6 py-2 rounded-lg text-sm hover:bg-gray-900">Register</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue"; 
import AlertModal from "@/Components/AlertModal.vue"; 
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/Stores/authStore";

const router = useRouter();
const auth = useAuthStore();

// Definisi Variabel Form
const email = ref("");
const password = ref("");
const errorMessage = ref("");
const isLoading = ref(false);

// State untuk Alert Modal
const showSuccessModal = ref(false);

const handleLogin = async () => {
    errorMessage.value = "";
    isLoading.value = true;

    try {
        const success = await auth.login({
            email: email.value,
            password: password.value,
        });

        if (success) {
            // Tampilkan Alert Modal (Jangan redirect dulu)
            showSuccessModal.value = true;
        } else {
            errorMessage.value = "Email atau password salah.";
        }
    } catch (error) {
        errorMessage.value = "Terjadi kesalahan server.";
    } finally {
        isLoading.value = false;
    }
};

// Fungsi saat tombol OK di klik
const goToDashboard = () => {
    showSuccessModal.value = false;
    router.push("/");
};
</script>
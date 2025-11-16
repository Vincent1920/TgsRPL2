<template>
    <nav class="w-full bg-yellow-100 shadow flex items-center justify-between px-6 py-4">

        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <h1 class="font-bold text-gray-800 text-xl font-[cursive]">RememberME</h1>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-8 text-gray-800">
            <router-link to="/" class="hover:text-black">Home</router-link>
            <router-link to="/tugas" class="hover:text-black">Tugas</router-link>
            <router-link to="/history" class="hover:text-black">History</router-link>
        </div>

        <!-- User Dropdown (desktop) -->
        <div class="hidden md:block relative">
            <button @click="toggleDropdown" class="flex items-center space-x-2">
                <i class="fa-regular fa-user text-lg"></i>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>

            <div v-if="dropdownOpen" class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg p-3 border">
                <p class="font-semibold text-gray-700"> userName </p>
                <!-- <p class="font-semibold text-gray-700">{{ userName }}</p> -->

                <!-- <p class="text-sm text-gray-500">{{ userEmail }}</p> -->
                <hr class="my-2">
                <button class="text-left w-full text-red-600 hover:text-red-700" @click="logout">
                    Logout
                </button>
            </div>
        </div>

        <!-- Mobile Button -->
        <button @click="toggleMenu" class="md:hidden text-2xl text-gray-800">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div v-if="menuOpen" class="md:hidden bg-yellow-50 w-full px-6 py-4 space-y-4 text-gray-800 shadow">
        <router-link to="/" class="block hover:text-black">Home</router-link>
        <router-link to="/tugas" class="block hover:text-black">Tugas</router-link>
        <router-link to="/history" class="block hover:text-black">History</router-link>

        <!-- User info mobile -->
        <div class="mt-4 p-3 bg-white rounded shadow">
            <p class="font-semibold text-gray-700">{{ userName }}</p>
            <p class="text-sm text-gray-500">{{ userEmail }}</p>

            <button class="mt-3 text-red-600 hover:text-red-700" @click="logout">
                Logout
            </button>
        </div>
    </div>
</template>

<script setup>
    import {
        ref
    } from "vue";

    // Toggle states
    const menuOpen = ref(false);
    const dropdownOpen = ref(false);

    // Dummy user (nanti diganti dari token authStore)
    const userName = "Nama Pengguna";
    const userEmail = "email@example.com";

    const toggleMenu = () => {
        menuOpen.value = !menuOpen.value;
    };

    const toggleDropdown = () => {
        dropdownOpen.value = !dropdownOpen.value;
    };

    const logout = () => {
        alert("Logout clicked!");
        // tambahkan fungsi logout authStore disini
    };
</script>

<style>
    /* Optional smooth dropdown animation */
</style>
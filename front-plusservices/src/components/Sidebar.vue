<template>
    <nav class="bg-blue-500 p-4">
      <div class="flex justify-between items-center">
        <div class="text-white font-bold text-xl">Logo</div>
        <div class="lg:flex hidden space-x-4">
          <router-link class="text-white hover:text-gray-300" to="/">Biblioteca</router-link>
          <div class="relative" @click="toggleUserMenu">
            <span class="text-white cursor-pointer hover:text-gray-300">Mi Cuenta</span>
            <div v-show="isUserMenuOpen" @click="toggleUserMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
              <button @click="logout" class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-blue-100">Cerrar Sesión</button>
            </div>
          </div>
        </div>
        <button @click="toggleMobileMenu" class="lg:hidden text-white cursor-pointer hover:text-gray-300">
          &#9776; Menú
        </button>
      </div>
      <div v-show="isMobileMenuOpen" class="lg:hidden">
        <router-link class="block px-4 py-2 text-white hover:text-gray-300" to="/">Biblioteca</router-link>
        <div class="relative" @click="toggleUserMenu">
          <span class="block px-4 py-2 text-white hover:text-gray-300">Mi Cuenta</span>
          <div v-show="isUserMenuOpen" @click="toggleUserMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
            <button @click="logout" class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-blue-100">Cerrar Sesión</button>
          </div>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  import { CerrarSesion }  from "../Hooks/UseAuth";

  export default {
    data() {
      return {
        isMobileMenuOpen: false,
        isUserMenuOpen: false,
      };
    },
    methods: {

      toggleMobileMenu() {
        this.isMobileMenuOpen = !this.isMobileMenuOpen;
      },
      toggleUserMenu() {
        this.isUserMenuOpen = !this.isUserMenuOpen;
      },
      async logout() {
        await CerrarSesion();
        // Implementa la lógica para cerrar sesión aquí
      },
    },
  };
  </script>
  
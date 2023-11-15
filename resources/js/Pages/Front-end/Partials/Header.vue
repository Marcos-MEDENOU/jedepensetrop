<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

</script>

<template>
  <Head title="Accueil" />
  <!-- <header
      class="px-6 py-4 text-center text-white bg-black md:flex md:justify-around md:items-center"
    >
      <div class="md:flex md:items-center">
        <a href="/"
          ><img
            src="/images/Logo_eclat.png"
            alt="logo"
            class="h-10"
        /></a>
      </div>
      <div></div>
      <nav class="navbar">
        <ul class="md:flex md:items-center">
          <li>
            <a href="/LeGroupe" class="px-3 py-2 font-medium hover:text-gray-300"
              >Le Groupe</a
            >
          </li>
          <li>
            <a href="#" class="px-3 py-2 font-medium hover:text-gray-300"
              >Prestations</a
            >
          </li>
          <li>
            <a href="#" class="px-3 py-2 font-medium hover:text-gray-300"
              >Vous accompagner</a
            >
          </li>
          <li>
            <a href="#" class="px-3 py-2 font-medium hover:text-gray-300"
              >RSE</a
            >
          </li>
          <li>
            <a href="#" class="px-3 py-2 font-medium hover:text-gray-300"
              >Contacts</a
            >
          </li>
          <li>
            <a
              href="#"
              class="px-3 py-2 font-medium hover:text-gray-300 md:bg-[#E69803] rounded-lg"
              >Recrutements</a
            >
          </li>
        </ul>
      </nav>
    </header> -->
  <nav
    class="fixed top-0 left-0 right-0 z-10 flex lg:justify-around px-4 justify-between w-full py-3 lg:py-5 shadow-md bg-[#121212] backdrop-blur-md">


    <!-- Logo Container -->
    <div class="flex items-center">
      <!-- Logo -->
      <a class="cursor-pointer">
        <h3 class="text-2xl font-medium text-blue-500">
          <img class="object-cover h-10" src="/images/Logo_eclat.png" alt="Store Logo">
        </h3>
      </a>
    </div>

    <!-- Links Section -->
    <div class="items-center hidden space-x-8 lg:flex">
      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        Le groupe
      </a>

      <a class="flex font-semibold text-white text-blue-600 transition-colors duration-300 cursor-pointer">
        Prestations
      </a>

      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        Vous accompagner
      </a>

      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        RSE
      </a>

      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        Contacts
      </a>


    </div>

    <!-- Icon Menu Section -->
    <div class="flex items-center space-x-5 bg-[#E69803] rounded-lg hidden lg:block">
      <!-- Register -->
      <a class="flex px-2 py-2 text-white transition-colors duration-300 rounded-lg cursor-pointer hover:text-blue-500">


        RECRUTEMENTS
      </a>

      <!-- Login -->
      <!-- <a class="flex font-semibold text-gray-600 text-blue-600 transition-colors duration-300 cursor-pointer">

                    <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                    </svg>

                    Login
                </a> -->
    </div>

    <div class="lg:hidden">
      <button class="flex items-center p-3 text-white navbar-burger">
        <svg class="block h-6 rounded-full fill-current w-7" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <title>Mobile menu</title>
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
      </button>
    </div>
  </nav>

  <div class="lg:hidden items-center flex flex-col gap-3 py-3 bg-[#121212] mt-16 mb-0 space-x-8">

    <a href="" class="hidden"></a>
      <a class="text-center mt-2 flex font-semibold text-white transition-colors duration-300 cursor-pointer">
        Le groupe
      </a>
      <a class="flex font-semibold text-white transition-colors duration-300 cursor-pointer">
        Prestations
      </a>

      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        Vous accompagner
      </a>

      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        RSE
      </a>

      <a class="flex text-white transition-colors duration-300 cursor-pointer hover:text-blue-500">
        Contacts
      </a>
    </div>
</template>
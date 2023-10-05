<template>
    <main class="max-w-4xl m-auto mt-10 md:mt-28 flex felx-col md:flex-row items-center">
        <img 
          src="../assets/img/logo.jpg"
          alt="imagen logo"
          class="max-w-xs"
        />

        <div class="p-10 w-full">
          <router-view></router-view>
        </div>

    </main>
    
</template>
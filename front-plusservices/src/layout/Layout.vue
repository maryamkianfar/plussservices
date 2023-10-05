
<script setup>
import Sidebar from '../components/Sidebar.vue'
</script>
<template>

<body class="font-sans antialiased">
        <div class="">
            <Sidebar></Sidebar>
            <main>
            
                <div class="py-12 shadow">
                    <div class="px-4 max-w-7xl  sm:px-6 lg:px-8">
               
                        <router-view></router-view>
                    </div>
                </div>

            </main>
        </div>
    </body>

</template>
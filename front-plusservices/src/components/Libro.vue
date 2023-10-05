<template>
    <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
        <div class="space-y-3">
            <a class="text-xl font-bold">
                {`${usuario.firstname} ${usuario.lastname}`} 
            </a>
            <p class="text-sm text-gray-600 font-bold">
                {usuario.email}
            </p>
            <p class="text-sm text-gray-500">
                Fecha de nacimiento: {usuario.fecha_nacimiento}
            </p>
            <p class="text-sm text-gray-500">
                Edad: {usuario.age}
            </p>
            <p class="text-sm text-gray-500">
                FEstado civil: {usuario.estado_civil}
            </p>
        </div>

        <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
        

            <button
                type="button"
            
                class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                Editar
            </button>

            <button
                type="button"
                class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                Inactivar
            </button>


        </div>
    </div>


</template>
<script>
export default {
  props: {
    usuarioProp: Object, // Declara la prop con el mismo nombre
  },
};
</script>
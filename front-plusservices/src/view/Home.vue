<template>
  
  <!--FILTRO-->
  <div class="bg-gray-100 py-12">
    <h2 class="text-2xl md:text-4xl text-gray-600 text-center font-extrabold my-5">Buscar y Filtrar libros</h2>

    <div class="max-w-7xl mx-auto">
      
            <div class="md:grid md:grid-cols-2 gap-5">
                

              <div class="mb-4">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Titulo</label>
                    
                    <input type="text" v-model="filtro.titulo" id="filtro_titulo" class="w-full rounded-lg p-2 border" required>
               
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Categoria</label>
                    <select 
                     id="filtro_categoria_id"
                     v-model="filtro.categoria_id"
                        class="border-gray-300 p-2 w-full rounded-md" >
                       <option value="">Seleccione una categoria</option>  
                      <option v-for="opcion in categorias" :value="opcion.id">{{ opcion.nombre }}</option>
                  
                    </select>
                </div>

                
            </div>

            <div className="flex justify-end">
                <input
                
                @click="filtrarLibros()" 
                    type="submit"
                    class ="bg-indigo-500 hover:bg-indigo-600 transition-colors text-white text-sm font-bold mx-2 px-2 py-2 rounded cursor-pointer uppercase w-full md:w-auto"
                    value="Buscar"
                />
                <button @click="showModal = true" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Crear libro</button>

              
            </div>
    </div>
</div>
  <!--FIN FILTRO-->


  
  <!--LISTAR-->
  <div v-for="libro in libros" :key="libro.id"
    class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
        <div class="space-y-3">
            <a class="text-xl font-bold">
                {{libro.titulo}}  
            </a>
            <p class="text-sm text-gray-600 font-bold">
                {{libro.descripcion}}
            </p>
            <p class="text-sm text-gray-500">
                Fecha de lanzamiento: {{libro.fecha_lanzamiento}}
            </p>
           
        </div>

        <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
        
          <button v-if="libro.disponibilidad_fisica>0"
                type="button"
            
                @click="rentarLibro(libro.id,'fisico')" 
                class="bg-green-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                Rentar fisico
            </button>

            <button v-if="libro.disponibilidad_digital>0"
                type="button"
                @click="rentarLibro(libro.id,'digital')" 
                class="bg-green-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                Rentar digital
            </button>
            <button
                type="button"
            
                class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                Editar
            </button>

            <button
                type="button"
                @click="inactivarLibro(libro.id)" 
                class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                Inactivar
            </button>


        </div>
  </div>
  <!--FIN LISTAR-->
  <!--Modal-->

  <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal">
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <!-- Contenido del modal -->
        <div class="bg-white p-6 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Agregar Libro</h2>
            <form @submit.prevent="guardarLibro()">
                <!-- Campos del formulario -->
                <div class="mb-4">
                    <label for="titulo" class="block font-semibold mb-1">Título:</label>
                    <input type="text" v-model="libro.titulo" id="titulo" class="w-full rounded-lg p-2 border" required>
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block font-semibold mb-1">Descripcion:</label>
                    <input type="text" v-model="libro.descripcion" id="titulo" class="w-full rounded-lg p-2 border" required>
                </div>
                <div class="mb-4">
                    <label for="categoria_id" class="block font-semibold mb-1">Categoria:</label>
                    <select  v-model="libro.categoria_id" id="categoria_id" class="w-full rounded-lg p-2 border" required>                     
                      <option value="">Seleccione una categoria</option>  
                      <option v-for="opcion in categorias" :value="opcion.id">{{ opcion.nombre }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="fecha_lanzamiento" class="block font-semibold mb-1">Categoria:</label>
                    <input type="date" v-model="libro.fecha_lanzamiento" id="fecha_lanzamiento" class="w-full rounded-lg p-2 border" required>
                </div>
                <div class="mb-4">
                    <label for="disponibilidad_fisica" class="block font-semibold mb-1">Disponibilidad fisica:</label>
                    <input type="number" min="0" v-model="libro.disponibilidad_fisica" id="disponibilidad_fisica" class="w-full rounded-lg p-2 border" required>
                </div>
                <div class="mb-4">
                    <label for="disponibilidad_digital" class="block font-semibold mb-1">Disponibilidad Digital:</label>
                    <input type="number" min="0" v-model="libro.disponibilidad_digital" id="disponibilidad_digital" class="w-full rounded-lg p-2 border" required>
                </div>
                <!-- Otros campos del formulario -->

                <!-- Botón de guardar -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Guardar</button>
                    <button @click="showModal = false" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-full mt-4">Cerrar</button>
    
                  </div>
            </form>
        </div>
        <!-- Botón para cerrar el modal -->
        </div>
</div>

  </div>

</template>



<script>
// Puedes agregar lógica específica de App.vue aquí si es necesario
import clienteAxios from "../config/axios";
//import Libro from '../components/Libro.vue'
export default {
name: 'Home',

  //mixins: [UseUsuarios],
  data() {
    return {
      showModal: false,
      filtro:{
        categoria_id:'',
      },
      // Asigna el array importado a una propiedad de datos
      libros: [],
      categorias: [],
      libro: {
            titulo: '',
            image: '',
            categoria_id: null,
            descripcion: '',
            fecha_lanzamiento: '',
            disponibilidad_fisica: 0,
            disponibilidad_digital: 0
        },
    };
  },  methods: {

    abrirModal() {
      this.showModal = true;
    },
    cerrarModal() {
      this.showModal = false;
    },

    async rentarLibro(id,tipo_libro){
      const datos={
        id,
        tipo_libro,
    }
      try {
          this.errores=[]  
          const token =localStorage.getItem('AUTH_TOKEN');
          const {data} = await clienteAxios.post(`/api/libros/${id}/rentar`,datos,{
              headers:{
                  Authorization:`Bearer ${token}`
              }} ); 
      } catch (error) {  
      console.log('error')
      //this.errores=Object.values(error.response.data.errors);
    }
    },

    async  filtrarLibros() {
      //setIsLoading(true);
      try {
          this.errores=[]
          const token =localStorage.getItem('AUTH_TOKEN');
          const {data} = await clienteAxios.post('/api/libros/filtrar',this.filtro,{
              headers:{
                  Authorization:`Bearer ${token}`
              }} ); 
              this.libros=data.data;
      //setIsLoading(false);
      } catch (error) {
      //setIsLoading(false);   
      }
  },    

    async guardarLibro(){
      try {
          this.errores=[]  
          const token =localStorage.getItem('AUTH_TOKEN');
          const {data} = await clienteAxios.post('/api/libros',this.libro,{
              headers:{
                  Authorization:`Bearer ${token}`
              }} ); 

          this.cerrarModal();
          this.obtenerLibros();
      } catch (error) {  
      console.log('error')
      //this.errores=Object.values(error.response.data.errors);
    }
    },  
  async inactivarLibro(id){
    
    try {
          this.errores=[]  
          const token =localStorage.getItem('AUTH_TOKEN');
          const {data} = await clienteAxios.delete(`/api/libros/${id}`,{
              headers:{
                  Authorization:`Bearer ${token}`
              }} ); 
              this.obtenerLibros();
      } catch (error) {  
      }
  },
  async  obtenerCategorias() {
      //setIsLoading(true);
      try {
          this.errores=[]
          const token =localStorage.getItem('AUTH_TOKEN');
          const {data} = await clienteAxios('/api/categorias',{
              headers:{
                  Authorization:`Bearer ${token}`
              }} ); 
              this.categorias=data.data;
      //setIsLoading(false);
      } catch (error) {
      //setIsLoading(false);   
      }
  },
  async  obtenerLibros() {
      //setIsLoading(true);
      try {
          this.errores=[]
          const token =localStorage.getItem('AUTH_TOKEN');
          const {data} = await clienteAxios('/api/libros',{
              headers:{
                  Authorization:`Bearer ${token}`
              }} ); 
              this.libros=data.data;
      //setIsLoading(false);
      } catch (error) {
      //setIsLoading(false);   
      }
  },
},
  created:async function () {
    // Esta función se ejecutará cuando se cree el componente
    this.obtenerCategorias();
    this.obtenerLibros();

  },
};

</script>

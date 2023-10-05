<template>
    
      <h1 class="text-4xl font-black">Iniciar Sesion</h1>
      <p>Para crear y rentar libros debes iniciar sesion</p>
      <div class="bg-white shadow-md rounded-md mt-10 px-5 py-10">   
        <form
        @submit.prevent="handleSubmit"
        >

        <div v-if="errores">
          <Alerta v-for="(error, i) in errores" :key="i">{{ error[0] }}</Alerta>
        </div>
         
          <div class="mb-4">
            <label 
              htmlFor="email" 
              class="text-slate-800">
              Email
              </label>
            <input
              type="email"
              id="email"
              name="email"
              class="w-full mt-2 p-3 bg-gray-50 rounded-md"
              placeholder="Tu Email"
              v-model="login.emailRef"
              required
            />
          </div>

          <div class="mb-4">
            <label 
              htmlFor="password" 
              class="text-slate-800">
              Password
              </label>
            <input
              type="password"
              id="password"
              name="password"
              class="w-full mt-2 p-3 bg-gray-50 rounded-md"
              placeholder="Tu Password"
              v-model="login.passwordRef"
              required
            />
          </div>

      
          <input
            type="submit"
            value='Iniciar Sesion'
            class="bg-indigo-600 rounded-md hover:bg-indigo-800 text-white w-full mt-5 p-3 uppercase font-bold cursor-pointer"          
          />
        </form>
      </div>
      <div class="mt-5">
    <router-link to="/auth/registro">
      
      No tienes cuenta? crea una
    </router-link>
  </div>
    
    
</template>
<script>

import Alerta from "../components/Alerta.vue";

import { login }  from "../Hooks/UseAuth";

export default {
  name: 'Login',
  data(){
    return {
      
   errores: [],
      login:{
        emailRef:'',
        passwordRef:''
      }
    }
  },
  methods:{
    handleSubmit: async function(e) {
    e.preventDefault();
 
    const datos={
      email : this.login.emailRef,
      password :  this.login.passwordRef,
    }
    this.errores= await login(datos);
    console.log( this.errores)
   
  }
  
  }

  
}




// Puedes agregar lógica específica de App.vue aquí si es necesario

</script>

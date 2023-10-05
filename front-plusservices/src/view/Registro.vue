<template>
    
  <h1 className="text-4xl font-black">Crea tu cuenta</h1>
  <p>Crea tu cuenta llenando el formulario</p>
  <div class="bg-white shadow-md rounded-md mt-10 px-5 py-10">   
    <form
    @submit.prevent="handleSubmit"
    >

    <div v-if="errores">
      <Alerta v-for="(error, i) in errores" :key="i">{{ error[0] }}</Alerta>
    </div>
    
    <div className="mb-4">
            <label 
              htmlFor="name" 
              class="text-slate-800">
              Usuarios
              </label>
            <input
              type="text"
              id="name"
              name="name"
              class="w-full mt-2 p-3 bg-gray-50 rounded-md"
              placeholder="Tu nombre"
              
              v-model="registro.nameRef"
              required
            />
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
          v-model="registro.emailRef"
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
          v-model="registro.passwordRef"
          required
        />
      </div>

      <div className="mb-4">
            <label 
              htmlFor="password_confirmation" 
              className="text-slate-800">
              Repetir Password
              </label>
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              className="w-full mt-2 p-3 bg-gray-50 rounded-md"
              placeholder="Repetir Password"
              
              v-model="registro.passwordConfirmationRef"
              required
            />
          </div>
      <input
        type="submit"
        value='Crear Cuenta'
        class="bg-indigo-600 rounded-md hover:bg-indigo-800 text-white w-full mt-5 p-3 uppercase font-bold cursor-pointer"          
      />
    </form>
  </div>
  <div class="mt-5">
    <router-link to="/auth/login">
      ¿Tienes una cuenta? Inicia sesión
    </router-link>
  </div>
</template>
<script>

import Alerta from "../components/Alerta.vue";

import { Registro }  from "../Hooks/UseAuth";

export default {
name: 'Registro',
data(){
return {
  
errores: [],
  registro:{
    nameRef:'',
    emailRef:'',
    passwordRef:'',
    passwordConfirmationRef:''
  }
}
},
methods:{
handleSubmit: async function(e) {
e.preventDefault();

const datos={
  email : this.registro.emailRef,
  name :  this.registro.nameRef,
  password :  this.registro.passwordRef,
  password_confirmation :  this.registro.passwordConfirmationRef,
}
this.errores= await Registro(datos);

}

}


}




// Puedes agregar lógica específica de App.vue aquí si es necesario

</script>

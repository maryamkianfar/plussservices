import clienteAxios from "../config/axios";

export default {
    data(){
        return {
          
       errores: [],
    usuarios:[]
        }
      },
    methods: {

        async  obtenerLibross() {
            //setIsLoading(true);
            try {
                this.errores=[]
                const token =localStorage.getItem('AUTH_TOKEN');
                console.log(token)
                const {data} = await clienteAxios('/api/usuarios',{
                    headers:{
                        Authorization:`Bearer ${token}`
                    }} ); 
                    this.usuarios=data.data;
                    console.log(this.usuarios)
            //setIsLoading(false);
            } catch (error) {
            //setIsLoading(false);   
            }
        },

        async handleClickInactivarUsuario(id) {
            try { 
                const token =localStorage.getItem('AUTH_TOKEN');
                await clienteAxios.delete(`/api/usuarios/${id}`,{
                    headers:{
                        Authorization:`Bearer ${token}`,
                    }
                })
            await obtenerUsuarios();
            } catch (error) {
                throw Error(error?.response?.data?.errors)  
            
            }
        } 
    }

}



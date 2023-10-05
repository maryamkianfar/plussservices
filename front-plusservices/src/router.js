import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';




import AuthLayout from './layout/AuthLayout.vue';
import Layout from './layout/Layout.vue';


import Home from './view/Home.vue';
import Login from './view/Login.vue';
import Registro from './view/Registro.vue';





const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/', 
            component: Layout,meta: { requiresAuth: true},
            children:[
                {
                    path: '',
                    name:'home',
                    component: Home
                }, 
               
            ] 
        },
        {
        path:'/auth',
        component: AuthLayout,meta: {requiresAuth: false },
        children:[
            {
                path: 'login',
                name:'login',
                component: Login
            }, 
            {
                path: 'registro',
                name:'registro',
                component:Registro
            }
        ]
        },
    ],
  });


  router.beforeEach((to, from, next) => {
    const authToken = localStorage.getItem('AUTH_TOKEN');
    const isAuthenticated = authToken !== null && authToken !== '';
  
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
  
    if (requiresAuth && !isAuthenticated) {
      next({ name: 'login' }); // Redirige al inicio de sesión si no está autenticado y requiere autenticación
    } else if (isAuthenticated && (to.name === 'login' || to.name === 'registro')) {
      next({ name: 'home' }); // Si está autenticado y trata de acceder a login o registro, redirige al home
    } else {
      next();
    }
  });
  
  export default router;
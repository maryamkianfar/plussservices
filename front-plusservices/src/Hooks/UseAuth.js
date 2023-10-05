// auth.js

import clienteAxios from "../config/axios";

export async function login(datos) {
    try {
        const { data } = await clienteAxios.post('/api/login', datos);
        localStorage.setItem('AUTH_TOKEN', data.token);
        window.location.href = '/'
        return null; // Opcionalmente, puedes devolver un valor para indicar éxito.
    } catch (error) {
        return Object.values(error.response.data.errors);
    }
}
export async function Registro(datos) {
    try {
        const { data } = await clienteAxios.post('/api/registro', datos);
        localStorage.setItem('AUTH_TOKEN', data.token);
        window.location.href = '/'
        return null; // Opcionalmente, puedes devolver un valor para indicar éxito.
    } catch (error) {
        return Object.values(error.response.data.errors);
    }
}

export async function CerrarSesion() {
    const token = localStorage.getItem('AUTH_TOKEN');
    try {
        await clienteAxios.post('/api/logout', null, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        localStorage.removeItem('AUTH_TOKEN');
        window.location.href = '/'
        return null; // Opcionalmente, puedes devolver un valor para indicar éxito.
    } catch (error) {
        throw Error(error?.response?.data?.errors);
    }
}

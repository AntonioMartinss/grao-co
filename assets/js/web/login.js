import {
    HttpUser
} from '../classes/HttpUser.js';

import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
} from "./../_shared/functions.js";

const api = new HttpUser();

const formLogin = document.querySelector("#formLogin");
formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();

    try {
        const data = await api.loginUser(new FormData(formLogin))
        if (data.type == "error" || data.type == "warning") {
            showToast(data.message, data.type);
            return;
        }
        localStorage.setItem("userAuth", JSON.stringify(data.user));
        showToast(`Olá, ${getFirstName(data.user.name)} como vai!`);
        setTimeout(() => {
            window.location.href = getBackendUrl("app/perfil");
        }, 2000);
    } catch (error) {
        console.log('Erro na requisição', error)
    }
})


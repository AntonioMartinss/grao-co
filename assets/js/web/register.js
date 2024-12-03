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

const formRegister = document.querySelector("#formRegister");
formRegister.addEventListener("submit",async (event) => {
    event.preventDefault();

    try {
        const users = await api.createUser(new FormData(formRegister));
        showToast(users.message);
    } catch (error) {
        console.error('Erro na requisição:', error);
    }


    // const data = await fetch(`http://localhost/grao-co/api/users`,{
    //     method: "POST",
    //     body: new FormData(formRegister)
        
    // });

});

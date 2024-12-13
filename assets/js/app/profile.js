import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
} from "./../_shared/functions.js";
import {
    HttpUser
} from '../classes/HttpUser.js';

import {
    userAuth
} from "./../_shared/globals.js";

const api = new HttpUser();

fetch(getBackendUrlApi("users/me"), {
    method: "GET",
    headers: {
        token: userAuth.token
    }
}).then((response) => {
    response.json().then((data) => {
        if (data.error) {
            setTimeout(() => {
                window.location.href = getBackendUrl("entrar");
            }, 3000);
        }


        document.querySelector(".container-info").innerHTML = `
         <form id="formUpdate">
                    <input type="name" name="name" value="${data.user.name}" placeholder="Novo nome - ${data.user.name}"/> 
                    <input type="email" name="email" value="${data.user.email}" placeholder="Novo email" />
                    <input type="submit" value="Atualizar conta" />
                        <div class="toast-container"></div>
                    </form>

                <button id="logout-btn">Sair agora</button>
        `;
        document.querySelector("img").setAttribute("src", getBackendUrl(data.user.photo));

        const LogoutBtn = document.querySelector("#logout-btn");
        LogoutBtn.addEventListener("click", async (e)=>{
            e.preventDefault()
            localStorage.removeItem("userAuth");
            window.location.href = getBackendUrl("entrar");
        })


        const formUpdate = document.querySelector("#formUpdate");
        formUpdate.addEventListener("submit", async (e) => {
            e.preventDefault();
            const userId = data.user.id;

            const formData = new FormData(formUpdate);

            try {
                const user = await api.update(userId, formData);
                if (user.type == "error" || user.type == "warning") {
                    showToast(user.message, user.type);
                } else {
                    showToast(user.message, user.type);

                }
            } catch (error) {
                console.error('Erro na requisição:', error);
            }

        })




    });

});


const formPhoto = document.querySelector("#form-photo");
formPhoto.addEventListener("submit", (e) => {
    e.preventDefault();
    fetch(getBackendUrlApi("users/photo"), {
        method: "POST",
        body: new FormData(formPhoto),
        headers: {
            token: userAuth.token
        }
    }).then((response) => {

        response.json().then((data) => {
            if (data.error) {
                console.log(data.error.message);
                return;
            }
            console.log("Foto atualizada com sucesso!");

            document.querySelector("img").setAttribute("src", getBackendUrl(data.user.photo));
            userAuth.photo = data.user.photo;
            localStorage.setItem("userAuth", JSON.stringify(userAuth));
            location.reload();
        });
    });
});



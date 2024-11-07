import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
} from "./../_shared/functions.js";

import {
    userAuth
} from "./../_shared/globals.js";


fetch(getBackendUrlApi("users/me"), {
    method: "GET",
    headers: {
        token: userAuth.token
    }
}).then((response) => {
    response.json().then((data) => {
        if (data.error) {
            setTimeout(() => {
                window.location.href = getBackendUrl();
            }, 3000);
        }

        
        document.querySelector(".container-info").innerHTML = `
         <div class="edit-name">
            <input type="text" name="name" disabled placeholder="${data.user.name}">
                <button class="btn-edit"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
        </div>
        <div class="edit-email">
            <input type="text" name="email" disabled placeholder="${data.user.email}">
                <button class="btn-edit"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
        </div>
        `;
        document.querySelector("img").setAttribute("src", getBackendUrl(data.user.photo));
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
            if(data.error) {
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



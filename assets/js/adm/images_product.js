import {
    showDataForm,
    getBackendUrlApi, getBackendUrl, showToast
} from "./../_shared/functions.js";

import {
    userAuth
} from "./../_shared/globals.js";

const response = await fetch(getBackendUrlApi('products/list'), {
    method: "get"
});
const products = await response.json(); 

const selectProducts = document.querySelector("#products_id");
products.forEach((product) => {
    const option = document.createElement("option");
    option.value = product.id;
    option.textContent = product.id + " - " + product.name;
    selectProducts.appendChild(option);
});
const formInsertImages = document.querySelector(".formImages");

formInsertImages.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(formInsertImages); 

    fetch(getBackendUrlApi("images/insert"), {
        method: "POST",
        body: formData,
        headers: {
            token: userAuth.token
        }
    }).then((response) => {
        response.json().then((data) => {
            if (data.type === "error") {
                showToast(`${data.message}!`);
            } else {
                showToast(`${data.message}!`);
            }
        });
    }).catch((error) => {
        console.log("Erro ao enviar a imagem:", error);
    });
});

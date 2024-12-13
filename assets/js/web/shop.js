import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
} from "./../_shared/functions.js";

import {
    userAuth
} from "./../_shared/globals.js";


fetch(getBackendUrlApi("products/list"))
    .then((response) => {
        response.json().then((products) => {
            products.forEach((product) => {
                document.querySelector(".product-container").innerHTML += `
        <div class="product">
        <img src="${product.path}">
        <h3>${product.name}</h3>
        <p style="
        color: #333;
        font-size: 0.9em;
        line-height: 1.5;
        text-align: center;
        margin-right: 10px;
        margin-left: 10px;
        opacity: 0.7;
        font-family: JetBrains Mono;
        ">
        ${product.description}
        </p>
        <p>Tipo - ${product.category_name}</p>
        <button id="btnBuy">Adicionar ao carrinho</button>
        `
            });
        })
    })
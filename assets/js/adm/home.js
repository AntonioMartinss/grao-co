import {
    showDataForm,
    getBackendUrlApi, getBackendUrl, showToast
} from "./../_shared/functions.js";

import {
    userAuth
} from "./../_shared/globals.js";

const formInsertProduct = document.querySelector("#form-insert")

formInsertProduct.addEventListener("submit", async (e) => {
    e.preventDefault();

    fetch(getBackendUrlApi("products/insert"), {
        method: "POST",
        body: new FormData(formInsertProduct),
        headers: {
            token: userAuth.token
        }
    }).then((response) => {
        response.json().then((data) => {
            let response = data
            showToast(`${response}`);
        });
    });

});

const formInsertCategory = document.querySelector("#form-insert-category")

formInsertCategory.addEventListener("submit", async (e) => {
    e.preventDefault();

    fetch(getBackendUrlApi("categories/insert-category"), {
        method: "POST",
        body: new FormData(formInsertCategory),
        headers: {
            token: userAuth.token
        }
    }).then((response) => {
        response.json().then((data) => {
            let response = data
            console.log(response)
        });
    });

});


import {
    showDataForm,
    getBackendUrlApi, getBackendUrl, showToast
} from "./../_shared/functions.js";

import {
    userAuth
} from "./../_shared/globals.js";

const formInsertProduct = document.querySelector("#form-insert")


const response = await fetch(getBackendUrlApi('categories/list'), {
    method: "get"
});

const categories = await response.json(); 

const selectCategories = document.querySelector("#categories_id");
categories.forEach((category) => {
    const option = document.createElement("option");
    option.value = category.id;
    option.textContent = category.name;
    selectCategories.appendChild(option);
});



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
            if(data){
                console.log(data)
                let response = data
                showToast(`${response.message}!`);
            }else{
                showToast(`${response.message}!`);
            }
            
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
            if(data){
                console.log(data)
                let response = data
                showToast(`${response.message}!`);
            }else{
                showToast(`${response.message}!`);
            }
        });
    });

});

const formInsertOrder = document.querySelector("#form-insert-order")

formInsertOrder.addEventListener("submit", async (e) => {
    e.preventDefault();

    fetch(getBackendUrlApi("orders/insert"), {
        method: "POST",
        body: new FormData(formInsertOrder),
        headers: {
            token: userAuth.token
        }
    }).then((response) => {
        response.json().then((data) => {
            if(data){
                console.log(data)
                let response = data
                showToast(`${response.message}!`);
            }else{
                showToast(`${response.message}!`);
            }
        });
    });

});


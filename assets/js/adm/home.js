import {
    HttpProduct
  } from '../classes/HttpProduct.js';
  import {
    HttpUser
  } from '../classes/HttpUser.js';
  
import {
    showDataForm,
    getBackendUrlApi, getBackendUrl, showToast
} from "./../_shared/functions.js";

import {
    userAuth
} from "./../_shared/globals.js";

const apiProduct = new HttpProduct();

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

    try {
        const products = await apiProduct.insert(new FormData(formInsertProduct));
        if(products){
            console.log(products)
            let response = products
            showToast(`${response.message}!`);
        }else{
            showToast(`${response.message}!`);
        }
    } catch (error) {
        console.error('Erro na requisição:', error);
    }
            
            
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


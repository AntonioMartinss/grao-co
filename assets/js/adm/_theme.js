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
                window.location.href = getBackendUrl("entrar");
            });
        }
    });
    
    
});
import {
  getBackendUrl,
  getBackendUrlApi,
  getFirstName,
  showToast
} from "./../_shared/functions.js";

import {
  userAuth
} from "./../_shared/globals.js";


const formLogin = document.querySelector("#formAdmin");

formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();
  fetch(getBackendUrlApi("users/admin"), {
      method: "POST",
      body: new FormData(formLogin)
  }).then((response) => {
      response.json().then((data) => {
          if (data.type == "error") {
              showToast(data.message);
              return;
          }
          localStorage.setItem("userAuth", JSON.stringify(data.user));
          showToast(`Olá, ${getFirstName(data.user.name)} bom trabalho!`);
          setTimeout(() => {
              window.location.href = getBackendUrl("admin/inicio");
              
          }, 3000);
      })
  })
});

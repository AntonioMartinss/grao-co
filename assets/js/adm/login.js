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

const formLogin = document.querySelector("#formAdmin");
formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();

  try {
      const data = await api.loginAdmin(new FormData(formLogin))
      if (data.type == "error" || data.type == "warning") {
          showToast(data.message, data.type);
          return;
      }
      localStorage.setItem("userAuth", JSON.stringify(data.user));
      showToast(`Olá, ${getFirstName(data.user.name)} bom trabalho!`);
      setTimeout(() => {
          window.location.href = getBackendUrl("admin/inicio");
      }, 2000);
  } catch (error) {
      console.log('Erro na requisição', error)
  }
})
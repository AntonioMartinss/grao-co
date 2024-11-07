import {
  getBackendUrl,
  getBackendUrlApi,
  getFirstName,
  showToast
} from "./../_shared/functions.js";


const formLogin = document.querySelector("#formLogin");
formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();
    fetch(getBackendUrlApi("users/login"), {
        method: "POST",
        body: new FormData(formLogin)
    }).then((response) => {
        response.json().then((data) => {
            if (data.type == "error") {
                showToast(data.message);
                return;
            }
            localStorage.setItem("userAuth", JSON.stringify(data.user));
            showToast(`Olá, ${getFirstName(data.user.name)} como vai!`);
            setTimeout(() => {
                window.location.href = getBackendUrl("app/perfil");
            }, 3000);
        }) 
    })
  })

import {
    HttpUser
  } from '../classes/HttpUser.js';
  
  import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
  } from "./../_shared/functions.js";
  
import {
    userAuth
} from "./../_shared/globals.js";

const api = new HttpUser();

document.querySelector(".container-table").innerHTML = `
<div class="list">
<table>
<thead>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Senha</th>
<th>URL</th>
<th>Plano</th>
<th>Categoria de Usuário</th>
<th>Editar</th>
<th>Excluir</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
`;

try {
    const listUsers = await api.list();
    renderUsers(listUsers);
} catch (error) {
    console.error('Erro na requisição:', error);
}

function renderUsers (listUsers) {

    listUsers.forEach((event) => {
        document.querySelector("tbody").innerHTML += `
    <tr>
      <td>${event.id}</td>
  <td><input type="text" name="name" value="${event.name}" disabled></td>
  <td><input type="email" name="email" value="${event.email}" disabled></td>
  <td><input type="password" name="password" value="${event.password}" disabled></td>
  <td><input type="url" name="url" value="${event.url}" disabled></td>
  <td><input type="text" name="plans_id" value="${event.plans_id}" disabled></td>
  <td><input type="text" name="usersCategories_id" value="${event.usersCategories_id}" disabled></td>
      <td><button class="edit-btn"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button></td>
       <td><button class="delete-btn"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></td>
    </tr>`;
    });

    document.querySelectorAll(".edit-btn").forEach((btnEdit) => {
        btnEdit.addEventListener("click", () => {
            const inputs = btnEdit.parentElement.parentElement.querySelectorAll('input');
            const userId = btnEdit.parentElement.parentElement.querySelector('td:first-child').textContent;

            const isDisabled = inputs[0].disabled;

            if (isDisabled) {
                inputs.forEach(input => {
                    input.disabled = false;
                });
            } else {
                const update = {
                    id: userId

                };

                inputs.forEach(input => {
                    update[input.name] = input.value;
                });

                fetch(getBackendUrlApi(`users/update/${userId}`), {
                    method: 'PUT',
                    headers: {
                        token: userAuth.token,
                        'Content-type': 'application/json'
                    },
                    body: JSON.stringify(update)
                }).then((response) => {
                    response.json().then((data) => {
                        if (data.success) {
                            inputs.forEach(input => {
                                input.disabled = true;
                            });
                        } else {
                            console.error('Erro ao atualizar:', data.message);
                        }
                    });
                });
            }
        });
    });
}


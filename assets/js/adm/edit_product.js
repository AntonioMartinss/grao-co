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
      products.forEach((event) => {
        document.querySelector("tbody").innerHTML += `
          <tr>
            <td>${event.id}</td>
            <td><input type="text" name="name" value="${event.name}" disabled></td>
            <td><input type="number" name="value" value="${event.value}" disabled></td>
            <td><input type="text" name="description" value="${event.description}" disabled></td>
            <td><input type="number" name="quantity" value="${event.quantity}" disabled></td>
            <td><input type="text" name="url" value="${event.url}" disabled></td>
            <td><input type="number" name="categories_id" value="${event.categories_id}" disabled></td>
            <td><button class="edit-btn"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button></td>
            <td><button class="delete-btn"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></td>
          </tr>`;
      });

      document.querySelectorAll(".edit-btn").forEach((btnEdit) => {
        btnEdit.addEventListener("click", () => {
          const inputs = btnEdit.parentElement.parentElement.querySelectorAll('input');
          const productId = btnEdit.parentElement.parentElement.querySelector('td:first-child').textContent;

          const isDisabled = inputs[0].disabled;

          if (isDisabled) {
            inputs.forEach(input => {
              input.disabled = false;
            });
          } else {
            const update = {
              id: productId
            };

            inputs.forEach(input => {
              update[input.name] = input.value;
            });

            fetch(getBackendUrlApi(`products/update-product/${productId}`), {
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
                  showToast(`Produto Atualizado na Base de Dados!`);
                } else {
                  showToast(`Produto não Atualizado na Base de Dados!`);
                }
              });
            });
          }
        });
      });

      document.querySelectorAll(".delete-btn").forEach((deleteBtn) => {
        deleteBtn.addEventListener("click", () => {
          const productId = deleteBtn.parentElement.parentElement.querySelector('td:first-child').textContent;

          fetch(getBackendUrlApi(`products/delete-product/${productId}`), {
            method: 'DELETE',
            headers: {
                token: userAuth.token,
            },
        }).then((response) => {
            response.json().then((data) => {
                if (data.success) {
                    showToast(`Produto Excluído da Base de Dados!`);
                    return;
                } else {
                  showToast(`Produto não Excluído da Base de Dados!`);
                }
            });
        });
        
          
        });
      });
    });
  });











document.querySelector(".container-table").innerHTML = `

<div class="list">
<table>
<thead>
<tr>
<th>ID </th>
<th>Nome</th>
<th>Valor</th>
<th>Descrição</th>
<th>Quantidade</th>
<th>URL</th>
<th>Categoria</th>

</tr>
</thead>
<tbody>

</tbody>
</table>
</div>
`
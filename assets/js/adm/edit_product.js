import {
  getBackendUrl,
  getBackendUrlApi,
  getFirstName,
  showToast
} from "./../_shared/functions.js";

import {
  userAuth
} from "./../_shared/globals.js";

let message = document.querySelector(".message-product")


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

          console.log(productId)



          const isDisabled = inputs[0].disabled;

          if (isDisabled) {
            inputs.forEach(input => {
              input.disabled = false;
            });
          } else {
            const update = {
              id: productId,
              name: inputs[0].value,        
              value: inputs[1].value,
              description: inputs[2].value,
              quantity: inputs[3].value,
              url: inputs[4].value,
              categories_id: inputs[5].value
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

    document.querySelector(".formSearch").addEventListener("submit", (e) => {
      e.preventDefault();
      const productIdInput = document.querySelector('input[name="product_id"]');
      const productId = productIdInput.value;
    
      fetch(getBackendUrlApi(`products/list/${productId}`), {
        method: 'GET'
      }).then((response) => {
        response.json().then((product) => {
          if (product) {
            const event = product[0]; 
            document.querySelector("tbody").innerHTML = ` 
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
          } else {
            document.querySelector(".message-product").innerHTML = `Produto com ID ${productId} não encontrado.`;
          }
        });
      });
    });
    
    document.querySelector('input[name="product_id"]').addEventListener('input', (e) => {
      if (e.target.value === '') {
        location.reload();
      }
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
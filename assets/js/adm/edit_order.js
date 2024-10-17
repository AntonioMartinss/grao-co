import {
  getBackendUrl,
  getBackendUrlApi,
  getFirstName,
  showToast
} from "./../_shared/functions.js";

import {
  userAuth
} from "./../_shared/globals.js";



fetch(getBackendUrlApi("orders/list"))
  .then((response) => {
    response.json().then((order) => {
      order.forEach((event) => {
        document.querySelector("tbody").innerHTML += `
            <tr>
              <td>${event.id}</td>
              <td><input type="number" name="total" value="${event.total}" disabled></td>
              <td><input type="number" name="quantity" value="${event.quantity}" disabled></td>
              <td><input type="text" name="description" value="${event.description}" disabled></td>
              <td><input type="number" name="users_id" value="${event.users_id}" disabled></td>
              <td><button class="edit-btn"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button></td>
              <td><button class="delete-btn"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></td>
            </tr>`;
      });

      document.querySelectorAll(".edit-btn").forEach((btnEdit) => {
        btnEdit.addEventListener("click", () => {
          const inputs = btnEdit.parentElement.parentElement.querySelectorAll('input');
          const orderId = btnEdit.parentElement.parentElement.querySelector('td:first-child').textContent;

          const isDisabled = inputs[0].disabled;

          if (isDisabled) {
            inputs.forEach(input => {
              input.disabled = false;
            });
          } else {
            const update = {
              id: orderId

            };

            inputs.forEach(input => {
              update[input.name] = input.value;
            });

            fetch(getBackendUrlApi(`orders/update-order/${orderId}`), {
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
                  showToast(`${data.message}!`);
                } else {
                  showToast(`${data.message}!`);
                }
              });
            });
          }
        });
      });

      document.querySelectorAll(".delete-btn").forEach((deleteBtn) => {
        deleteBtn.addEventListener("click", () => {
          const orderId = deleteBtn.parentElement.parentElement.querySelector('td:first-child').textContent;

          fetch(getBackendUrlApi(`orders/delete-order/${orderId}`), {
            method: 'DELETE',
            headers: {
              token: userAuth.token,
            },
          }).then((response) => {
            response.json().then((data) => {
              if (data.success) {
                showToast(`${data.message}!`);
                return;
              } else {
                showToast(`${data.message}!`);
              }
            });
          });


        });
      });

      document.querySelector(".formSearch").addEventListener("submit", (e) => {
        e.preventDefault();
        const orderIdInput = document.querySelector('input[name="id"]');
        const orderId = orderIdInput.value;

        fetch(getBackendUrlApi(`orders/list/${orderId}`), {
          method: 'GET'
        }).then((response) => {
          response.json().then((order) => {
            if (order) {
              const event = order[0];
              document.querySelector("tbody").innerHTML = ` 
                   <tr>
              <td>${event.id}</td>
              <td><input type="text" name="total" value="${event.total}" disabled></td>
              <td><input type="text" name="total" value="${event.quantity}" disabled></td>
              <td><input type="text" name="total" value="${event.description}" disabled></td>
              <td><input type="text" name="total" value="${event.users_id}" disabled></td>
              <td><button class="edit-btn"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button></td>
              <td><button class="delete-btn"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></td>
            </tr>`;
            } else {
              document.querySelector(".message-category").innerHTML = `Categoria com ID ${categoryId} não encontrado.`;
            }
          });
        });
      });

      document.querySelector('input[name="id"]').addEventListener('input', (e) => {
        if (e.target.value === '') {
          location.reload();
        }
      });
    });
  });




document.querySelector(".container-table").innerHTML = `
  
  <div class="list">
  <table>
  <thead>
  <tr>
  <th>ID </th>
  <th>Total</th>
  <th>Quantidade</th>
  <th>Descrição</th>
  <th>ID do Usuário</th>
  </tr>
  </thead>
  <tbody>
  
  </tbody>
  </table>
  </div>
  `
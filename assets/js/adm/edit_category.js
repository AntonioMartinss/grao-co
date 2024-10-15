import {
    getBackendUrl,
    getBackendUrlApi,
    getFirstName,
    showToast
  } from "./../_shared/functions.js";
  
  import {
    userAuth
  } from "./../_shared/globals.js";
  
  
  
  fetch(getBackendUrlApi("categories/list"))
    .then((response) => {
      response.json().then((category) => {
        category.forEach((event) => {
          document.querySelector("tbody").innerHTML += `
            <tr>
              <td>${event.id}</td>
              <td><input type="text" name="name" value="${event.name}" disabled></td>
              <td><button class="edit-btn"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button></td>
              <td><button class="delete-btn"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></td>
            </tr>`;
        });
  
        document.querySelectorAll(".edit-btn").forEach((btnEdit) => {
          btnEdit.addEventListener("click", () => {
            const inputs = btnEdit.parentElement.parentElement.querySelectorAll('input');
            const categoryId = btnEdit.parentElement.parentElement.querySelector('td:first-child').textContent;
  
            const isDisabled = inputs[0].disabled;
  
            if (isDisabled) {
              inputs.forEach(input => {
                input.disabled = false;
              });
            } else {
              const update = {
                id: categoryId
                
              };
  
              inputs.forEach(input => {
                update[input.name] = input.value;
              });
  
              fetch(getBackendUrlApi(`categories/update-category/${categoryId}`), {
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
                    showToast(`Categoria Atualizada na Base de Dados!`);
                  } else {
                    showToast(`Categoria não Atualizada na Base de Dados!`);
                  }
                });
              });
            }
          });
        });
  
        document.querySelectorAll(".delete-btn").forEach((deleteBtn) => {
          deleteBtn.addEventListener("click", () => {
            const categoryId = deleteBtn.parentElement.parentElement.querySelector('td:first-child').textContent;
  
            fetch(getBackendUrlApi(`categories/delete-category/${categoryId}`), {
              method: 'DELETE',
              headers: {
                  token: userAuth.token,
              },
          }).then((response) => {
              response.json().then((data) => {
                  if (data.success) {
                      showToast(`Categoria Excluída da Base de Dados!`);
                      return;
                  } else {
                    showToast(`Categoria não Excluída da Base de Dados!`);
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
  <th>Categoria</th>
  
  
  </tr>
  </thead>
  <tbody>
  
  </tbody>
  </table>
  </div>
  `
  
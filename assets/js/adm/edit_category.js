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
            const categoryId = deleteBtn.parentElement.parentElement.querySelector('td:first-child').textContent;
  
            fetch(getBackendUrlApi(`categories/delete-category/${categoryId}`), {
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
          const categoryIdInput = document.querySelector('input[name="id"]');
          const categoryId = categoryIdInput.value;
        
          fetch(getBackendUrlApi(`categories/list/${categoryId}`), {
            method: 'GET'
          }).then((response) => {
            response.json().then((category) => {
              if (category) {
                const event = category[0]; 
                document.querySelector("tbody").innerHTML = ` 
                   <tr>
              <td>${event.id}</td>
              <td><input type="text" name="name" value="${event.name}" disabled></td>
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
  <th>Categoria</th>
  
  
  </tr>
  </thead>
  <tbody>
  
  </tbody>
  </table>
  </div>
  `
  
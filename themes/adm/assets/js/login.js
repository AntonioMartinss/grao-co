const formLogin = document.querySelector("#formAdmin");

formLogin.addEventListener("submit", async (event) => {
  event.preventDefault();

  const response = await fetch('http://localhost/grao-co/api/users/admin', {
    method: 'POST',
    body: new FormData(formAdmin)
  });

    const result = await response.json();
    console.log(result);

    const token = result.user.token;

    if (token) {
      localStorage.setItem('token', token);
      console.log('Logado, Salvo no LocalStorage.');
    } else {
      console.error('Falha no login: token não encontrado na resposta.');
    }
  
});

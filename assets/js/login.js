
const formRegister = document.querySelector("#formLogin");
formRegister.addEventListener("submit",async (event) => {

    event.preventDefault();
    const data = await fetch(`http://localhost/grao-co/api/login`,{
        method: "POST",
        body: new FormData(formLogin)
        
    });

    const user = await data.json();
    console.log(user);
});

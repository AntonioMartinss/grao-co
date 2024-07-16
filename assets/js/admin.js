
const formRegister = document.querySelector("#formAdmin");
formRegister.addEventListener("submit",async (event) => {

    event.preventDefault();
    const data = await fetch(`http://localhost/grao-co/api/admin`,{
        method: "POST",
        body: new FormData(formAdmin)
        
    });

    const user = await data.json();
    console.log(user);
});

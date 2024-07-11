
const formRegister = document.querySelector("#formRegister");
formRegister.addEventListener("submit",async (event) => {

    event.preventDefault();
    const data = await fetch(`http://localhost/grao-co/api/users`,{
        method: "POST",
        body: new FormData(formRegister)
        
    });
    console.log(data)

    const user = await data.json();
    console.log(user);
});

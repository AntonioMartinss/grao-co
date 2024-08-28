const formInsertProduct = document.querySelector("#form-insert")

formInsertProduct.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = await fetch(`http://localhost/grao-co/api/products/insert-product`, {
        method: "POST",
        body: new FormData(formInsertProduct)

    });

    const product = await data.json();
    console.log(product);

});


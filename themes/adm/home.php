<?php
$this->layout("_theme");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/css/adm/home.css"); ?>">
    <script type="module" src="<?= url("assets/js/adm/home.js"); ?>" async></script>
    <title>Administrativo - Grao & Co.</title>
</head>

<body>

    <main>

        <div class="container">
            <div class="form-products">

                <form id="form-insert">
                    <h2>Cadastro de Produtos</h2>
                    <input type="text" name="name" placeholder="Nome do Produto" required>
                    <input type="number" name="value" placeholder="Valor R$" required>
                    <input type="number" name="quantity" placeholder="Quantidade" required>
                    <textarea name="description" placeholder="Descrição do Produto" required></textarea>
                    <input type="text" name="url" placeholder="URL da Imagem" required>
                    <select name="categories_id" required>
                        <option disabled selected>Selecione a categoria</option>
                        <option value="1">Grãos</option>
                        <option value="2">Torrado</option>
                        <option value="3">Moído</option>
                        <option value="4">Solúvel</option>
                        <option value="5">Orgânico</option>
                    </select>
                    <input type="submit" value="Cadastrar Produto">
                </form>
            </div>
            <div class="form-products">

                <form id="form-insert-category">
                    <h2>Cadastro de Categoria</h2>
                    <input type="text" name="name" placeholder="Nome da Categoria" required>
                    
                    <input type="submit" value="Cadastrar Categoria">
                </form>
            </div>
            <div class="toast-container" ></div>
        </div>


    </main>


</body>

</html>
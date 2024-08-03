<?php
$this->layout("_theme");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("themes/adm/assets/css/home.css"); ?>">
    <title>Início Admin - Grao & Co.</title>
</head>

<body>

    <main>

        <div class="container">
            <div class="form-products">

                <form id="form-insert">
                    <h2>Cadastro de Produtos</h2>
                    <input type="text" name="name" placeholder="Nome do Produto" required>
                    <input type="number" name="value" placeholder="Valor R$" required>
                    <textarea name="description" placeholder="Descrição do Produto" required></textarea>
                    <input type="number" name="quantity" placeholder="Quantidade" required>
                    <input type="text" name="url" placeholder="URL da Imagem" required>

                    <input type="submit" value="Cadastrar Produto">
                </form>
            </div>
        </div>


    </main>


</body>

</html>
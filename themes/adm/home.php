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
                    <select name="categories_id" id="categories_id" required>
                        <option disabled selected>Selecione a categoria</option>
                        
                    </select>
                    <input type="submit" value="Cadastrar Produto">
                </form>
            </div>
            <div class="form-products">

                <form id="form-insert-order">
                    <h2>Cadastro de Pedidos</h2>
                    <input type="number" name="total" placeholder="Valor total do pedido" required>
                    <input type="number" name="quantity" placeholder="Quantidade de itens" required>
                    <input type="text" name="description" placeholder="Descrição para fácil busca" required>
                    <input type="number" name="users_id" placeholder="ID do usuário que solicitou" required>

                    <input type="submit" value="Cadastrar Pedido">
                </form>
            </div>
            <div class="form-products">

                <form id="form-insert-category">
                    <h2>Cadastro de Categoria</h2>
                    <input type="text" name="name" placeholder="Nome da Categoria" required>

                    <input type="submit" value="Cadastrar Categoria">
                </form>
            </div>

            
        </div>
        <div class="toast-container"></div>

    </main>


</body>

</html>
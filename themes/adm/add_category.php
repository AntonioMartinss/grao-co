<?php
$this->layout("_theme");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/css/adm/home.css"); ?>">
    <script type="module" src="<?= url("assets/js/adm/add_category.js"); ?>" async></script>
    <title>Cadastrar Categoria</title>
</head>

<body>

    <main>

        <div class="container">
            <div class="form-products">

                <form id="form-insert">
                    <h2>Cadastro de Categoria</h2>
                    <input type="text" name="name" placeholder="Nome da Categoria" required>
                    <input type="submit" value="Cadastrar Categoria">
                </form>
            </div>
        </div>


    </main>


</body>

</html>
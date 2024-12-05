<?php
$this->layout("_theme");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="<?= url("assets/css/adm/edit_product.css"); ?>">
    <script type="module" src="<?= url("assets/js/adm/edit_users.js"); ?>" async></script>
    <title>Editar Usuários</title>
</head>

<body>

<main>
    <div class="container">
        <div class="container-edit">
            <h2>Editar Usuários</h2>
        </div>
        <div class="container-table">
            <table>
                <tbody>
                    <!-- Conteúdo vindo do Banco -->
                </tbody>
            </table>
        </div>
        <div class="toast-container"></div>
    </div>
</main>


</body>

</html>
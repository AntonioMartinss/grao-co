<?php
$this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/admin.css">
    <script src="assets/js/admin.js" async></script>
    <title>Administração - Grao & Co.</title>
</head>

<body>

    <main>
        <form class="form-admin" id="formAdmin">
            <span>Acesso Administrativo:</span>
            <input type="email" name="email"  placeholder="E-mail">
            <input type="password" name="password"  placeholder="Senha">
            <input type="submit" value="Entrar">
        </form>
    </main>
</body>

</html>
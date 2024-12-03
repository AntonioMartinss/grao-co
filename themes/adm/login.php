
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/css/adm/login.css"); ?>">
    <link rel="stylesheet" href="<?= url("assets/css/adm/_theme.css"); ?>">
    <script src="https://kit.fontawesome.com/e9ad9d0028.js" crossorigin="anonymous"></script>
    <script type="module" src="assets/js/adm/login.js" async></script>
    <title>Login - Grao & Co.</title>
</head>

<body>
<header>
    <div class="header-name">
        <h1 onclick="window.location.href = '<?= url(""); ?>'">GRÃO & CO.</h1>
    </div>
    <div class="links">
    <ul>
        <a href="<?= url();?>"><li>Inicio</li></a>
        <a href="<?= url("loja");?>"><li>Loja</li></a>
        <a href="<?= url("sobre");?>"><li>Sobre</li></a>
    </ul>
    </div>
    <div class="icons">
        <button><i class="fa-solid fa-cart-shopping" style="color: #000;"></i></button>


        <button onclick="window.location.href = '<?= url("entrar"); ?>'"><i class="fa-regular fa-user" style="color: #000;"></i></button>

    </div>
   </header>

    <main>
        <form class="form-admin" id="formAdmin">
            <span>Acesso Administrativo:</span>
            <input type="email" name="email"  placeholder="E-mail">
            <input type="password" name="password"  placeholder="Senha">
            <input type="submit" value="Entrar">
            <div class="toast-container" ></div>
        </form>
        
    </main>

</body>

</html>
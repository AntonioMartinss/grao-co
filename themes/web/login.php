<?php
    $this->layout("_theme");
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/web/login.css">
    <script src="https://kit.fontawesome.com/e9ad9d0028.js" crossorigin="anonymous"></script>
    <script type="module" src="assets/js/web/login.js" async></script>
    
    <title>Entrar</title>
</head>

<body>
    
    <main>
        <div class="container">
            <div class="form-login">
                <div class="form-img">
                    <img src="assets/images/web/login-image.svg" alt="user-image" />
                </div>
                <form id="formLogin">
                        <span>Já é cliente? Faça o login.</span>
                    <input type="email" name="email" id="" placeholder="E-mail" />
                    <input type="password" name="password" placeholder="Senha">
                    <input type="submit" value="Entrar" />
                        <a href="<?= url("cadastro")?>"><span>Novo aqui? Cadastre-se. <i class="fa-solid fa-up-right-from-square" style="color: #1a1a1a;"></i></span></a>
                </form>
                <div class="toast-container"></div>
            </div>
           
        </div>
        </div>
    </main>
    
</body>

</html>
<?php
    $this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/web/register.css">
    <script src="assets/js/web/register.js" async></script>
    <title>Cadastro</title>
</head>
<body>
    <main>
        <div class="container">
            <div class="form-register">
                <form id="formRegister">
                        <span class="register-span">Cadastro Grão & Co.</span>
                    <input type="name" name="name" placeholder="Seu nome"/> 
                    <input type="email" name="email" placeholder="E-mail" />
                    <input type="password" name="password" placeholder="Senha">
                    <input type="submit" value="Criar conta" />
                        <a href="<?= url("entrar")?>"><span>Já é cliente? Clique aqui. <i class="fa-solid fa-up-right-from-square" style="color: #1a1a1a;"></i></span></a>
                </form>
                
            </div>
            
        </div>
       
    </main>
</body>
</html>
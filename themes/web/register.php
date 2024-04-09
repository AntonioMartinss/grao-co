<?php
    $this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register.css">
    <title>Cadastro</title>
</head>
<body>
    <main>
        <div class="container">
            <div class="form-register">
                <form>
                        <span class="register-span">Cadastro Grão & Co.</span>
                    <input type="name" name="name" id="" placeholder="Seu nome"/> 
                    <input type="email" name="email" id="" placeholder="E-mail" />
                    <input type="password" name="password" placeholder="Senha">
                    <input type="password" name="password-verify" placeholder="Confirme sua senha">
                    <input type="submit" value="Entrar" />
                        <a href="<?= url("entrar")?>"><span>Já é cliente? Clique aqui. <i class="fa-solid fa-up-right-from-square" style="color: #1a1a1a;"></i></span></a>
                </form>
                
            </div>
            
        </div>
        </div>
    </main>
</body>
</html>
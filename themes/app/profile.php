<?php
$this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("themes/app/assets/css/profile.css"); ?>">
    <title>Perfil</title>
</head>

<body>

    <main>
        <div class="container-profile">
            <div class="photo">
                <img src="<?= url("themes/app/assets/images/myiamoto.jpeg"); ?>" alt="">
                <form class="new-photo">
                    <input type="file" name="" id="">
                    <input type="submit" value="Trocar imagem">
                </form>
            </div>
            <div class="info">
                <h2>Informações de usuário</h2>
                <div class="container-info">
                    <div class="edit-name">
                        <input type="text" name="name" disabled placeholder="antonio">
                        <button class="btn-edit"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                    </div>
                    <div class="edit-email">
                        <input type="text" name="email" disabled placeholder="antonio@gmail.com">
                        <button class="btn-edit"><i class="fa-solid fa-pen" style="color: #000000;"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>

</html>
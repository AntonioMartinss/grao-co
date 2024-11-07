<?php
$this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url("assets/css/app/profile.css"); ?>">
    <script type="module" src="<?= url("assets/js/app/profile.js"); ?>"></script>
    <title>Perfil</title>
</head>

<body>

    <main>
        <div class="container-profile">
            <div class="photo">
                <img src="" alt="user-photo">
            </div>
                <form id="form-photo">
                <input type="file" id="photo" name="photo">
                <input type="submit" value="Atualizar Foto"></>
                </form>
            </div>
            <div class="info">
                <h2>Informações de usuário</h2>
                <div class="container-info"> 
                </div>

            </div>
        </div>
    </main>

</body>

</html>
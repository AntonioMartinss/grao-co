<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= url("themes/adm/assets/css/_theme.css"); ?>">
    <script src="https://kit.fontawesome.com/e9ad9d0028.js" crossorigin="anonymous"></script>
    <script src="themes/adm/assets/js/_theme.js" async></script>
</head>

<body>
    <header>
        <div class="header-name">
            <h1 onclick="window.location.href = '<?= url(""); ?>'">GRÃO & CO.</h1>
        </div>
        <div class="message">
            <h4>Acesso Administrativo</h4>
        </div>
        <div class="icons">

            <button onclick="window.location.href = 'https://github.com/AntonioMartinss/' "><i class="fa-brands fa-github" style="color: #000000;"></i></button>

            <button onclick="window.location.href = '<?= url("entrar"); ?>'"><i class="fa-regular fa-user" style="color: #000;"></i></button>

        </div>
    </header>

    <main>

        <aside>
            <h3>Acesso Rápido</h3>
            <ul class="li" onclick="window.location.href = '<?= url("/admin/inicio"); ?>'">Adicionar Produto</ul>
            <ul class="li" onclick="window.location.href = '<?= url("/admin/editar-produto"); ?>'">Editar Produto</ul>
            <ul class="li" onclick="window.location.href = '<?= url("/admin/editar-usuario"); ?>'">Editar usuário</ul>
            <!-- <ul class="li">Avisos</ul> -->

        </aside>

        <?php
        echo $this->section("content");
        ?>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="<?= url("themes/app/assets/images/logo.svg"); ?>" alt="Logo">
                </div>
                <div class="">
                    <p>Descubra o mundo em uma xícara.</p>
                </div>
                <div class="footer-social">
                    <ul>
                        <li><a href="http://linkedin.com/in/antoniomsouza2/" target="_blank"><i class="fab fa-linkedin"></i></i></a></li>
                        <li><a href="https://github.com/AntonioMartinss/" target="_blank"><i class="fa-brands fa-github" style="color: #ffffff;"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Grão & Co. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

</body>

</html>
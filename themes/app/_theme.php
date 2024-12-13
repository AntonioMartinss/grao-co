<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= url("assets/css/app/_theme.css"); ?>">
    <script src="https://kit.fontawesome.com/e9ad9d0028.js" crossorigin="anonymous"></script>
    <script type="module" src="<?= url("assets/js/app/_theme.js"); ?>"></script>
 
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
<?php
    echo $this->section("content");
?>
    </main>

<footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="<?= url("assets/images/web/logo.svg"); ?>" alt="Logo">
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
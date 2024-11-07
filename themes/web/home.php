<?php
    $this->layout("_theme");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="assets/images/web/favicon.png">
    <link rel="stylesheet" href="assets/css/web/home.css">
    <script type="module" src="<?= url("assets/js/web/home.js"); ?>" async></script>
    <script src="https://kit.fontawesome.com/e9ad9d0028.js" crossorigin="anonymous"></script>
    <title>Grão & Co.</title>
</head>
<body>
   

  <div class="video">
    <img src="assets/images/web/Grão & Co..gif">
  </div>
  <div class="country">
    <p>Industria Brasileira</p>
    <img src="assets/images/web/brazil.png" alt="">
    </div>

  <h6 class="h6">Nossos Produtos</h6>
 <div class="product-container">
   <!-- Produtos vindo do Banco de Dados -->
 </div>

  <main>
  <section class="container">

    <div class="post">
        <div class="post-header">
            <img src="assets/images/web/logo.svg" alt="Profile Picture">
            <h3>Grão & Co.</h3>
        </div>
        <div class="post-image">
            <img src="assets/images/web/cafe.jpg" alt="Post Image">
        </div>
        <div class="post-footer">
            <div class="likes">&#x2665; likes</div>
            <span>• Cafés especiais para clientes especiais</span>
            <div class="comments">View all 20 comments</div>
        </div>
    </div>

    <div class="post">
        <div class="post-header">
            <img src="assets/images/web/logo.svg" alt="Profile Picture">
            <h3>Grão & Co.</h3>
        </div>
        <div class="post-image">
            <img src="assets/images/web/pacote.jpg" alt="Post Image">
        </div>
        <div class="post-footer">
            <div class="likes">&#x2665; likes</div>
            <span>• Grãos especiais - 500g</span>
            <div class="comments">View all 20 comments</div>
        </div>
    </div>
</section>

</main>


</body>
</html

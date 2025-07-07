<?php ob_start(); ?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Segura Upfiles</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="icon" type="text/css" href="img/logo_carrega.png">
        <link href="cssm/floating-labels.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >

    </head>
    <body>

        <form class="form-signin" method="POST" action="valida_login.php" >
            <div class="text-center mb-4">

                <img class="mb-4" src="img/cavalinho.jpg" alt="Segura" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-bold">Área Restrita</h1>

                <div class="text-danger text-white" ><strong>
                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></strong>
                </div>  

                <div class="form-group">
                    <label>Usuário</label>
                    <input type="email" class="form-control" name="email" placeholder="Digite seu E-mail">
                    <small id="emailHelp"  class="form-text text-muted">Por padrão e-mail corporativo da empresa ou parceiro</small>
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="senha" placeholder="Digite sua Senha">
                    <small id="emailHelp" class="form-text text-muted">Esta senha foi enviada para seu e-mail</small>
                </div>
                <button class="font-weight-bold btn btn-lg btn-warning btn-block "   type="submit">Acessar</button>
                <p class="text-center">Esqueceu a Senha?</p>

            </div>
        </form>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    </body>
</html>
<?php ob_start(); ?>
<?php
include_once 'includes/seguranca.php';
?>
<!DOCTYPE html>
  <html lang="pt-br">
  <head>
  	<title>Segura Upfiles</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" >

   <link href="cssm/dash.css" rel="stylesheet">
   <link rel="icon" type="text/css" href="img/logo_carrega.png">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
   <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>-->
   <script defer src="js/all.min.js"></script>
   <link rel="stylesheet" href="cssm/fontawesome.min.css">


 </head>

 <body>
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="sidebar-toggle text-light mr-3">
      <spam class="navbar-toggler-icon"> </spam>
    </a>
    <a class="navbar-brand" href="#">Segura Logística</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" >
      <!-- <ul class="navbar-nav mr-auto"> Move Menu para Esquerda-->
        <ul class="navbar-nav ml-auto"> <!-- ml-auto Move o Menu para Direita-->

          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenulink"  data-toggle="dropdown" >
              <img class="rounded-circle" src="img/logo_carrega.png" width="35" height="35">  
              &nbsp; <span class="d-none d-sm-inline"  class=".d-none .d-sm-block">Usuário</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenulink">
              <a class="dropdown-item" href="#"><i class="fas fa-user"></i>&nbsp;Perfil</a>
              <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
            </div>
          </li>

        </ul>

      </nav>

      <div class="d-flex  ">
        <nav class="sidebar">
          <ul class="list-unstyled">
            <li><a href=""><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a></li>
            <li>
              <a href="#submenu1" data-toggle="collapse">
                <i class="fas fa-user"></i>&nbsp;Usuários
              </a>
              <ul class="list-unstyled collapse" id="submenu1">
               <li > <a href="listar.php"><i class="fas fa-users"></i>&nbsp;Usuários</a></li>
               <li ></li> <a href="#"><i class="fas fa-key"></i>&nbsp;Nivel de Acesso</a></li>
             </ul> 
           </li>
           <li><a href="#submenu2"data-toggle="collapse"><i class="fas fa-list-ul"></i>&nbsp;Menu</a>
            <ul class="list-unstyled collapse" id="submenu2">
             <li> <a href="#"><i class="fas fa-file-alt"></i>&nbsp;Páginas</a></li>
             <li class="active"> <a href="#"><i class="fab fa-elementor"></i>&nbsp;Item Menu</a></li>
           </ul>

         </li>
         <li><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 1 </a></li>
         <li><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 2 </a></li>
         <li ><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 3</a></li>
         <li><a href=""><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a></li>
       </ul>
     </nav>

     <div class="content p-1">
      <div class="list-group-item">
        <div class="d-flex">
          <div class="mr-auto p-2">
            <h2 class="display-4 til"><strong>Visualizar Usuários</strong></strong></h2>
          </div>
          <!-- Botão Castradar  -->
        
            <div class="p2">
            <spam class="d-none d-md-block">
                  <a href="listar.php" class="btn btn-outline-info">Listar</a>
                <a href="editar.php" class="btn btn-outline-warning">Editar</a>
                <a href="apagar.php" class="btn btn-outline-danger"
                data-toggle="modal" data-target="#apagarregistro">Apagar</a>
              </spam>
              <div class="dropdown d-block d-md-none">
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="acoeslistar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoeslistar">
                   <a class="dropdown-item" href="listar.php">listar</a>
                <a class="dropdown-item" href="editar.php">editar</a>
                <a class="dropdown-item" href="pagar.php" data-toggle="modal" data-target="#apagarregistro">Apagar</a>
                </div>
              </div>
            </div>   

<div class="modal fade" id="apagarregistro" tabindex="-1" role="dialog" aria-labelledby="apagarRegistroLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class=" modal-title " align="center" id="">Excluir Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Tem certeza que deseja excluir o item selecionado?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#apagarregistro">Apagar</button>
      </div>
    </div>
  </div>
</div>     
        </div>
          <hr>
          <dl class="row">
  <dt class="col-sm-3">ID</dt>
  <dd class="col-sm-9">1</dd>

  <dt class="col-sm-3">Nome</dt>
  <dd class="col-sm-9"> Gerson Amaral</dd>

  <dt class="col-sm-3">E-mail</dt>
  <dd class="col-sm-9">gerson.amaral@gmail.com.br/dd>

  <dt class="col-sm-3 text-truncate">Data Cadastro</dt>
  <dd class="col-sm-9"> 14/05/2020 18:36:00</dd>     
  
  </div>
    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="js/dash.js"></script>

</body>
</html>
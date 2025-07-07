<?php
ob_start();
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
            <h2 class="display-4 til"><strong>Editar  Usuários</strong></strong></h2>
          </div>
          <!-- Botão Castradar  -->
        
            <div class="p2">
            <spam class="d-none d-md-block">
                  <a href="listar.php" class="btn btn-outline-info">Listar</a>
                <a href="visualizar.php" class="btn btn-outline-primary">Visualizar</a>
                <a href="apagar.php" class="btn btn-outline-danger"
                data-toggle="modal" data-target="#apagarregistro">Apagar</a>
              </spam>
              <div class="dropdown d-block d-md-none">
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="acoeslistar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoeslistar">
                   <a class="dropdown-item" href="listar.php">listar</a>
                <a class="dropdown-item" href="visualizar.php">Visualizar</a>
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
       <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label><spam class="text-danger">* </spam>Nome</label>
      <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
    </div>
    <div class="form-group col-md-6">
      <label f><spam class="text-danger">* </spam>E-mail</label>
      <input type="email" class="form-control" name="email"placeholder="Digite seu E-mail">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label><spam class="text-danger">* </spam>Senha</label>
      <input type="password" class="form-control" name="senha" placeholder="Senha com mínino 6 caracteres">
    </div>
    <div class="form-group col-md-6">
      <label ><spam class="text-danger">* </spam>Confirmar a Senha</label>
      <input type="password" class="form-control" name="conf_senha "placeholder="Confirmar a senha">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Cep</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
    <div class="form-group col-md-2">
    <spam class="text-danger">*</spam> Campo Obrigatório
  </div>
  </div>
  <button type="submit" class="btn btn-warning">Salvar</button>
</form>
      </div>
    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="js/dash.js"></script>

</body>
</html>
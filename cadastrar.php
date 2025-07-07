<?php 
ob_start();
include_once 'includes/seguranca.php';
date_default_timezone_set('America/Sao_Paulo');
include("includes/conf.php");

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
                        <h2 class="display-4 til"><strong>Cadastrar Usuários</strong></strong></h2>
                    </div>
                    <!-- Botão Castradar  -->
                    <a href="listar.php">
                        <div class="p2">
                            <button class="btn btn-outline-info btn-sm">
                                Listar
                            </button>
                        </div>
                    </a>
                </div>
                <hr>
                                
                 <form class="form-horizontal"  action="cad_usuariohe.php" method="POST" >
						
					<!--	<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Data:</label>
						<div class="col-sm-10">
						  <input type="date" class="form-control" name="data" placeholder="Data">
						</div>
						</div> -->
					
					<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label" ><strong>Nome:</strong></label>
					<div class="col-sm-6">
					  <input type="text" class="form-control" name="nome"  placeholder="Nome Completo" required autofocus >
					</div>
					</div>
					
					<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"  ><strong>E-mail:</strong></label>
					<div class="col-sm-6">
					  <input type="email" class="form-control" name="email" placeholder="E-mail" required autofocus>
					</div>
					</div>
					
					
					<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label"><strong>Senha:</strong></label>
					<div class="col-sm-2">
					  <input type="password" class="form-control" name="senha" placeholder="Senha" required autofocus />
					</div>
					</div>
                    	<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label"><strong>Unidade:</strong></label>
					<div class="col-sm-3">
					
					<select class="form-control" name="unidade">
					  <?php	
					    $query=("SELECT * FROM unidade order by nome_fantasia asc");
					   $resultado=mysqli_query($conn,$query);
		               $linhas=mysqli_num_rows($resultado);
					    while($linhas =mysqli_fetch_array($resultado)){
							 $id_unidade = $linhas['id'];
						     $nome_fantasia = $linhas['nome_fantasia'];
				      echo "<option value='$id_unidade'>$nome_fantasia</option>";				
					   }
					   ?>
					</select>
					</div>
					</div>	
								
                      <div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label"><strong>STATUS:</strong></label>
					<div class="col-sm-2">
					 
					 <select class="form-control" name="status"  >
						  <option value="A">Ativo</option>
						  <option value="I">Inativo</option>
				     </select> 
					
					</div>
					</div>

								
																			
					<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label"><strong>Nivel de Acesso:</strong></label>
					<div class="col-sm-2">
					 
                     <select class="form-control" name="nivel_de_acesso">
                         <?php	
					    $query=("SELECT * FROM niveis_acessos ");
					   $resultado=mysqli_query($conn,$query);
		               $linhas=mysqli_num_rows($resultado);
					    while($linhas =mysqli_fetch_array($resultado)){
							 $id_unidade = $linhas['id'];
						     $nome_fantasia = $linhas['nome'];
				      echo "<option value='$id_unidade'>$nome_fantasia</option>";				
					   }
					   ?>
					</select>
                     <!--
					 <select class="form-control" name="nivel_de_acesso"  >
						  <option value="1">Administradores</option>
						  <option value="2">Colaborador(a)</option>
						  <option value="3">Gestor(a) Filial</option>
                          <option value="4">Portal NF-e</option>
					</select> -->
					
					</div>
					</div>
					
					
					
					<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <input  type="submit" class="btn btn-success" value="Cadastrar" />
					</div>	
					</div>
					
			

                    
                </form>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
            <script src="js/dash.js"></script>
            
        </body>
    </html>    
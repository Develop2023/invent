<?php ob_start(); ?>
<?php
    include_once 'includes/seguranca.php';
    include("includes/conf.php");
    
	
    // Id Usuário Cadastrado na tabela usuarioshe id esta vindo por Sessão na pag validar.php
    $id= $_SESSION['usuarioId'];
    //echo"<br> Id: ".$id;
    $arquivo_id= $_SESSION['usuarioArquivo_id'];
    //echo "<br> Id_Arquivo : " .$arquivo_id;
    $id_unidade =$_SESSION['usuarioIdUnidade'];
    //echo $id_unidade;
    $nome = $_SESSION['usuarioNome'];
    
     $quantidade= 8;
    $pagina = (isset($_GET['pagina'])? (int)$_GET['pagina'] : 1);
	
  
    
    $seach=mysqli_query($conn,"SELECT id  FROM usuarioshe  ");
    $resultado=mysqli_fetch_assoc($seach);
    $total_usuarios = mysqli_num_rows($seach);
				
		//calcular o número de paginas necessárias para apresentar os usuários
		$num_paginas = ceil($total_usuarios/$quantidade);
		
		// Calcular o inicio da Visualização
		$inicio =  ($quantidade*$pagina)-$quantidade;
    
    //Contar o Total de Usuarios cadastrados
    
   
    
    $sql="SELECT a.*, 
    a.id as id,
    a.nome as nome,
    a.email as email,
    DATE_FORMAT(a.data,'%d/%m/%Y') as datas,
    a.id_nivelacesso as id_nivelacesso
    from usuarioshe a 
    
    where id_nivelacesso in (1,4) order by id asc LIMIT $inicio,$quantidade    ";
    $resultado=mysqli_query($conn,$sql);
    
    
    
    
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
            <a class="navbar-brand" href="index.php">Segura Logística</a>
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
                            <a class="dropdown-item" href="sair.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
                        </div>
                    </li>
                    
                </ul>
                
            </nav>
            <div class="d-flex  ">
                <nav class="sidebar">
                    <ul class="list-unstyled">
                        
                        <li><a href="index.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a></li>
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
                            <h2 class="display-4 til"><strong>Listar Usuários</strong></h2>
                            <!-- Botão Castradar  -->
                        </div>
                        <a href="cadastrar.php">
                            <div class="p2">
                                <button class="btn btn-outline-success btn-sm">
                                    Cadastrar
                                </button>
                            </div>
                        </a>
                    </div>
                
                <!-- Campo da tabela  -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        
                        <thead>
                            <tr>
                                
                                <th>Id</th>
                                <th class="d-none d-sm-table-cell">Nome</th>
                                <th class="d-none d-lg-table-cell">E-mail</th>
                                <th class="d-none d-lg-table-cell">Data Castrado</th>
                                <th class="text-center">Ações</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php                        
                                while ($dados=mysqli_fetch_array($resultado)) {
                                    $id=$dados['id'];
                              ?>	
                                <td><?php echo $dados['id'];?></td>
                                <td><?php echo mb_substr( $dados['nome'],0,25,'UTF-8');?></td>
                                <td><?php echo $dados['email'];?></td>  
                                <td><?php echo $dados['datas'];?></td>                                 
                                <td class="text-center">
                                    <spam class="d-none d-md-block">
                                        <a href="visualizar.php" class="btn btn-outline-primary">Visualizar</a>
                                        <a href="editar.php" class="btn btn-outline-warning">Editar</a>
                                        <a href="apagar.php" class="btn btn-outline-danger"
                                        data-toggle="modal" data-target="#apagarregistro">Apagar</a>                
                                        </spam>                                
                                    <div class="dropdown d-block d-md-none">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="acoeslistar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ações
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoeslistar">
                                            <a class="dropdown-item" href="visualizar.php">Visualizar</a>
                                            <a class="dropdown-item" href="editar.php">Editar</a>
                                            <a class="dropdown-item" href="pagar.php" data-toggle="modal" data-target="#apagarregistro">Apagar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
  </div>  <!--list-group-item  -->             
                <!-- Campo da Paginação -->
            <?php 
//SQL para saber o total
  $sqlTotal   = " SELECT a.*, 
    a.id as id,
    a.nome as nome,
    a.email as email,
    DATE_FORMAT(a.data,'%d/%m/%Y') as datas,
    a.id_nivelacesso as id_nivelacesso
    from usuarioshe a 
    
    where id_nivelacesso = 4 order by id desc";
  //Executa o SQL
  $qrTotal    = mysqli_query($conn, $sqlTotal) or die(mysqli_error());
  //Total de Registro na tabela
  $numTotal   = mysqli_num_rows($qrTotal);
  //O calculo do Total de página ser exibido
  $totalPagina= ceil($numTotal/$quantidade);
   /**
    * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
    */
   $exibir = 7;
   /**
    * Aqui montará o link que voltará uma pagina
    * Caso o valor seja zero, por padrão ficará o valor 1
    */
   $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
   /**
    * Aqui montará o link que ir para proxima pagina
    * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
    * caso contrario, ele pegar o valor da página + 1
    */
   $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
   /**
    * Agora monta o Link paar Primeira Página
    * Depois O link para voltar uma página
    */
  /**
    * Agora monta o Link para Próxima Página
    * Depois O link para Última Página
    */
    ?>
	<nav aria-label="Page navigation example">
 	 	        <?php
		echo "<ul class='pagination justify-content-lg-center'>"; 	
		echo "<li>";
        echo "<a class='page-link' href='?pagina=1'><strong>Primeira</strong>
		      <span aria-hidden='true'>&laquo;</span></a> ";
		echo "</li>";
		echo "<li>";
        echo "<a class='page-link' href=\"?pagina=$anterior\"> <strong>Anterior</strong>
		      <span aria-hidden='true'>&laquo;</span></a>";
		echo "</li>";
    ?>
        <?php 
		echo"<li class='page-item' >";
	 /**
    * O loop para exibir os valores à esquerda
    */

   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
       if($i > 0)
		     
             echo '<a class="page-link" href="?pagina='.$i.'"> '.$i.' </a>';
	  echo "<li>";   
	}
	
	echo "<li class='page-item active' >"; 
              echo '<a class="page-link" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a>';
  echo "<li>";	
  
 echo "<li class='page-item' >"; 
  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
       if($i <= $totalPagina)
        echo "<a class='page-link' href='?pagina=".$i."'> ".$i."	</a>";
	  
	  echo "<li>";	
  }

   /**
    * Depois o link da página atual
    */
   /**
    * O loop para exibir os valores à direita
    */

    ?>
    <?php 
	echo "<li>";
	echo " <a class='page-link' href=\"?pagina=$posterior\"><strong>Proximo</strong>
	    <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Próximo</span>
	</a>  ";
	echo "</li>";
	echo "<li>";
          echo "  <a class='page-link' href=\"?pagina=$totalPagina\"><strong>Última</strong>
		  <span aria-hidden='true'>&raquo;</span>
   
		  </a>";
		  echo "</li>";
	echo "</ul>";	  
    ?>
		
		</nav>							
			   
               
        </div>
    </div>
</div>

<!-- Modal -->
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

</body>
</html>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="js/dash.js"></script>


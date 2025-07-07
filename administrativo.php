<?php ob_start(); ?>
<?php
@session_start();
include("includes/conf.php");
    
	
// Id Usuário Cadastrado na tabela usuarioshe id esta vindo por Sessão na pag validar.php
$id= $_SESSION['usuarioId'];
//echo"<br> Id: ".$id;
$arquivo_id= $_SESSION['usuarioArquivo_id'];
//echo "<br> Id_Arquivo : " .$arquivo_id;
$id_unidade =$_SESSION['usuarioIdUnidade'];
//echo $id_unidade;
$nome = $_SESSION['usuarioNome'];

	
	   $quantidade= 7;
	
		$pagina = (isset($_GET['pagina'])? (int)$_GET['pagina'] : 1);
		
		$seach=mysqli_query($conn,"SELECT id as idfiles FROM files  ");
		$total_usuarios = mysqli_num_rows($seach);
				
		//calcular o número de paginas necessárias para apresentar os usuários
		$num_paginas = ceil($total_usuarios/$quantidade);
		
		// Calcular o inicio da Visualização
		$inicio =  ($quantidade*$pagina)-$quantidade;
		
		// Selecionar os usuários a serem apresentado na páginas
		$sql="SELECT a.*, 
				a.id idfiles,
				u.nome_fantasia as filial,
				a.arquivo_nome nome_arquivo,
				st.nome st_nome,
				tp.descricao descricao,
				DATE_FORMAT(a.date,'%d/%m/%Y') as datas,
					FORMAT(a.valor,2,'de_DE') as valor,
				DATE_FORMAT(a.dt_vencimento,'%d/%m/%Y') as dt_venc,
				ff.descricao as desc_nome
				FROM files a 
				INNER JOIN status st ON st.id=a.id_status
				INNER JOIN filiais ff ON ff.id = a.id_cc
				INNER JOIN unidade u ON u.id=a.id_unidade
				INNER JOIN tipodoc tp ON tp.id_tipodoc = a.id_tipodoc
				ORDER BY  idfiles desc LIMIT $inicio,$quantidade
				";
				$resultado=mysqli_query($conn,$sql);	
	
?>

<style>
	.form-group {
    margin-bottom:09px;
    margin-right:-09px;
}
</style>
	

<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <title>Segura Upfiles</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
		
        <link href="cssm/dash.css" rel="stylesheet">
        <link rel="icon" type="text/css" href="img/logo_carrega.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
        <!-- <script  src = "js/locales/bootstrap-datepicker.pt-BR.js" charset = " UTF-8 "></script>-->
		<!-- <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>-->
        <script defer src="js/all.min.js"></script>
        <link rel="stylesheet" href="cssm/fontawesome.min.css">
      <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet" />
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>		
<script>
	$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});	
	
</script>
	</head>
	
    <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <a class="sidebar-toggle text-light mr-3">
                <spam class="navbar-toggler-icon"> </spam>
			</a>
            <a class="navbar-brand" href="adm.php">Segura Logística</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
			</button>
			
            <div class="collapse navbar-collapse" >
                <!-- <ul class="navbar-nav mr-auto"> Move Menu para Esquerda-->
                <ul class="navbar-nav ml-auto"> <!-- ml-auto Move o Menu para Direita-->
					
                    <li class="nav-item dropdown">
						
                        <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenulink"  data-toggle="dropdown" >
							<?php echo $username=$_SESSION['usuarioNome'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			<div class="d-flex">
				<!-- Menu Lateral-->
				<nav class="sidebar toggled">
					<ul class="list-unstyled">
						<li><a href="adm.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a></li>
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
							<li> <a href="adm.php"><i class="fas fa-file-alt"></i>&nbsp;Adm</a></li>
							<li class="active"> <a href="relatorio.php"><i class="fab fa-elementor"></i>&nbsp;Relatório Adm</a></li>
						</ul>
						
					</li>
					<li><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 1 </a></li>
					<li><a href="sair.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a></li>
				</ul>
			   </nav> <!-- FIM Menu Lateral-->
           
            <div class="content p-1">
                <div class="list-group-item">
                    <div class="d-flex">
					<div class="container">
						<div class="row justify-content-md-center">
							<div class="col col-sm-4">
								<h2 class="Display-7">Área Administrativa</h2>
							</div>
							
							<div class="col col-sm-7">
								<form class="form-inline" method="GET" action="pesquisaadm.php"  >
									<div class="form-group mx-auto ">
									</div>
									<div class="form-group mx-sm-4 mb-2">
										<label for="Pesquisar" class="sr-only"></label>
										<input type="text" class="form-control" name="pesquisar">       
									</div>
									<button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
								</form>
							</div>
						</div>	
						
						
						
						
						<div class="col-sm-6 col-md-6">
							
							<div class="col-s6-m6-l ">
								
								<?php  
									if(isset($_SESSION['sms'])) { ?>
									<div id="fo" class="alert alert-success" id="alert" role="alert">
										<?php echo  "<span align='right'>".$_SESSION['sms']."</span>";?>
									</div>
									<?php	unset ($_SESSION['sms']);
									}
									if(isset($_SESSION['msger'])) { ?>
									<div id="foo" class="alert alert-danger" role="alert">
										<?php echo  "<span align='right'>".$_SESSION['msger']."</span>";?>
									</div>
									<?php	unset ($_SESSION['msger']);
									}
								?>
							</div>
							
							
						</div>
					</div>
                     
					</div>
					
					<hr>
					
					<div class="container">
						
						<!-- Button trigger modal -->
						<center>
							<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addEmpModal">
								Add Arquivos
							</button>
							
						</center>
						
					</div>

					<br/>
					<div class="content p-1">
						<div class="d-flex">
						<table class=" table display AllDataTables"  > 
			<thead >
				<tr>
									<!--<th>Id</th> -->
									<th>id</th>
					           <!--<th>Data Envio</th>-->
					                <th>Fornecedor</th>
									<th>Nome Arquivo</th>
									<th>N.NF-e</th>
									<th>Data Venc.</th>	
									<th>Valor</th>
									<th>Visualizar</th>	
									<th >Download</th>
									 <th>Status Documento</th>
									<th>Status</th>  							
					              <th class="text-center">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php

				
				while ($dados=mysqli_fetch_array($resultado)) {
				    $id=$dados['idfiles'];
					?>
					<tr>
					<td><?php echo $dados['idfiles'];?></td>
					<!--<td ><?php echo $dados['datas'];?></td> -->
					<td><?php echo $dados['fornecedor'];?></td>
					<td><?php echo mb_substr( $dados['arquivo_nome'],0,25,'UTF-8');?></td>
					<td><?php echo mb_substr ($dados['cnpj_cpf'], 0, 19);?></td>
					<td><?php echo $dados['dt_venc'];?></td>
					<td><?php echo $dados['valor'];?></td>
					
<!-- Botão Visualizar -->
<td align="center" >
<a href="view.php?id=<?php echo $dados['id'];?>" target="_blank" class="btn-floating red">
<i class="fas fa-eye" target="_blank" ></i>
	</a>
</td>

<!-- Botão Download -->	
<td align="center" >
<a href="uploadFiles/<?php echo $dados['arquivo_nome'];?>" target="_blank" class="btn-floating red" download>
<i class="fa fa-download" aria-hidden="true" ></i></a>
</td>

										<td >
										<option value="<?php echo $dados['id_status']?>" 
										<?php 
												if($dados['id_status']==$dados['id_status']){
													?>selected<?php }?>>					
											<?php echo $dados['descricao']?>
										</option>	</td>
										
										
										<td><?php echo $dados['st_nome'];?></td>
<!-- Botão Editar-->
<td>



<!-- modal with a button Editar -->

<div class="  btn-group" role="group"  >	
			
 <button type="button" class=" btn btn-pill btn-primary px-1  editbtn">Alterar</button>&nbsp;
<button  type="button"   class=" btn btn-pill   btn-Warning px-1  viewbtn " data-toggle="modal" 
data-target="#bd-viewbtn-modal-lg<?php echo $dados['idfiles'];?>" >Visualizar </button>&nbsp;
 
 <a href="deladm.php?id=<?php echo $dados['idfiles'];?>">
<button type="button"  class="btn btn-pill  btn-danger px-1 ">Apagar</button></a>
		
</div>
</td>
</tr>


<!-- Visualizar modal -->


<div class="modal fade "  id="bd-viewbtn-modal-lg<?php echo $dados['idfiles'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title "  id="exampleModalLabel"><?php echo $dados['fornecedor'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card" style="center: 35rem;">
  <ul class="list-group list-group-flush">
     <li class="list-group-item"><strong>Data Envio:</strong>&nbsp;<?php echo $dados['datas'];?></li>
    <li class="list-group-item"><strong>Fornecedor:</strong>&nbsp;<?php echo $dados['fornecedor'];?></li>
    <li class="list-group-item"><strong>Descrição Arquivo:</strong>&nbsp;<?php echo $dados['nome_arquivo'];?></li>
	<li class="list-group-item"><strong>Número(s) Nf-e(s):</strong>&nbsp;<?php echo $dados['cnpj_cpf'];?></li>
	 <li class="list-group-item"><strong>Dt_Vencimento:</strong>&nbsp;<?php echo $dados['dt_venc'];?></li>
	 <li class="list-group-item"><strong>Valor:</strong>&nbsp;<?php echo $dados['valor'];?></li>
	 <li class="list-group-item"><strong>Observação:</strong>&nbsp;<?php echo $dados['obs'];?></li>
	<!-- <li class="list-group-item"><strong>Enviado por :</strong>&nbsp;<?php echo $dados[''];?></li>-->
	<li class="list-group-item"><strong>Centro de Custo: </strong>&nbsp;<?php echo $dados['desc_nome'];?></li>
  </ul>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
       
      </div>
    </div>
    
  </div>
</div>


			<?php } ?>
			</tbody>
		</table>	
								
</div>

<?php 
//SQL para saber o total
  $sqlTotal   = "SELECT id as idfiles FROM files";
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
						<!-- Campo da tabela  -->
	




	
		
<!-- Modal Adicionar -->
<div class="modal fade" id="addEmpModal" tabindex="-1" role="dialog" aria-labelledby="myModaLabel" aria-hidden="true">
  <div class="modal-dialog">
		    <div class="modal-content">
	
	<!--  Fim campo de Pegar mensagem via $_SEESION --> 
		       <form action="submitadm.php" method ="post" enctype="multipart/form-data" >
		      <div class="modal-header">
		        <h5 class="modal-title" id="myModaLabel">Lançamentos</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body md-n5">
		           
		            <div class="form-group px-md-4 ">
		            	<label><strong>Número NF-e</strong></label>
		            	<input class="form-control" type="text" name="cnpj" id="cnpj" placeholder="Digite Número da Nf-e" required  autocomplete="off">
		            	<label id="lblCnpj" style="color:red"></label>
		            </div>

		            <div class="form-group px-md-4">
		            	<label><strong>Nome Fornecedor</strong></label>
		            	<input class="form-control" type="text" name="fornecedor"  placeholder="Digite o Fornecedor"  required  autocomplete="off">
		            	<label id="lblFornecedor" style="color:red"></label>
		            </div>
                     <div class="form-group px-md-4">
							  <label for="inputPassword4"><strong>Data Vencimento do Boleto</strong></label>
							  <input type="text" class="form-control"  name="dataInicioCalendar"  id="calendarioIni" required  autocomplete="off" >
							</div>
		            <div class="form-group px-md-4">
		            	<label><strong>Valor Total Nf-e</strong></label>
		            	<input class="form-control" type="text" name="valor"  placeholder="Digite o Valor" required  autocomplete="off">
		            	<label id="lblValor" style="color:red"></label>
		            </div>
					
					<div class="form-group px-md-3">
						<label for="validationTextarea"><strong>Observações</strong></label>
						<textarea type="text" class="form-control " name="txt_area" id="validationTextarea" placeholder="Informações complementares" maxlength="200"></textarea>
						<div class="invalid-feedback">
						  Limite Máximo de 200 caracteres.
						</div>
					  </div>
					
		            <div class="form-group px-md-4">
		            	<label><strong>Anexe aqui os arquivos</strong></label>
					<div>
						<p><input id="file" type="file" name="arquivos[]" required multiple></p>
						
						 <div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                   <button id="btn" class="btn btn-success">Upload all files</button>
		                  </div>
						
					</div>
		      </div>
		     
		  </form>
     
   </div>
</div>
</div>		
</div> 

<!-- Modal Edidar_Adm -->
<div class="modal fade" id="edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModaLabel" aria-hidden="true">
  <div class="modal-dialog">
		    <div class="modal-content ">

		       <form  action="updatestatus.php" method ="POST"  >
		      <div class="modal-header">
		        <h5 class="modal-title" id="myModaLabel">Atualizar</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body ">
		         <input type="hidden" name="update_id" id="update_id"> 
		            
					<div class="form-group px-md-4">
		            	<label><strong>Fornecedor</strong></label>
		            	<input class="form-control" type="text" name="fornecedor" id="fornecedor" >
		            	<label id="lblFornecedor" style="color:red"></label>
		            </div>
					
					<div class="form-group px-md-3">
							  <label for="inputPassword4"><strong>Descrição Arquivo</strong></label>
						<input class="form-control" id="n_arquivo" type="text"   name="nome_arquivo" / >
					</div>	
					
                     <div class="form-group px-md-4"  >
							  <label ><strong>Data Vencimento</strong></label>
							  <input type="text" class="form-control"  name="dataInicioCalendar"  id="dtvencimento" >
							</div>
					      
						  <div class="form-group px-md-4"  >
							  <label for="inputPassword4"><strong>Valor</strong></label>
							  <input type="text" class="form-control"  name="valor"  id="valor" >
							</div>	
							
					    	
								
                       <div class="form-group px-md-4"  >
						<label for="inputPassword4"><strong>Número NF-e</strong></label>
						<input type="text" class="form-control"  name="num1" autocomplete="off" id="num1">
					</div>
					
		            <br/>
					<div class="form-group px-md-4">
					 <select class="custom-select" name="id_status" id="id_status">
						<option value="1">Lancado no ESL</option>
						<option value="2">Pendente</option>
						<option value="3">Aguardando ajuste</option>
						<!-- <option value="4">Visualizado</option>	-->		
					  </select>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary " data-dismiss="modal">Sair</button>
		               <button  type="submit" name="updatedata" class="btn btn-primary">Alterar</button>
		                  </div>			
		    </div>
		 </form>
     
   </div>
</div>
</div>		




<!-- Modal Visualizar_Adm -->
<div class="modal fade" id="view_Modal" tabindex="-1" role="dialog" aria-labelledby="myModaLabel" aria-hidden="true">
  <div class="modal-dialog">
		    <div class="modal-content ">

		       <form  action="viewstatus.php" method ="POST"  >
		      <div class="modal-header">
		        <h5 class="modal-title" id="myModaLabel">Visualizar</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body ">
		         <input type="hidden" name="update_id" id="update_id"> 
		            <div class="form-group px-md-4">
		            	<label><strong>Descrição Fornecedor</strong></label>
		            	<input class="form-control" type="text" name="fornecedor" id="fornecedor" >
		            	<label id="lblFornecedor" style="color:red"></label>
		            </div>
					
					
					<div class="form-group px-md-4"  >
						<label for="inputPassword4"><strong>Descrição Arquivo</strong></label>
						<input type="text" class="form-control"  name="num" autocomplete="off" id="num">
					</div>
					
					<div class="form-group px-md-4"  >
						<label for="inputPassword4"><strong>Número NF-e</strong></label>
						<input type="text" class="form-control"  name="num1" autocomplete="off" id="num1">
					</div>
					
                     <div class="form-group px-md-4"  >
							  <label ><strong>Data Vencimento</strong></label>
							  <input type="text" class="form-control"  name="dataInicioCalendar"  id="dtvencimento" >
							</div>
					      <div class="form-group px-md-4"  >
							  <label for="inputPassword4"><strong>Valor</strong></label>
							  <input type="text" class="form-control"  name="valor"  id="valor" >
							</div>	
							
					    <div class="form-group px-md-3">
							  <label for="inputPassword4"><strong>Descrição Arquivo</strong></label>
						<input class="form-control" id="nome_arquivo" type="text"   name="nome_arquivo" / >
					</div>		
													
		            <br/>
					<div class="form-group px-md-4">
					 <select class="custom-select" name="id_status" id="id_status">
						<option value="1">Lancado no ESL</option>
						<option value="2">Pendente</option>
						<option value="3">Aguardando ajuste</option>
						<!-- <option value="4">Visualizado</option>	-->		
					  </select>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
		               <button  type="submit" name="updatedata" class="btn btn-primary">Update</button>
		                  </div>
					
		    </div>
		 </form>
     
   </div>
</div>
</div>	



</div> <!-- div content p-1 -->
</div> <!-- FIM div FLEX -->

 </body>
	</html>				
		
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
			<script src="js/dash.js"></script>
			
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
			
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>
 
	
			
			
<script>

	document.getElementById('btnfile').addEventListener('click', function(){
		var inputElem = document.getElementById('file');
		var arrayFiles = inputElem.files;
		
		var formdata = new FormData();
		formdata.append('file[]', arrayFiles);
		
		var xmh = new XMLHttpRequest;
		xmh.onreadystatechange = function(){
			if(xmh.readyState == 4 && xmh.status == 200){
				
				var response = xmh.responseText;
				console.log('response: '+response);
			}
		}
		xmh.open('', '');
		xmh.send(formdata);   
	});
	
	

</script>
<script>
  	

	
// Iniciará quando todo o corpo do documento HTML estiver pronto.
$().ready(function() {
	setTimeout(function () {
		$('#fo').hide(); // "foo" é o id do elemento que seja manipular.
	}, 2500); // O valor é representado em milisegundos.
});


$().ready(function() {
	setTimeout(function () {
		$('#foo').hide(); // "foo" é o id do elemento que seja manipular.
	}, 2500); // O valor é representado em milisegundos.
});  
function funcao( obj , e )
{
    var tecla = ( window.event ) ? e.keyCode : e.which;
    if ( tecla == 8 || tecla == 0 )
        return true;
    if ( tecla != 44 && tecla < 48 || tecla > 57 )
        return false;
}

      
			$(document).ready(function() {
				$('#calendarioIni').datepicker({

					format: 'dd/mm/yyyy',
					language: 'pt-BR',
					autoclose: true,
		                           startDate: '0d',
					todayHighlight: true,
					showAnim: 'scale',
				}).on('changeDate', function(e) {
					$("#cid").val(e.date.toISOString().substring(0, 10));
					console.log($("#cid").val());
				});
				
			});

</script>



<script>
	$(document).ready(function(){
		$('.editbtn').on('click',function(){
			
			$('#edit_Modal').modal('show');
			
			$tr = $(this).closest('tr');
			var data = $tr.children('td').map(function(){
				return $(this).text();
			}).get();
			console.log(data);
			$('#update_id').val(data[0]);
			$('#fornecedor').val(data[1]);
			$('#n_arquivo').val(data[2]);
			$('#num').val(data[4]);
			
			$('#num1').val(data[3]);
			$('#dtvencimento').val(data[4]);
			$('#valor').val(data[5]);
	
			
		});
	});
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
<?php ob_start(); ?>
<?php
	if (!isset($_SESSION)) {
		session_start();
		include("includes/conf.php");
		
		// Id Usuário Cadastrado na tabela usuarioshe id esta vindo por Sessão na pag validar.php
		$id= $_SESSION['usuarioId'];
		//echo"<br> Id: ".$id;
		$arquivo_id= $_SESSION['usuarioArquivo_id'];
		//echo "<br> Id_Arquivo : " .$arquivo_id;
		$id_unidade =$_SESSION['usuarioIdUnidade'];
		//echo $id_unidade;
		$nome = $_SESSION['usuarioNome'];
		
		
		$pagina = (isset($_GET['pagina'])? $_GET['pagina'] : 1);
		
		
	  if(!isset($_GET['pesquisar'])){
           header("Location: home.php");  
		}else{
		
		$valor_pesquisar= $_GET['pesquisar'];
		
		}
		
		$seach=mysqli_query($conn,"SELECT * from files WHERE fornecedor LIKE '%$valor_pesquisar%' OR arquivo_nome LIKE '%$valor_pesquisar%' 
		OR dt_vencimento LIKE '%$valor_pesquisar%'");
		$resultado=mysqli_fetch_assoc($seach);
		
		
		//Contar o Total de Usuarios cadastrados
		
		$total_usuarios = mysqli_num_rows($seach);
		
		//Seta a quantidade de Usuários por paginas
		$quantidade_pg = 5;
		
		//calcular o número de paginas necessárias para apresentar os usuários
		$num_paginas = ceil($total_usuarios/$quantidade_pg);
		
		// Calcular o inicio da Visualização
		$inicio =  ($quantidade_pg*$pagina)-$quantidade_pg;
		
		// Selecionar os usuários a serem apresentado na páginas
		
		$result_usuarios = "
		SELECT a.*, 						
		a.id idfiles,
		u.nome_fantasia as filial,
		a.arquivo_nome nome_arquivo,
		st.nome st_nome,
		tp.descricao descricao,
		DATE_FORMAT(a.date,'%d/%m/%Y') as datas,
		 FORMAT(valor,2) as valor,		 
		DATE_FORMAT(a.dt_vencimento,'%d/%m/%Y') as dt_venc	
		FROM files a 
		left outer JOIN status st ON st.id=a.id_status
		left outer JOIN unidade u ON u.id=a.id_unidade
		left outer JOIN tipodoc tp ON tp.id_tipodoc = a.id_tipodoc
		 where  fornecedor LIKE '%$valor_pesquisar%' OR arquivo_nome LIKE '%$valor_pesquisar%' OR dt_vencimento LIKE '%$valor_pesquisar%'
		AND a.id_unidade='$id_unidade' 
		LIMIT $inicio,$quantidade_pg  " ; 
		$resultados=mysqli_query($conn,$result_usuarios);
		
		
		
		
		
	}
	
	if(!empty($_SESSION['usuarioId'])){
		
		
		}else{
		$_SESSION['loginErro'] = "Área restrita";
		header("Location: index.php");  
	}
	
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
		
	</head>
	
	<body>
		<br/>
		
		<nav class="navbar navbar-expand navbar-dark bg-dark">
			<a class="sidebar-toggle text-light mr-3" >
				<span class="navbar-toggler-icon"> </span>
			</a>
			<a class="navbar-brand" href="administrativo.php">Segura Logística</a>
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
			</div>	
		</nav>
		
		<div class="d-flex">
			
			<!-- Menu Lateral-->
			<nav class="sidebar toggled">
				<ul class="list-unstyled">
					<li><a href="administrativo.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a></li>
					<li>
						<!-- <a href="#submenu1" data-toggle="collapse">
							<i class="fas fa-user"></i>&nbsp;Usuários
						</a>
						<ul class="list-unstyled collapse" id="submenu1">
							<li > <a href="listar.php"><i class="fas fa-users"></i>&nbsp;Usuários</a></li>
						<li ></li> <a href="#"><i class="fas fa-key"></i>&nbsp;Nivel de Acesso</a></li>
					</ul> 
				</li>
				<li><a href="#submenu2"data-toggle="collapse"><i class="fas fa-list-ul"></i>&nbsp;Menu</a>
					<ul class="list-unstyled collapse" id="submenu2">
						<li> <a href="administrativo.php"><i class="fas fa-file-alt"></i>&nbsp;Páginas</a></li>
						<li class="active"> <a href="#"><i class="fab fa-elementor"></i>&nbsp;Item Menu</a></li>
					</ul>
					
				</li>
				<li><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 1 </a></li> -->
				<li><a href="sair.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a></li>
			</ul>
		</nav>   <!-- FIM Menu Lateral-->
		
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
						
						<table class="table"  > 
							<thead >
								<tr>
									<!--<th>Id</th> -->
									<th >id</th>
									<th>Data Envio</th>
									<th>Fornecedor</th>
									<th>Descrição</th>
									<th>Data Venc</th>	
									<th>Valor</th>
									<th>Visualizar</th>	
									<th >Download</th>
									<th>Tipo Documento</th>					
									<th class="text-center">Ações</th>
								</tr>
							</thead>
							
							<tbody>
								<?php								
									//consultar no banco de dados
									while ($dados=mysqli_fetch_array($resultados)) {
										$idfiles=$dados['idfiles'];
										
									?>
									
									<tr id="delete<?php echo $dados['idfiles']?>">
										
										<td><?php echo $dados['idfiles'];?></td>
										<td ><?php echo $dados['datas'];?></td>
										<td ><?php echo $dados['fornecedor'];?></td>
										<td ><?php echo $dados['arquivo_nome'];?></td>
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
											</option>						
										</td>
										
										<!-- Botão Editar-->
										<td>
											<!-- modal with a button Editar -->
											<div class="col-md-4">
												
												<div id="types" class="btn-group">
													<input type="hidden" name="idfiles"> 
													<button name="color" type="button" class="btn btn-outline-primary editbtn" >Editar</button>
													<a href="delete.php?idfiles=<?php echo $dados['idfiles'];?>"
												<button  type="button" class="btn btn-outline-danger">Apagar</button></a>
												
											</div>
										</div>
										
									</td>
								</tr>
								<?php 
									
								} ?>
								
								
								
								
								
								
						</tbody>
					</table>	
					
				</div> <!-- div content p-1 -->
			</div> <!-- FIM div FLEX -->
			<?php 
				
				/* echo "<nav aria-label='paginacao-adm'>";
					echo "<ul class='pagination justify-content-md-center'>";
					echo "<li class='page-item'>";
					echo " <a class='page-link' href='home.php?pagina=1' tabindex='-1' aria-disabled='true'>Primeira</a>";
					echo "</li>";
					for($pag_ant=$max_links; $pag_ant <= $pagina -1; $pag_ant++) {
					if($pag_ant >=1){
					echo "<li class='page-item'><a class='page-link' href='home.php?pagina=$pag_ant'>
					$pag_ant</a></li>";
					
					}
					}
					
					echo "<li class='page-item active' aria-current='page'>";
					echo "<a class='page-link' href='#'>$pagina <span class='sr-only'>(current)</span></a>";
					echo "</li>";
					
					for($pag_dep = $pagina +1; $pag_dep <= $pagina + $max_links; $pag_dep++ ){
					if ($pag_dep<= $quantidade_pg){
					echo"<li class='page-item'><a class='page-link' href='home.php?pagina=$pag_dep'>
					$pag_dep</a></li>";
					}
					}
					
					echo"<li class='page-item'>";
					echo"<a class='page-link' href='home.php?pagina=$quantidade_pg'>Ùltima</a>";
				echo'</li>';*/
				
			?>
			
			
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-md-center">
					<li>
						<?php 
							$pagina_anterior =   $pagina -1;
							$pagina_posterior =  $pagina +1;
							
							if($pagina_anterior != 0){ ?>   
							<a class="page-link" href="pesquisaadm.php?pagina=<?php echo $pagina_anterior;?>&pesquisar=<?php echo $valor_pesquisar;?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>  	
							<?php }else { ?>
							<a class="page-link" href="">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php } ?>
					</li>  
					
	            	<?php 
						//Apresentar paginação
						for($i=1; $i< $num_paginas +1; $i++ ) {?> 
						<li class="page-item"><a class="page-link" href="pesquisaadm.php?pagina=<?php echo $i; ?>
						&pesquisar=<?php echo $valor_pesquisar;?>"><?php echo $i; ?></a>
						</li>
					<?php }?>
					<?php 						
						if($pagina_posterior <= $num_paginas){ ?>   
						<a class="page-link" href="pesquisadmphp?pagina=<?php echo $pagina_posterior ; ?>
						&pesquisar=<?php echo $valor_pesquisar;?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a> 
						
						<?php }else { ?>
						<a class="page-link" href="">
							<span aria-hidden="true">&raquo;</span>
							</a>
					</li> 
					<?php } ?>
				 				
				
			</ul>
		</nav>
		
		
		
		
		
		
		
		
		
		
	</div>													
</div>
<div>
</body>
</html>			
<!-- Modal Adicionar -->
<div class="modal fade" id="addEmpModal" tabindex="-1" role="dialog" aria-labelledby="myModaLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<form action="submit.php" method ="post" enctype="multipart/form-data" >
				<div class="modal-header">
					<h5 class="modal-title" id="myModaLabel">Lançamentos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body md-n5">
					
					<div class="form-group px-md-4 ">
						<label><strong>CNPJ / CPF</strong></label>
						<input class="form-control" type="text" name="cnpj" id="cnpj" placeholder="Digite cnpj ou cpf" autocomplete="off">
						<label id="lblCnpj" style="color:red"></label>
					</div>
					
					<div class="form-group px-md-4">
						<label><strong>Fornecedor</strong></label>
						<input class="form-control" type="text" name="fornecedor"  placeholder="Digite o Fornecedor" autocomplete="off">
						<label id="lblFornecedor" style="color:red"></label>
					</div>
					<div class="form-group px-md-4">
						<label for="inputPassword4"><strong>Data Vencimento</strong></label>
						<input type="text" class="form-control"  name="dataInicioCalendar" id="calendarioIni" autocomplete="off" >
					</div>
					<div class="form-group px-md-4">
						<label><strong>Valor</strong></label>
						<input class="form-control" type="text" name="valor"  placeholder="Digite o Valor" autocomplete="off">
						<label id="lblValor" style="color:red"></label>
					</div>
					
					
					<div class="form-group px-md-4">
						<label><strong>Anexe aqui os arquivos</strong></label>
						<div>
							<p><input id="file" type="file" name="file[]" multiple></p>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button id="btn" class="btn btn-success">Upload all files</button>
							</div>
							
						</div>
					</div>
					
				</form>
				
			</div>
		</div>
	</div>		
</div> <!-- div list-group-item-->

<!-- Modal Edidar -->
<div class="modal fade" id="edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModaLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<form  action="updateeditarpesquisa.php" method ="POST"  >
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	
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
	function funcao( obj , e ){
	var tecla = ( window.event ) ? e.keyCode : e.which;
	if ( tecla == 8 || tecla == 0 )
	return true;
	if ( tecla != 44 && tecla < 48 || tecla > 57 )
	return false;
	}
	$("#cnpj").keydown(function(){
	try {
	$("#cnpj").unmask();
	} catch (e) {}
	
	var tamanho = $("#cnpj").val().length;
	
	if(tamanho < 11){
	$("#cnpj").mask("999.999.999-99");
	} else {
	$("#cnpj").mask("99.999.999/9999-99");
	}
	
	// ajustando foco
	var elem = this;
	setTimeout(function(){
	// mudo a posição do seletor
	elem.selectionStart = elem.selectionEnd = 10000;
	}, 0);
	// reaplico o valor para mudar o foco
	var currentValue = $(this).val();
	$(this).val('');
	$(this).val(currentValue);
	});
</script>

<script>
	
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
	
	
	
	
	document.getElementById('btn').addEventListener('click', function(){
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
		xmh.open('POST', 'serverFile.php');
		xmh.send(formdata);   
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



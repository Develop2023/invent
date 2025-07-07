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
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
          <?php  echo "".$_SESSION['usuarioNome']."&nbsp;&nbsp;&nbsp;";?>
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
                             <li> <a href="administrativo.php"><i class="fas fa-file-alt"></i>&nbsp;Administrativo</a></li>
							 <li> <a href="cadastro_xml.php"><i class="fas fa-file-alt"></i>&nbsp;XML</a></li>
                            <!-- <li class="active"> <a href="#"><i class="fab fa-elementor"></i>&nbsp;Item Menu</a></li>-->
                           </ul>

                    </li>
                   <!-- <li><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 1 </a></li>
                    <li><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 2 </a></li>
                    <li ><a href=""><i class="fas fa-long-arrow-alt-right"></i>&nbsp;Item 3</a></li>-->
                    <li><a href="sair.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a></li>
                  </ul>
                </nav>
                         <div class="content p-1">
                            <div class="list-group-item">
                              <div class="d-flex">
                                <div class="mr-auto p-2">
                                  <h2 class="display-4 til"><strong>Dashboard</strong></h2>
                                 
                                </div>
                              </div>

                              <div class="row mb-3">
                                <div class="col-lg-4 col-sm-5">                          
                                  <div class="card bg-success text-white">
                                    <div class="card-body">
									<?php 
										$registro="SELECT * FROM `files` WHERE id_status = 1 ";
										$rs_registros=mysqli_query($conn,$registro);
										$qtd_registro=mysqli_num_rows($rs_registros);	
									?>
									
                                      <h6 class="card-title"><i class="fas fa-file fa-3x"></i>&nbsp;Lançados</h6>
                                      <h2 class="lead"> Qtd.: <?php echo $qtd_registro;?></h2>
                                    </div>
                                  </div>
                                </div> <!--  --> 

                                <div class="col-lg-4 col-sm-4">                          
                                  <div class="card bg-danger text-white">
                                    <div class="card-body">
									<?php 
										$registro="SELECT * FROM `files` WHERE id_status = 2 ";
										$rs_registros=mysqli_query($conn,$registro);
										$qtd_registro=mysqli_num_rows($rs_registros);	
									?>
                                      <h6 class="card-title">
										<i class="fas fa-file fa-3x"></i>&nbsp;Pendentes</h6>
                                      <h2 class="lead">Qtd.: <?php echo $qtd_registro;?>
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="frm_pendentes.php" class="badge badge-danger">
											<i class="fas fa-search fa-1x"></i>
											Buscar</a>
										  </h2>
									    
                                    </div>
                                  </div>
                                </div>
                              <!--  <div class="col-lg-3 col-sm-3">                          
                                  <div class="card bg-warning text-white">
                                    <div class="card-body">
									<?php 
										$registro="SELECT * FROM `files` WHERE id_status = 4 ";
										$rs_registros=mysqli_query($conn,$registro);
										$qtd_registro=mysqli_num_rows($rs_registros);	
									?>
                                      <h6 class="card-title"><i class="fas fa-eye fa-3x"></i>&nbsp; Visualizados</h6>
                                      <h2 class="lead"> Qtd.: <?php echo $qtd_registro;?></h2>
                                    </div>
                                  </div>
                                </div>  -->
                                <div class="col-lg-4 col-sm-4">                          
                                  <div class="card bg-info text-white">
                                    <div class="card-body">
									<?php 
										$registro="SELECT * FROM `files` WHERE id_status = 4 ";
										$rs_registros=mysqli_query($conn,$registro);
										$qtd_registro=mysqli_num_rows($rs_registros);	
									?>
                                      <h6 class="card-title"><i class="fas fa-comments fa-3x"></i>&nbsp;Aguardando Ajuste</h6>
                                      <h2 class="lead"> Qtd.: <?php echo $qtd_registro;?></h2>
                                    </div>

                                  </div>

                                </div> 
                                <br>  <br><br><br><br><br><br><br>
                                <!---  LAYOUT GRAFICO  --->
                           <div class="container"   >
                               <hr>
						<?php 
							
							$nomes=[];
							$quantidades=[];
							
							$select = "Select count(files.id_cc) as qtd,
							files.nome_colab as Nomes
							from files 
							left join unidade unidade ON unidade.id = files.id_cc
							WHERE MONTH(date) = MONTH(CURRENT_DATE())
							group by files.id_cc,files.nome_colab
							HAVING qtd > 5
							"
							;
							$result = mysqli_query($conn, $select);
							while($linhas = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
								$nomes []= "'{$linhas['Nomes']}'";
								$quantidades[] = $linhas['qtd'];
							}
							$nomes = implode(',',$nomes);
							$quantidades= implode(',',$quantidades);
							
						?> 
												
						<div  align="center" id="grafico"></div>
						<script> 
							let el = document.getElementById('grafico');
							let options = {
							chart: {
							type: 'bar',
							width: 700,
							heigth:250
						},				
						dataLabels: {
							style: {
								colors: ['#000000']
							}
						},
						
						series: [
						{    
							name: "Qtda por Dpto", 
							data:[ <?= $quantidades?>]						  
							
						}
						],
						
						xaxis: {
							
							categories:[<?= $nomes?>],
							
						},
						title: {
							align: 'center',
							fontWeight:  'bold',
							text: "Lançamentos por Departamento dentro do Mês" 
						} 
					}; 
					
					let chart = new ApexCharts(el , options);
					chart.render();
				</script>
				<div> <p> <font size="2" style="color:#FF0000" > 
				<strong>*Lançamento acima de 05 aparecerem no Gráfico* </strong> </p>
				</font>
				</div>
				<hr>
				</div>     
         </div>

                      

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="js/dash.js"></script>

  </body>
  </html>
<?php
	
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "segu7391_nfe";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	mysqli_set_charset($conn,"utf8");
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
		
	}	
	
?>
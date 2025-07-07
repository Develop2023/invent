<?php
	$servidor = "162.241.63.36";
	$usuario = "segu7391_admin";
	$senha = "mga#@2022";
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
<?php ob_start(); ?>
<?php
	
session_start();

	// Remove Todas as Informações na variaveis globais
	unset($_SESSION['usuarioId'],	$_SESSION['usuarioNome'],$_SESSION['usuarioNiveisAcessoId'],$_SESSION['usuarioEmail']
	//	$_SESSION['usuarioSenha'],$_SESSION['usuarioId_f']
		);
	
	$_SESSION['msg'] = "Deslogado com Sucesso !";
	//redirecionar o usuario para a página de login
	header("Location: index.php");

?>
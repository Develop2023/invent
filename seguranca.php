<?php
ob_start();
if(($_SESSION['usuarioId']=="") || 
	($_SESSION['usuarioId_f']=="") ||
	($_SESSION['usuarioNome']=="") ||
	($_SESSION['usuarioNiveisAcessoId']=="") ||
	($_SESSION['usuarioEmail']=="") ||
	($_SESSION['usuarioId']=="") ||
	($_SESSION['usuarioSenha']=="")){
		unset (
		          $_SESSION['usuarioId'],            
		          $_SESSION['usuarioId_f'],         
		          $_SESSION['usuarioNome'],          
                  $_SESSION['usuarioNiveisAcessoId'],
                  $_SESSION['usuarioEmail'],         
                  $_SESSION['usuarioSenha']);

	 // Mensagem Erro
	 $_SESSION['loginErro'] = "Àrea restrita para Usuários Cadastrados";	 
	 // Manda o usuário para a tela de Login
	 
	 header("Location:index.php");
	
	}
	
	
?>
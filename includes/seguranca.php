<?php
// A sessão precisa ser iniciada em cada página diferente
  if (!isset($_SESSION)) session_start();
    
  // Verifica se não há a variável da sessão que identifica o usuário
  if (!isset($_SESSION['usuarioId'])) {
      // Destrói a sessão por segurança
        
	$_SESSION['msg'] = "Você tentou Acessar esta página sem fazer o LOGIN !!!!!";
	//redirecionar o usuario para a página de login
	header("Location: index.php");
  }
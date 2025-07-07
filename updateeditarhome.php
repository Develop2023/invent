<?php ob_start(); ?>
<?php 	
	session_start();
	include("includes/conf.php");
	
	// Variaveis paginas index.php e home.php
	$id_userhe = $_SESSION['usuarioId'];
	//echo"<br> Id: ".$id_userhe."<br>";
	$id_unidade = $_SESSION['usuarioIdUnidade'];
	$nome_colab = $_SESSION['usuarioNome'];
	//echo"<br> Nome: ".$nome_colab."<br>";
	$id_unidade = $_SESSION['usuarioIdUnidade'];
	
	/* echo "<prev>";
		var_dump($_POST);
	echo "<prev>";*/
	
	if(isset($_POST['updatedatahome'])){
		
		
		$id= $_POST['update_id'];
		$fornecedor= $_POST['fornecedor'];
		// $descricaoarquivo= $_POST['descricaoarquivo'];
		$id_tipodoc= $_POST['select01'];
		$nfe = $_POST['nfe'];
		$valor =str_replace(',','.', str_replace('.','', $_POST['valor']));
		$obs =$_POST['obs'];
		$id_cc = filter_input(INPUT_POST, 'filial', FILTER_SANITIZE_STRING);
		
		echo $str = $valor;
		
		$fetch = "UPDATE files SET fornecedor='$fornecedor',id_tipodoc='$id_tipodoc',cnpj_cpf='$nfe',valor='$str',obs='$obs',id_cc='$id_cc' WHERE id='$id'";
	    $result = mysqli_query($conn,$fetch );
		if(mysqli_affected_rows($conn)>0){       
			$_SESSION['sms']="Status alterado com Sucesso!";
			header("Location: home.php");
			}else{
			$_SESSION['msger']="Status não foi alterado com Sucesso!";
			header("Location: home.php");
		}
		
	}	
	
	
	
	?>
		
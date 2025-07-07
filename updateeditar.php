<?php ob_start(); ?>
<?php 	
session_start();
include("includes/conf.php");

// Variaveis paginas index.php e home.php
  $id_userhe = $_SESSION['usuarioId'];
  echo"<br> Id: ".$id_userhe."<br>";
  $id_unidade = $_SESSION['usuarioIdUnidade'];
  $nome_colab = $_SESSION['usuarioNome'];
  echo"<br> Nome: ".$nome_colab."<br>";
  $id_unidade = $_SESSION['usuarioIdUnidade'];
  
 /* echo "<prev>";
  var_dump($_POST);
   echo "<prev>";*/

   if(isset($_POST['updatedata'])){


	    $id= $_POST['update_id'];
	    $fornecedor= $_POST['fornecedor'];
	   // $descricaoarquivo= $_POST['descricaoarquivo'];
	    $id_tipodoc= $_POST['select01'];
	    $nfe = $_POST['nfe'];
	   $valor = $_POST['valor'];
	  $str = str_replace(',', '.', $valor); // remove o ponto
	    $obs =$_POST['obs'];

	   $fetch = "UPDATE files SET fornecedor='$fornecedor',id_tipodoc='$id_tipodoc',cnpj_cpf='$nfe',valor='$str',obs='$obs' WHERE id='$id'";
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

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
	   $id_tipodoc= $_POST['select01'];

	   $fetch = "UPDATE files SET fornecedor='$fornecedor',id_tipodoc='$id_tipodoc'  WHERE id='$id'";
	    $result = mysqli_query($conn,$fetch );
          if(mysqli_affected_rows($conn)>0){       
           $_SESSION['sms']="Status alterado com Sucesso!";
				  header("Location: administrativo.php");
          }else{
		        $_SESSION['msger']="Status não foi alterado com Sucesso!";
				header("Location: administrativo.php");
		  }
	 
	}	



?>

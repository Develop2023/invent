<?php
ob_start();session_start();

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
		
	    $id_status= $_POST['id_status'];
		$id_cc = filter_input(INPUT_POST, 'filial', FILTER_SANITIZE_STRING);
	   
	   $fetch = "UPDATE files SET fornecedor='$fornecedor',id_status='$id_status',id_cc='$id_cc' WHERE id='$id'";
	    $result = mysqli_query($conn,$fetch );

        if(mysqli_affected_rows($conn) > 0){
       
       $_SESSION['sms'] = "Status alterado com Sucesso!";
	 header("Location: frm_pendentes.php");
		   
          }else{
	 $_SESSION['msger'] = "Status n���o foi alterado com Sucesso!";
	      header("Location: frm_pendentes.php");
				
		  }
	 
	}	
			
	
	
?>

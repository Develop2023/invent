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
  
   if(isset($_POST['employee_id'])){
	   $id= $_POST['employee_id'];
	   
	   $fetch = "SELECT * from files WHERE id='$id'";
	    $result = mysqli_query($conn,$result);
		while ($data = mysqli_fetch_array($result)) {  ?>	
		  
        	<p><b>Files Details</b></p>	
			<p><?php echo $data['fornecedor'];?></p>
			
			
	  <?php 
	    }
	  }
  
	
?>

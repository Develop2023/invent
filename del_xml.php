<?php ob_start(); ?>
<?php 

 include("includes/conf.php");
					
/*
					echo  $idfiles=$_GET['id'];

				  $delete = "DELETE FROM `files` where id='$idfiles'";
					   $result= mysqli_query($conn,$delete);
					   
					   
					   
	 if(mysqli_affected_rows($conn)>0){
       
               $_SESSION['sms'] = "Arquivo apagado com Sucesso!";
                 //header("Location: home.php");
          }else{
		          $_SESSION['msger'] = "Arquivo não pode ser apagado!";
				//header("Location: home.php");
		  }*/
		  
   
							
					if(isset($_GET['id'])) {
					$idfiles = trim($_GET['id']);
					
			        $seach=mysqli_query($conn,"select * from xml_cadastro where id_xml=$idfiles");	
						while ($row = mysqli_fetch_assoc($seach)) {
							$imageName = $row['nome_xml'];
							$file="uploadxml/".$imageName;
						   
						  if(is_file($file) && @unlink($file)){
								// delete success
							} else if (is_file ($file)) {
								// unlink failed.
								// you would have got an error if it wasn't suppressed
							} else {
							  // file doesn't exist
							}
						}
					$query = mysqli_query($conn,"DELETE  FROM xml_cadastro WHERE id_xml=$idfiles")
					 or die ("database error:". mysqli_error($conn));
					
		if(mysqli_affected_rows($conn)>0){
       
               $_SESSION['sms'] = "Arquivo apagado com Sucesso!";
                 header("Location: cadastro_xml.php");
          }else{
		          $_SESSION['msger'] = "Arquivo não pode ser apagado!";
				header("Location: cadastro_xml.php");
		  }
	 }
					
?> 
<?php ob_start(); ?>
<?php 
	session_start();
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_SESSION['usuarioId'])){
}else{
  $_SESSION['msg'] = "Área restrita ";
  header("Location: index.php");  
}

include_once("includes/header.php");
include_once("includes/conf.php");      



  $id = $_GET["id"];

   

$query_insert = "SELECT nome_xml FROM xml_cadastro where id_xml='$id'";
  $enviar = mysqli_query($conn, $query_insert);
  
  $result = mysqli_fetch_array($enviar);
    // echo $result['fornecedor']."<br/>";
      echo $result['nome_xml'];


?>

<!DOCTYPE html>
<html>
<head>
  

</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<style type="text/css">
    html, body, div, iframe {margin:0; padding:0; height:95%}
    iframe {display:block; width:95%; border:none}
  </style>

 
<body  >
        <div class="container"> 
    <iframe src="uploadXML/<?php echo $result['nome_xml'];?>" width='0' height='0' ></iframe>

    </div>

</body>
</html>

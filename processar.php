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
 

		   //Variaveis Formulario home.php
		 $cnpj_cpf = mysqli_escape_string($conn,$_POST['cnpj']);
		 $cpf_cnpj=preg_replace( '#[^0-9]#', '', $cnpj_cpf );
		 echo "<br>".$cpf_cnpj."<br>";

		 $numero= mysqli_escape_string($conn,$_POST['numero']);
		 $valor=str_replace(',', '.', $numero);
		 echo $valor."<br>";

		 $fornecedor = mysqli_escape_string($conn,$_POST['descricao']);
		 echo $fornecedor."<br>";
		 $vencimento = mysqli_escape_string($conn,$_POST['dataInicioCalendar']);
		  //$dtransf tranforma a $dataadmissao  que é dd/mm/yyyy em yyyy-mm-dd que é o formato aceito em MySQL.
		  $vencimento = date("d/m/Y");
		  $dtransf = explode ("/", $vencimento);
		  $dtransf1 = "$dtransf[2]-$dtransf[1]-$dtransf[0]";
		  echo"<br> Date Formatada: ".$dtransf1."<br>";


      if(isset($_POST['enviar'])) {
       
      $formatPermitidos = array("pdf","doc","docx","xls","xlsx");
      $qtdaArquivos = count($_FILES['arquivo']['name']); 
      $contador = 0;
       while ($contador < $qtdaArquivos) {
        
        $extencao = pathinfo($_FILES['arquivo']['name'][$contador], PATHINFO_EXTENSION);

        if(in_array($extencao, $formatPermitidos)) {
          $uploadFiles = "uploadFiles/";
          $temporario = $_FILES['arquivo']['tmp_name'][$contador]; 
          $novoNome = uniqid().".$extencao";
          
        if(move_uploaded_file($temporario, $uploadFiles.$novoNome)) {
       
	  		//echo "O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso. <br />"; 
				
$query_insert = "INSERT INTO files(date,nome_colab,id_unidade,
fornecedor,dt_vencimento,arquivo_nome,arquivo_local,id_userhe,cnpj_cpf,valor)
	Values(NOW(),'$nome_colab','$id_unidade','$fornecedor','$dtransf1','$novoNome','$uploadFiles','$id_userhe','$cpf_cnpj','$valor')";
				$enviar = mysqli_query($conn, $query_insert);
         
        if(mysqli_affected_rows($conn)>0){
       
            $_SESSION['msg']="Upload Feito com Sucesso para $uploadFiles$novoNome<br>";
                  header("Location: home.php");
          }else{
		          $_SESSION['msg']="Upload Não Foi enviado $uploadFiles$novoNome<br>";
				  header("Location: home.php");
		  }
       
	   }else{
              echo "$extencao não é permitida<br>";
       } 
         $contador++;

       } //endwhile

  } // 1º IF
  }
 ?>
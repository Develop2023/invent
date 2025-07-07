<?php ob_start(); ?>
<?php 
 session_start();
include_once "./includes/conf.php";

// Variaveis paginas index.php e home.php
  $id_userhe = $_SESSION['usuarioId'];
  //echo"Id: ".$id_userhe."<br>";
  $id_unidade = $_SESSION['usuarioIdUnidade'];
  $nome_colab = $_SESSION['usuarioNome']; 
  //echo"<br> Nome: ".$nome_colab."<br>";
  $id_unidade = $_SESSION['usuarioIdUnidade'];
 
 


	$count = count($_FILES['arquivos']['name']);
	$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
	$fornecedor = filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING);
	$id_cc = filter_input(INPUT_POST, 'filial', FILTER_SANITIZE_STRING);
	
	
		if ( (!$cnpj) || (!$fornecedor) ){
	
	
	// $_SESSION['sms']= "Todos os campos estão preenchidos!";
    $_SESSION['sms']="Você não preencheu todos os campos.";
      header("Location: ./frm_pendentes.php");
	 
		}else{
		// $_SESSION['sms']="Enviado com Sucesso!"; 
		//header('Location: hhome.php?');
		$cc ="select  ff.descricao as Nome_cc from filiais ff
		INNER JOIN files f ON  f.id_cc =ff.id	   
		where ff.id='$id_cc'";
		$pp =mysqli_query($conn, $cc);
		
		while ($a = mysqli_fetch_assoc($pp)) {
		echo $decricao= $a['Nome_cc'];
		}

		
	    	require_once('PHPMailer/PHPMailerAutoload.php');
	
	$oMail = new PHPMailer();
	$oMail->isSMTP();
	$oMail->Host = 'smtp.gmail.com';
	$oMail->Username = 'administrator@seguralogistica.com.br';
	$oMail->Password = '@pernalonga#2018';
	/***/
	$oMail->SMTPAuth = true;
	$oMail->SMTPSecure = 'tls';
	$oMail->Port = 587;
	$oMail->CharSet = "UTF-8";
	/* Envio de mensaje */
	$oMail->setFrom('lancamentos@seguralogistica', 'Lançamento Nf-e portal Segura Logística ');
    $oMail->addAddress('lancamentos@seguralogistica.com.br');
	$oMail-> IsHTML (true);
	$oMail->Subject = "E-mail Enviado pela Page Nf-e";
	$oMail->Body    .= "<h3>Enviado por: ".$nome_colab." </h3> <h3>Número(s) NF-e(S)  ".$_POST['cnpj']."</h3>";
	$oMail->AltBody .= "Este é um corpo alternativo apenas em texto.";
	$oMail->Body .="Arquivo lançados por: ".$nome_colab."<br/>";
    $oMail->Body .="Fornecedor: ".$_POST['fornecedor']."<br>";
	$oMail->Body .="Data de Vencimento:".$_POST['dataInicioCalendar']."<br/>";
	$oMail->Body .="Centro de Custo: ".$decricao."<br/>";
	$oMail->Body .="Valor: ".$_POST['valor']."<br/>";
	$oMail->Body .="<strong>Qtd. de Anexo(s) enviado(s): ".$count."</strong><br/>";
	$oMail->Body .="Mensagem:  ".$_POST['txt_area']."<br/>";
     
	
	
	
	if(!$oMail->send()) {
		echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
		} else {
		
		
		//Variaveis Formulario home.php
		$cnpj_cpf = mysqli_escape_string($conn,$_POST['cnpj']);
		// $cpf_cnpj=preg_replace( '#[^0-9]#', '', $cnpj_cpf );
		echo "<br>".$cnpj_cpf."<br>";
		
		$numero= mysqli_escape_string($conn,$_POST['valor']);
		$valor1=str_replace('.', '', $numero);
		$valor=str_replace(',', '.', $valor1);
		//echo "Valor ".$valor."<br>";
		$obs= mysqli_escape_string($conn,$_POST['txt_area']);
		
		$fornecedor = mysqli_escape_string($conn,$_POST['fornecedor']);
		$vencimento = mysqli_escape_string($conn,$_POST['dataInicioCalendar']);
		//$dtransf tranforma a $dataadmissao  que é dd/mm/yyyy em yyyy-mm-dd que é o formato aceito em MySQL.
		//$vencimento = date("d/m/Y");
		$dtransf = explode ("/", $vencimento);
		$dtransf1 = "$dtransf[2]-$dtransf[1]-$dtransf[0]";
		//echo"<br> Date Formatada: ".$dtransf1."<br>";
		
					
				 if (isset($_FILES['arquivos'])) {
			if (count($_FILES['arquivos']['name']) > 4)
			$_SESSION['msger']= 'O máximo são 5 arquivos';
				 }
		$uploadFiles ="uploadFiles/";
		// arquivos permitidos
		$arquivos_permitidos = ["pdf","doc","docx","xls","xlsx"]; 	
		
		// capturar dados do Form
		$arquivos = $_FILES['arquivos']; 
		
		
		// capturar nomes dos arquyivos
		$nomes = $arquivos['name'];
		
		for($i = 0; $i <count($nomes); $i++){
		
		$extensao = explode('.',$nomes[$i]);
		$extensao = end($extensao);
		$nomes[$i] = Date('my').'_'.$nomes[$i];
		
		//	verifica extenção dos arquivos	
		if(in_array($extensao,$arquivos_permitidos)){ 
		
		$query_insert = "INSERT INTO files (date,nome_colab,id_unidade,	fornecedor,dt_vencimento,
		arquivo_nome,arquivo_local,id_userhe,cnpj_cpf,valor,obs,id_cc) 	
		VALUES(NOW(),'$nome_colab','$id_unidade','$fornecedor','$dtransf1',
		'$nomes[$i]','$uploadFiles','$id_userhe','$cnpj_cpf','$valor','$obs','$id_cc')";
		$enviar = mysqli_query($conn, $query_insert);
		
		if(mysqli_affected_rows($conn)>0){
		$mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i],$uploadFiles.$nomes[$i]);
		
		$_SESSION['sms']="Enviado com Sucesso!";			
		
		header("Location: ./frm_pendentes.php");
		
		} //if MySQL 
		
		}	
		else{
		$_SESSION['msger']="***Arquivo não foi enviado !!!, Possivelmente não é o formato permitido! *xls.*doc,*pdf,*docx,*xlsx.***";
		header("Location: ./frm_pendentes.php");
		
				  }// FIM ELSE
						
					}// If if_array
					
				 }//for
				
				
		
		}		
	  
	
?>
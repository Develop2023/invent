<?php
session_start();
 include_once("./includes/conf.php");
 

//Incluindo a conexão com banco de dados
 "Usuario: ". $_SESSION['usuarioNome']."<br />";	
//echo "ID:" .$_SESSION['usuarioId_f']."<br /><br />";
 
  $nome                         =$_POST['nome'];
   $email                        =$_POST['email'];
  $senha                        =md5($_POST['senha']);
  $status                       =$_POST['status'];
  $nivel_acesso                 =$_POST['nivel_de_acesso'];
  $id_unidade				   =$_POST['unidade'];

 
 /*$nome =  'AAAA'; 
 $email =    'AAA';                   
 $senha = '1236'; 
  $status =$_POST['status'];
 $id_unidade='2';			   
 $nivel_acesso='1';*/
 

 
  $sql = mysqli_query($conn,"INSERT INTO usuarioshe (`id`,`data`,`nome`,`email`,`senha`,`status`,`id_nivelacesso`,`id_unidade`)
  VALUES (NUll,NOW(),'".$nome."','".$email."','".$senha."','".$status."','".$nivel_acesso."','".$id_unidade."')")
	or die (mysqli_error());
			  
     // print_r($_POST);

    if(mysqli_affected_rows($conn)> 0){
	 
	 
	 $_SESSION['msg']="Usuário cadastrado com Sucesso.<br>";
                  header("Location: ./listar.php");
          }else{
		          $_SESSION['msger']="Usuário Não cadastrado!!!.<br>";
				  header("Location: ./listar.php");
		  }
		  
	 

 
?>		
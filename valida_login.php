<?php
ob_start();
include_once 'includes/seguranca.php';
include_once("includes/conf.php");

             if((isset($_POST['email'])) && (isset($_POST['senha']))){
	     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	     $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
              $senha = md5($senha);
            
            //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_usuario = "SELECT  us.*,
		us.id id, 
		us.nome nome, 
		us.email email, 
		us.senha senha, 
		us.id_nivelacesso 
		id_nivelacesso, 
		us.id_unidade id_unidade,
		arq.id as arquivo_id
		 FROM `usuarioshe` us
		LEFT  JOIN  files arq ON arq.id=us.id
		 WHERE email = '$email' && senha='$senha'";
		$result=mysqli_query($conn,$result_usuario);
		$resultado = mysqli_fetch_assoc($result);
	     //echo "Nome : ".$resultado['nome']. "<br />";
                if(empty($resultado)){
                    $_SESSION['msg']="Usuário ou Senha Inválidos";
                    header("Location: index.php");
	      }elseif(isset($resultado)){
			//Define os valores atribuídos na sessão do Usuário
			$_SESSION['usuarioId']              = $resultado['id'];
			$_SESSION['usuarioNome']            = $resultado['nome'];
			$_SESSION['usuarioEmail']           = $resultado['email'];
		        $_SESSION['usuarioSenha']           = $resultado['senha'];
		    $_SESSION['usuarioNiveisAcessoId']  = $resultado['id_nivelacesso'];
		    $_SESSION['usuarioArquivo_id']       = $resultado['arquivo_id'];
			$_SESSION['usuarioIdUnidade']       = $resultado['id_unidade'];

              }if($_SESSION['usuarioNiveisAcessoId'] == "1"){
				header("Location: adm.php");
				
			}elseif($_SESSION['usuarioNiveisAcessoId'] == "4"){
				header("Location:  home.php");

			}elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
				header("Location:  cont.php");

			}else{
		         $_SESSION['msg'] = "Usuário não cadastrado";
				header("Location: index.php");
				 
				}
			}
		 

            
        ?>

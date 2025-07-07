				<?php ob_start(); ?>
				<?php
				session_start();
				include_once "./includes/conf.php";

				// Variaveis paginas index.php e home.php
				$id_userhe = $_SESSION['usuarioId'];
				echo "<br> Id: " . $id_userhe . "<br>";
				$id_unidade = $_SESSION['usuarioIdUnidade'];
				$nome_colab = $_SESSION['usuarioNome'];
				echo "<br> Nome: " . $nome_colab . "<br>";
				$id_unidade = $_SESSION['usuarioIdUnidade'];




				/*$count = count($_FILES['arquivos']['name']);
				/*$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
				$fornecedor = filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING);

				if ((!$cnpj) || (!$fornecedor)) {


					// $_SESSION['sms']= "Todos os campos estão preenchidos!";
					$_SESSION['sms'] = "Você não preencheu todos os campos.";
					header('Location: administrativo.php?');
				} else {
					// $_SESSION['sms']="Enviado com Sucesso!"; 
					//header('Location: hhome.php?');


					/*require_once('PHPMailer/PHPMailerAutoload.php');
					
					$oMail = new PHPMailer();
					$oMail->isSMTP();
					$oMail->Host = 'smtp.gmail.com';
					$oMail->Username = 'administrator@seguralogistica.com.br';
					$oMail->Password = '@pernalonga#2018';
					
					$oMail->SMTPAuth = true;
					$oMail->SMTPSecure = 'tls';
					$oMail->Port = 587;
					$oMail->CharSet = "UTF-8";
					/* Envio de mensaje 
					$oMail->setFrom('lancamentos@seguralogistica', 'Lançamento Nf-e portal Segura Logística ');
					$oMail->addAddress('lancamentos@seguralogistica.com.br');
					$oMail-> IsHTML (true);
					$oMail->Subject = "E-mail Enviado pela Page Nf-e";
					$oMail->Body    .= "<h3>Enviado por: ".$nome_colab." </h3> <h3>Número(s) NF-e(S)  ".$_POST['cnpj']."</h3>";
					$oMail->AltBody .= "Este é um corpo alternativo apenas em texto.";
					$oMail->Body .="Arquivo lançados por: ".$nome_colab."<br/>";
					$oMail->Body .="Fornecedor: ".$_POST['fornecedor']."<br/>";
					$oMail->Body .="Data de Vencimento:".$_POST['dataInicioCalendar']."<br/>";
					$oMail->Body .="Valor: ".$_POST['valor']."<br/>";
					$oMail->Body .="<strong>Qtd. de Anexo(s) enviado(s): ".$count."</strong><br/>";
					$oMail->Body .="Mensagem:  ".$_POST['txt_area']."<br/>";
					
					
						//echo "<prev>";
					//var_dump($oMail);
					//echo "</prev>";
					
					if(!$oMail->send()) {
						echo 'Não foi possível enviar a mensagem.<br>';
						echo 'Erro: ' . $mail->ErrorInfo;
						} else {*/


				//Variaveis Formulario home.php
				//$cnpj_cpf = mysqli_escape_string($conn, $_POST['cnpj']);
				// $cpf_cnpj=preg_replace( '#[^0-9]#', '', $cnpj_cpf );
				//echo "<br>" . $cnpj_cpf . "<br>";

				//$numero = mysqli_escape_string($conn, $_POST['valor']);
				//$valor1 = str_replace('.', '', $numero);
				//$valor = str_replace(',', '.', $valor1);
				//echo "Valor ".$valor."<br>";
				//$obs = mysqli_escape_string($conn, $_POST['txt_area']);

				//$fornecedor = mysqli_escape_string($conn, $_POST['fornecedor']);
				//$fornecedor;
				//$vencimento = mysqli_escape_string($conn, $_POST['dataInicioCalendar']);
				//$dtransf tranforma a $dataadmissao  que é dd/mm/yyyy em yyyy-mm-dd que é o formato aceito em MySQL.
				//$vencimento = date("d/m/Y");
				//$dtransf = explode("/", $vencimento);
				//$dtransf1 = "$dtransf[2]-$dtransf[1]-$dtransf[0]";
				//echo"<br> Date Formatada: ".$dtransf1."<br>";


				if (isset($_FILES['arquivos'])) {

                    /*	echo '<pre>';
					 var_dump($_FILES);
					echo '</pre>';*/

					$xml = simplexml_load_file($_FILES['arquivos']["tmp_name"]);
					// echo '<pre>';
					// print_r($xml);
					//echo '</pre>';

					$Name_xml = md5(basename($_FILES['arquivos']['name'])) . time() . ".xml";
				

					// Exibe as informações do XML
					echo "<h3>Informações da Nota Fiscal</h3>";
				    echo 'Chave de Acesso: ' . str_replace("NFe", "", $xml->NFe->infNFe['Id']) . '<br>';
				    echo 'Série: '                                  . $xml->NFe->infNFe->ide->serie . '<br>';
				    echo 'Nota Fiscal: '                            . $xml->NFe->infNFe->ide->nNF . '<br>';
				    echo 'Total Valor NF-e: '                       . $xml->NFe->infNFe->total->ICMSTot->vNF . '<br>';
				    echo 'Data de Emissão: ' .  date('d/m/Y', strtotime($xml->NFe->infNFe->ide->dhEmi)) . '<br>';

                    echo "<h3>Emitente</h3>";
					echo 'Emitente/CNPJ: '                          . $xml->NFe->infNFe->emit->CNPJ . '<br>';
					echo 'Emitente/Razão Social: '                  . $xml->NFe->infNFe->emit->xNome . '<br>';
					echo 'Endereço: ' . $xml->NFe->infNFe->emit->enderEmit->xLgr . ', ' . $xml->NFe->infNFe->emit->enderEmit->nro . '<br>';
                     
					echo "<h3>Destinatário</h3>";
					echo 'Destinatario/Doc: '  . $xml->NFe->infNFe->dest->CNPJ . '<br>';
					echo 'Destinatario/Nome: ' . $xml->NFe->infNFe->dest->xNome . '<br>';
					echo 'Endereço: ' . $xml->NFe->infNFe->dest->enderDest->xLgr . ', ' . $xml->NFe->infNFe->dest->enderDest->nro . '<br>';
					
					 $cnpj_xml  = $xml->NFe->infNFe->emit->CNPJ;
					 $emitente_xml = $xml->NFe->infNFe->emit->xNome;
					 $nr_chave_xml = str_replace("NFe", "", $xml->NFe->infNFe['Id']);
                     $nr_nfe_xml = $xml->NFe->infNFe->ide->nNF ;
                     $valor_nfe_xml =$xml->NFe->infNFe->total->ICMSTot->vNF ;
					 $dataemissao_xml =date('Y-m-d', strtotime($xml->NFe->infNFe->ide->dhEmi)); 
                     
					 $cnpj_destinatario =$xml->NFe->infNFe->dest->CNPJ;
					 $empresa_xml = $xml->NFe->infNFe->dest->xNome  ; 
					
					 $diretorio ="uploadXML/";
					 // arquivos permitidos
					$arquivos_permitidos = ["xml"];
					// capturar dados do Form
					$arquivos = $_FILES['arquivos'];
					// capturar nomes dos arquyivos
					/*$nomes = $arquivos['name'];
					$extensao = explode('.', $nomes);
					$extensao1 = end($extensao);*/
					
					
$query_insert = "INSERT INTO xml_cadastro (cnpj_xml,
                                          emitente_xml,nr_chave_xml,
										  nr_nfe_xml,valor_nfe_xml,
										  dataemissao_xml,cnpj_destinatario,empresa_xml,nome_xml,xml_diretorio)
   VALUES ('$cnpj_xml','$emitente_xml','$nr_chave_xml','$nr_nfe_xml','$valor_nfe_xml',
   '$dataemissao_xml','$cnpj_destinatario','$empresa_xml','$Name_xml','$diretorio') ";
                     
					$enviar = mysqli_query($conn, $query_insert);
					if(mysqli_affected_rows($conn)>0){
						$mover = move_uploaded_file($_FILES['arquivos']['tmp_name'], $diretorio.$Name_xml);
						
						$_SESSION['sms']="Enviado com Sucesso!";
				}
			}
		?>
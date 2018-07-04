<?php
				
		// inclui o arquivo de configuração
		require_once '../configuration.php';
		require_once ROOT . "/utils.php";
		require_once '../assets/smarty-3.1.32/libs/Smarty.class.php';
		// define variáveis e inicializa com valores vazios
		$email = $password = "";
		$email_err = $password_err = "";
		$active_err = "";
		$err = array(
			'email' => "",
			'password' => "",
			'active' => ""
		);
		
		// processa os dados do formulário quando for submetido
		$smarty = new Smarty();
		$smarty->template_dir = '../views';
		$smarty->compile_dir = '../tmp';
		
		if(isset($_POST['submit'])){
			// verificar se o email está vazio
			if(empty(trim($_POST["email"]))){
				$email_err = 'Please enter email.';
			} else{
				$email = trim($_POST["email"]);
			}
			
			// verificar se o password está vazio
			if(empty(trim($_POST['password']))){
				$password_err = 'Please enter your password.';
			} else{
				$password = trim($_POST['password']);
			}
			
			// validar credenciais
			if(empty($email_err) && empty($password_err)){
				// preparar um select statement
				$sql = "SELECT email, password, active, id_client FROM clients WHERE email = ?";
				
				if($stmt = mysqli_prepare($conn, $sql)){
					// conecta as variáveis como parâmetro no statement preparado
					mysqli_stmt_bind_param($stmt, "s", $param_email);
					
					// define os parâmetros
					$param_email = $email;
					
					// tenta executar o statement preparado
					if(mysqli_stmt_execute($stmt)){
						// armazena o resultado
						mysqli_stmt_store_result($stmt);
						
						// verifica se o email existe, depois verifica o password
						if(mysqli_stmt_num_rows($stmt) == 1){                    
							// conecta as variáveis de resultado
							mysqli_stmt_bind_result($stmt, $email, $correct_password, $active, $id_client);
							if(mysqli_stmt_fetch($stmt)){
								if(encrypt($password) == $correct_password){
									//password está correto, verifica se o usuário esta ativo
									if($active == 1){
									/*se o usuário estiver ativo, então uma nova sessão vai
									ser iniciada e um email salvo*/ 
									session_start();
									$_SESSION['email'] = $email;     
									$_SESSION['id_client'] = $id_client;      
									header("location: ../index.php");
								}
								else{
									// mostra uma mensagem de erro caso o usuário não esteja ativo
									$active_err = 'Este usuário foi desativado, contate o suporte para mais informações.';
								}
							} else{
								// mostra uma mensagem de erro caso o password seja inválido
								$password_err = 'A senha que você inseriu está incorreta.';
							}
						}
					} else{
						// mostra uma mensagem de erro caso não exista o email
						$email_err = 'Não existe uma conta com esse nome de usuário.';
					}
				} else{
					echo "Oops! Algo deu errado. Tente novamente mais tarde.";
				}
				// fecha o statement
				mysqli_stmt_close($stmt);
			}
		}
	}
	$err['email'] = $email_err;
	$err['password'] = $password_err;
	$err['active'] = $active_err;
	$smarty->assign('err', $err);
	$smarty->display('login.tpl');
?>
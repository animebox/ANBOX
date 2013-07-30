<?php
	$msg = "";
	
	#Include nas funcoes do usuário
	include('functions/banco-usuario.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancousuario;
	
	#Trabalha com Post
	if(isset($_POST["acao"]) && $_POST["acao"] != ''){
		$email = strip_tags(trim(addslashes($_POST["email"])));
		$senha = strip_tags(trim(addslashes($_POST["senha"])));
		
		#Busca Usuário no banco e verifica se ele existe
		$result = $banco->BuscaUsuario($email);
		$num_rows = $banco->Linha($result);
		$rs = mysql_fetch_array($result , MYSQL_ASSOC);
		if(!$num_rows) {
			$msg = "Usuário não cadastrado!";
		}else if($senha === $rs['USUARIOSENHA']){
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['senha'] = $senha;
			if($rs['USUARIOADM'] == '1'){
				$banco->RedirecionaPara('administrativo');
			} else {	
				$banco->RedirecionaPara('principal');
			}
		}else{
			$msg = "Senha Incorreta!";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('login');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
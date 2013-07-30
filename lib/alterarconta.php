<?php
	$msg = "";
	
	#Include nas funcoes do usuário
	include('functions/banco-usuario.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancousuario;
	
	#Trabalha com Post
	if(isset($_POST["acao"]) && $_POST["acao"] != ''){
		$senha = strip_tags(trim(addslashes($_POST["novasenha"])));
		if($senha != '' ){
			session_start();
			$email = $_SESSION['email'];
			$banco->AlterarDados($email, $senha);
			$_SESSION['senha'] = $senha;
			$msg = "Senha alterada com sucesso.";
		}else{
			$msg = "Favor informar uma nova senha.";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('alterarconta');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
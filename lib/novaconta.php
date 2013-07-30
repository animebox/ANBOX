<?php
	$msg = "";
	
	#Include nas funcoes do usuário
	include('functions/banco-usuario.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancousuario;
	
	#Trabalha com Post
	if(isset($_POST["acao"]) && $_POST["acao"] != ''){
		$email = strip_tags(trim(addslashes($_POST["email"])));
		$senha1 = strip_tags(trim(addslashes($_POST["senha1"])));
		$senha2 = strip_tags(trim(addslashes($_POST["senha2"])));
		
		if($email != "" && $senha1 != "" && $senha2 != ""){
			#Verifica se já existe o email cadastrado
			$existe = $banco->UsuarioJaExiste($email);
			
			if($existe){
				$msg = "Email ja cadastrado";
			}else{
				if($senha1 === $senha2){
					$banco->Cadastro($email, $senha1);
					$msg = "Cadastro efetuado com sucesso!";
				}else{
					$msg = "Senhas não conferem.";
				}
			}
		}else{
			$msg = "Favor preencher todos os campos!";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('novaconta');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
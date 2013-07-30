<?php
	$msg = "";
	
	#Include nas funcoes do genero
	include('functions/banco-genero.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancogenero;
	
	#Trabalha com Post
	if(isset($_POST["acao"]) && $_POST["acao"] != ''){
		$nome = strip_tags(trim(addslashes($_POST["nomegenero"])));
		$idade = strip_tags(trim(addslashes($_POST["idade"])));
		if($nome != "" && $idade != ""){
			#Verifica se já existe o genero cadastrado
			$existe = $banco->GeneroJaExiste($nome);
			if($existe){
				$msg = "Genero ja cadastrado";
			}else{
				$banco->Cadastro($nome, $idade);
				$msg = "Genero cadastrado com sucesso!";
			}
		}else{
			$msg = "Favor preencher todos os campos!";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('novogenero');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
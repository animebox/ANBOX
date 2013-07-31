<?php
	$msg = "";
	
	#Include nas funcoes da noticia
	include('functions/banco-noticia.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new banconoticia;
	
	#Trabalha com Post
	if(isset($_POST["titulo"])){
		$titulo = strip_tags(trim(addslashes($_POST["titulo"])));
		$texto = strip_tags(trim(addslashes($_POST["texto"])));
		$embed = strip_tags(trim(addslashes($_POST["embed"])));
		if($titulo != ""){
			$banco->Cadastro($titulo, $texto, $embed);
			$msg = "Noticia publicada com sucesso!";
		}else{
			$msg = "Favor preencher todos os campos!";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('novanoticia');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
<?php
	$msg = "";
	
	#Include nas funcoes da noticia
	include('functions/banco-noticia.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new banconoticia;
	$result = $banco->ListaAnimeNoticia();
	$listanime = '<select name="titulo" class="formTitulo">';

	while($linha = mysql_fetch_array($result, MYSQL_ASSOC)){
		$listanime .= '<option value="'.$linha['ANIMENOME'].'">'.$linha['ANIMENOME'].'</option>';

	}
	$listanime .= '</select><br/><br/>';
	
	#Trabalha com Post
	if(isset($_POST["titulo"])){
		$titulo = strip_tags(trim(addslashes($_POST["titulo"])));
		$episodio = strip_tags(trim(addslashes($_POST["episodio"])));
		$embed = strip_tags(trim(addslashes($_POST["embed"])));
		if($titulo != ""){
			$banco->Cadastro($titulo, $episodio, $embed);
			$msg = "Noticia publicada com sucesso!";
		}else{
			$msg = "Favor preencher todos os campos!";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('novanoticia');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);
	$Conteudo = str_replace('<%ANIME%>', $listanime, $Conteudo);

?>
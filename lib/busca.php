<?php
	#Include nas funcoes do cliente
	include('functions/banco-anime.php');
	#Instancia objeto que vai tratar o banco de dados dessa pagina
	$banco = new bancoanime;
	$pesquisa = $_POST['pesquisa'];
	if(isset($pesquisa)){
		$result = $banco->ExisteAnime($pesquisa);
		$pesquisa = mysql_fetch_assoc($result);
		$urlLimpo = $banco->ConverterAscii($pesquisa['ANIMENOME']);
		$Conteudo = $banco->RedirecionaPara('anime/'.$urlLimpo);
	}
?>
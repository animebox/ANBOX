<?php

	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancoanime;
	
	#Carrega o html dos Itens
	$itens = $banco->CarregaHtml('itens/lista-anime-itens');
	
	#Chama funcao Lista Animes passando o HTML dos itens
	$animes = $banco->ListaAnime($itens);
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('lista-anime');
	$Conteudo = str_replace('<%ANIMES%>', $animes, $Conteudo);

?>
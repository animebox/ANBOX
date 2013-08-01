<?php

	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	include_once('analyticstracking.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancoanime;

	$anime = 1;

	if($this->PaginaAux[0]){
		$anime = $this->PaginaAux[0];
	}
	
	$anime = urldecode($anime);
	
	$result = $banco->BuscaAnime($anime);
	
	$msg .= '<div>';
	while($linha = mysql_fetch_array($result, MYSQL_ASSOC)){
		if($linha['ANIMEEPISODIOS'] == ''){
			$totalepisodios = 'Não Especificado';	
		} else {
			$totalepisodios = $linha['ANIMEEPISODIOS'];
		}
		$msg .= '<h3>'.utf8_decode($linha['ANIMENOME']).'</h3>';
		$msg .= '<div style="position: relative; float:left; width: 330px;"><img src="'.$linha['ANIMEIMAGE'].'" class="imagemAnime"></div>';
		$msg .= '<h4><div style="position: relative; float:right; width: 870px"> Sinopse: <br><br>'.utf8_decode($linha['ANIMEDESCRICAO']).'<br><br> Total de Episodios: '.utf8_decode($totalepisodios).'</div></h4>';
		$msg .= '<div style="clear:both;" id="listaepisodio" class="listaepisodio">';
		
		$msg .= '</div>';
	}
	$msg .= '</div>';
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('anime');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
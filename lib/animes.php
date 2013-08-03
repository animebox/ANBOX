<?php 
	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	include_once('analyticstracking.php');
	
	$Banco = new bancoanime;
	
	foreach (range('A', 'Z') as $Letra) {
		$Resultado = $Banco->ListaAnime($Letra);
		if(mysql_num_rows($Resultado) > 0){
			$msg .= '<div Id="'.$Letra.'" class="DivMeioPequeno">';
				$msg .= '<h4 align="left"><li>Animes com '.$Letra.'</li></h4>';
				while($Lista = mysql_fetch_array($Resultado, MYSQL_ASSOC)){
					$animeURL = $Banco->ConverterAscii($Lista["ANIMENOME"]);
					$msg .= '<div class="AnimeRotulo">';
					$msg .= '<a href="<%URLPADRAO%>anime/'.$animeURL.'" class="LinkClaro">'.$Lista["ANIMENOME"].'</a>';
					$msg .= '</div>';
				}
			$msg .= '</div>';
		}
	}
	
	/* ADICIONAR TITULO A PAGINA */
	$msg .= '<input type="hidden" id="titulopagina" value="Assistir Episodios de Animes Online">'; # <--------------- Digia no VALUE o titulo da pagina!!!!
	$msg .= '<script type="text/javascript">';
	$msg .= 'TrocaTitulo();';
	$msg .= '</script>';
	
	$Conteudo = $Banco->CarregaHtml('animes');
	$Conteudo = str_replace('<%MSG%>', utf8_decode($msg), $Conteudo);

?>
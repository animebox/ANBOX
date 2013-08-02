<?php

	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	include_once('analyticstracking.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancoanime;

	if($this->PaginaAux[0]){
		$anime = $this->PaginaAux[0];
		$episodio = $this->PaginaAux[1];
	}
	
	$anime = urldecode($anime);
	$result = $banco->BuscaEpisodio($anime,$episodio);
	if(mysql_num_rows($result) == 0) {
		
		$msg = '<h2 align="center">Episódio indisponivel no momento!</h2>';
		$msg .= '<h3 align="center" style="margin-bottom:400px;"><a href="<%URLPADRAO%>" class="LinkEscuro">Voltar</a></h3>';
		
	} else {
	
		$linha = mysql_fetch_assoc($result);
		
		/* Episodio Atual */
		$msg .= '<div class="EpisodioAtual">';
		$msg .= '<h2><a href="<%URLPADRAO%>anime/'.$linha["NOTICIATITULO"].'" class="LinkEscuro">'.$linha["NOTICIATITULO"].'</a> | Episodio '.$linha['NOTICIAEPISODIO'].'</h2>'; #Titulo
		$msg .= '<object width="640" height="360" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object>';
		$msg .= '</div>';
		
		$episodios = $banco->ListaEpisodio($anime);
		$msg .= '<div class="EpisodioOutro">';
		while($linhaepisodio = mysql_fetch_array($episodios, MYSQL_ASSOC)){
			$msg .= '<div class="EpisodioLista">';
			$msg .= ' <a href="<%URLPADRAO%>episodio/'.$linhaepisodio["NOTICIATITULO"].'/'.$linhaepisodio["NOTICIAEPISODIO"].'" class="LinkEscuro">Episódio '.$linhaepisodio["NOTICIAEPISODIO"].'</a>';
			$msg .= '</div>';
		}
		$msg .= '</div>';
		
		$msg .= '<div style="clear: both; padding-bottom: 100px;"> </div>';
	}
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('anime');
	$Conteudo = str_replace('<%MSG%>', utf8_decode($msg), $Conteudo);

?>
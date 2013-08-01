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
		
		$msg = utf8_decode('<div class="principal"><h2>Episodio indisponivel até o momento!</h2></div>');
		
	} else {
	
		$linha = mysql_fetch_assoc($result);
		
		$msg .= '<div class="principal">';
		$msg .= '<h2><a href="<%URLPADRAO%>anime/'.$linha["NOTICIATITULO"].'">'.$linha["NOTICIATITULO"].'</a></h2>'; #Titulo
		$msg .= '<h3>Episodio '.$linha['NOTICIAEPISODIO'].'</h3>';
		$msg .= '<div>';
		$msg .= '<object width="1024" height="640" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object>';
		$msg .= '</div>';
		$msg .= '</div>';
		
	}
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('anime');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
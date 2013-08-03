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
	$anime = preg_replace('/-/',' ',$anime);
	$anime = urldecode($anime);
	$result = $banco->BuscaEpisodio($anime,$episodio);
	if(mysql_num_rows($result) == 0) {
		
		$msg = '<h2 align="center">Episódio indisponivel no momento!</h2>';
		$msg .= '<h3 align="center" style="margin-bottom:400px;"><a href="<%URLPADRAO%>" class="LinkEscuro">Voltar</a></h3>';
		
	} else {
	
		$linha = mysql_fetch_assoc($result);
		$animeURL = $banco->ConverterAscii($linha["NOTICIATITULO"]);
	
		/* Episodio Atual */
		$msg .= '<div class="ConteudoPrincipal">';
		$msg .= '<div class="EpisodioAtual">';
		$msg .= '<h2><a href="<%URLPADRAO%>anime/'.$animeURL.'" class="LinkClaro">'.$linha['NOTICIATITULO'].'</a> | Episodio '.$linha['NOTICIAEPISODIO'].'</h2>'; #Titulo
		$msg .= '<object width="640" height="360" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object>';
		$msg .= '</div>';
		
		$episodios = $banco->ListaEpisodio($anime);
		$msg .= '<div class="EpisodioOutro">';
		while($linhaepisodio = mysql_fetch_array($episodios, MYSQL_ASSOC)){
			$msg .= '<div class="EpisodioLista">';
			$msg .= ' <a href="<%URLPADRAO%>episodio/'.$animeURL.'/'.$linhaepisodio["NOTICIAEPISODIO"].'" class="LinkClaro">Episódio '.$linhaepisodio["NOTICIAEPISODIO"].'</a>';
			$msg .= '</div>';
		}
		$msg .= '</div>';
		$msg .= '<div class="EpisodioOutro">';		
		$msg .= 'Publicidade</br><script type="text/javascript"><!--
google_ad_client = "ca-pub-5738422846014271";
/* Retangulo336x280 */
google_ad_slot = "3737532687";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>';
		$msg .= '</div>';
		$msg .= '</div>';
		$msg .= '<div style="clear: both; padding-bottom: 100px;"> </div>';
		
	/* ADICIONAR TITULO A PAGINA */
	$msg .= '<input type="hidden" id="titulopagina" value="Assistir Online '.$linha["NOTICIATITULO"].' | Episodio '.$linha['NOTICIAEPISODIO'].'">'; # <--------------- Digia no VALUE o titulo da pagina!!!!
	$msg .= '<script type="text/javascript">';
	$msg .= 'TrocaTitulo();';
	$msg .= '</script>';
	}
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('anime');
	$Conteudo = str_replace('<%MSG%>', utf8_decode($msg), $Conteudo);

?>
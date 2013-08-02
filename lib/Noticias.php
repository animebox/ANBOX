<?php

	#Include nas funcoes do anime
	include('functions/banco-noticia.php');
	include_once('analyticstracking.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new banconoticia;

	$pagina = 1;

	if($this->PaginaAux[0]){
		$pagina = $this->PaginaAux[0];
		$anime = $this->PaginaAux[1];
	}
	
	$paginas = $banco->CriaPaginacao();
	
	if($anime == '') {
		$result = $banco->BuscaListaNoticia($pagina);
	} else {
		$result = $banco->BuscaListaNoticiaAnime($pagina,$anime);
	}
	
	while($linha = mysql_fetch_array($result, MYSQL_ASSOC)){				
		$msg .= '<div id="'.$linha["NOTICIAID"].'" class="VideoBox">';		
			$msg .= '<div class="VideoTitulo">';
				$msg .= '<a href="<%URLPADRAO%>anime/'.$linha["NOTICIATITULO"].'" class="LinkClaroGrande">'.$linha["NOTICIATITULO"].'</a> | <a href="<%URLPADRAO%>episodio/'.$linha["NOTICIATITULO"].'/'.$linha["NOTICIAEPISODIO"].'" class="LinkClaroPequeno">Episodio '.$linha["NOTICIAEPISODIO"].'</a>';
			$msg .=  '</div>';
			$msg .= '<div class="VideoMeio">';
				$msg .= '<object width="300" height="220" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object>';
			$msg .= '</div>';
		$msg .= '</div>';
	}

	$listapagina .= '<div id="paginas" class="Paginacao">';
	$listapagina .= 'Pagina ';
	
	for($i=1;$i<=$paginas;$i++){
		if($pagina == $i){
			$listapagina .= ' '.$i.' ';
		} else {
			if ($i == 1) {
				$listapagina .= ' <a href="<%URLPADRAO%>noticias/1" class="LinkEscuroGrande">'.$i.'</a> ';
			} else {
				$listapagina .= ' <a href="<%URLPADRAO%>noticias/'.$i.'" class="LinkEscuroGrande">'.$i.'</a> ';
			}
		}
	}
	$listapagina .= '</div>';
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('noticias');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);
	$Conteudo = str_replace('<%PAGINAS%>', $listapagina, $Conteudo);

?>
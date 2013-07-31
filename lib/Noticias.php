<?php

	#Include nas funcoes do anime
	include('functions/banco-noticia.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new banconoticia;

	$pagina = 1;

	if($this->PaginaAux[0]){
		$pagina = $this->PaginaAux[0];
	} 
	
	$paginas = $banco->CriaPaginacao();
	
	$result = $banco->BuscaListaNoticia($pagina);
	


	while($linha = mysql_fetch_array($result, MYSQL_ASSOC)){				
		$msg .= '<div id="'.$linha["NOTICIAID"].'" class="noticiaBox">';		
		$msg .= '<div class="noticiaTitulo">';
		$msg .= '<h4>'.$linha["NOTICIATITULO"].'</h4>'; #Titulo
		$msg .=  '</div>';
		$msg .= '<div class="alinhaMeio">';
		$msg .= '<object width="300" height="220" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object>';
		$msg .= '</div>';
		$msg .= '</div>';
	}

	$listapagina .= '<div id="paginas" class="clear"><br><br> Pagina ';
	
	
	for($i=1;$i<=$paginas;$i++){
		if($pagina == $i){
			$listapagina .= ' '.$i.' ';
		} else {
			if ($i == 1) {
				$listapagina .= ' <a href="http://animebox.com.br/">'.$i.'</a> ';
			} else {
				$listapagina .= ' <a href="Noticias/'.$i.'">'.$i.'</a> ';
			}
		}
	}
		
	$listapagina .= '</div>';
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('Noticias');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);
	$Conteudo = str_replace('<%PAGINAS%>', $listapagina, $Conteudo);

?>
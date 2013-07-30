<?php

	#Include nas funcoes do anime
	include('functions/banco-noticia.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new banconoticia;
	if(!isset($pagina) or $pagina == ''){
		$pagina = 1;
	} else {
		$pagina = strip_tags(trim(($_GET["Pagina"])));
	}
	$result = $banco->BuscaListaNoticia($pagina);
	$paginas = $banco->BuscaListaPaginas($paginas);
	while($linha = mysql_fetch_array($result, MYSQL_ASSOC)){				
		$msg .= '<div id="'.$linha["NOTICIAID"].'">';
		$msg .= '<h4><a href="Visualizar?Noticia='.$linha["NOTICIAID"].'">'.$linha["NOTICIATITULO"].'</a></h4>';
		$msg .= $linha["NOTICIATEXTO"];
		$msg .= '<br><br><div class="alinhaMeio"><object width="640" height="360" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object></div><br>';
		$msg .= '<hr>';
		$msg .= '</div>';
	}
	$msg .= '<br><div id="paginas">';
	for($i=1; $i<=$paginas;$i++){
		if($pagina == $i){
			$msg .= ' '.$i.' ';
		} else {
			$msg .= ' <a href="Noticias?Pagina='.$i.'">'.$i.'</a> ';
		}
	}
	$msg .= '</div>';	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('Noticias');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
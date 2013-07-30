<?php

	#Include nas funcoes do anime
	include('functions/banco-noticia.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new banconoticia;

	$noticia = strip_tags(trim(addslashes($_GET["Noticia"])));
	
	$result = $banco->BuscaNoticia($noticia);
						
	$msg .= '<div id="'.$linha["NOTICIAID"].'">';
	$msg .= '<h4>'.$linha["NOTICIATITULO"].'</h4>';
	$msg .= $linha["NOTICIATEXTO"];
	$msg .= '<br><br><div class="alinhaMeio"><object width="640" height="360" id="player_'.$linha["NOTICIAEMBED"].'"><param value="true" name="allowfullscreen"/><param value="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" name="movie"/><param value="always" name="allowscriptaccess"/><param value="window" name="wmode"/><embed id="player_'.$linha["NOTICIAEMBED"].'" width="640" height="360" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" src="http://player.mais.uol.com.br/embed_v2.swf?mediaId='.$linha["NOTICIAEMBED"].'&p=related" wmode="window" /></embed><noscript></noscript></object></div><br>';
	$msg .= '</div>';

	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('Visualizar');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
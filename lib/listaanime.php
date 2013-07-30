<?php

	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancoanime;
	
	$result = $banco->BuscaListaAnime();
		
	while($linha = mysql_fetch_array($result, MYSQL_ASSOC)){				
		 $msg .= '<li>'.$linha['ANIMENOME'].'</li>';
	}
		
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('listaanime');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);

?>
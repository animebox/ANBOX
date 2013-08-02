<?php

	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	include_once('analyticstracking.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa página
	$banco = new bancoanime;

	if($this->PaginaAux[0]){
		$anime = $this->PaginaAux[0];
	}
	
	$anime = urldecode($anime);
	$result = $banco->BuscaAnime($anime);
	if(mysql_num_rows($result) == 0) {
		$msg = '<h3 align="center" style="margin-top:100px;">Opa, parece que sua pesquisa não gerou nenhum resultado, tente novamente.</h3>';
		$msg .= '<h3 align="center" style="margin-bottom:400px;"><a href="<%URLPADRAO%>" class="LinkEscuro">Voltar</a></h3>';
	} else
	{
		$linha = mysql_fetch_assoc($result);	
		if($linha['ANIMEEPISODIOS'] == ''){
			$totalepisodios = 'Não Especificado';	
		} else {
			$totalepisodios = $linha['ANIMEEPISODIOS'];
		}
			
		$msg .= '<div>';
			$msg .= '<h3>'.$linha['ANIMENOME'].'</h3>';
			$msg .= '<div class="AnimeImage"><img src="'.$linha['ANIMEIMAGE'].'" class="Image300"></div>';
				$msg .= '<h5><div class="AnimeDescricao">'.$linha['ANIMEDESCRICAO'].'</div></h5>';
				$msg .= '<h6><div class="AnimeDescricao">Total de Episodios: '.$totalepisodios.'</div></h6>';
		$msg .= '<div class="AnimeEpisodio">';
		$msg .= '<h3>Episódios</h3>';
		$episodios = $banco->ListaEpisodio($anime);
		while($linhaepisodio = mysql_fetch_array($episodios, MYSQL_ASSOC)){
			$msg .= '<div class="AnimeEpisodioQuadro">';
			$msg .= ' <a href="<%URLPADRAO%>episodio/'.$linhaepisodio["NOTICIATITULO"].'/'.$linhaepisodio["NOTICIAEPISODIO"].'" class="LinkEscuro">'.$linhaepisodio["NOTICIAEPISODIO"].'</a>  | ';
			$msg .= '</div>';
		}
		$msg .= '</div>';
		$msg .= '</div>';
		
		$msg .= '<div style="clear: both;"> </div>';
	}
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('anime');
	$Conteudo = str_replace('<%MSG%>', utf8_decode($msg), $Conteudo);

?>
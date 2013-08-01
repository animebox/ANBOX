<?php
	class banconoticia extends banco{
		
		#Funчуo que cadastra a noticia
		function Cadastro($titulo, $episodio, $embed){
			$sql = "INSERT INTO NOTICIA (NOTICIATITULO, NOTICIAEMBED, NOTICIAEPISODIO) VALUES ('".$titulo."', '".$embed."','".$episodio."')";
			parent::Execute($sql);
		}
		
		function BuscaListaNoticia($pagina){
			$limite = 12;
			$inicio = ($pagina * $limite) - $limite;
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIAEMBED,NOTICIAEPISODIO FROM NOTICIA ORDER BY NOTICIAID DESC LIMIT ".$inicio.",".$limite."";
			$result = parent::Execute($sql);
			return $result;
		}
		
		function BuscaNoticia($noticia){
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIAEMBED,NOTICIAEPISODIO FROM NOTICIA WHERE NOTICIAID = ".$noticia;
			$result = parent::Execute($sql);
			return $result;
		}
		
		function CriaPaginacao(){
			$sql = "SELECT NOTICIAID FROM NOTICIA";	
			$result = parent::Execute($sql);
			$totalPaginas = mysql_num_rows($result);
			$result = ceil($totalPaginas / 12);
			return $result;
		}
		function ListaAnimeNoticia() {
			$sql = "SELECT ANIMENOME FROM ANIME";
			$result = parent::Execute($sql);
			return $result;
		}
	}
?>
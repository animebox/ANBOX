<?php
	class banconoticia extends banco{
		
		#Fun��o que cadastra a noticia
		function Cadastro($titulo, $texto, $embed){
			$sql = "INSERT INTO NOTICIA (NOTICIATITULO, NOTICIAEMBED ,NOTICIATEXTO) VALUES ('".$titulo."', '".$embed."', '".$texto."')";
			parent::Execute($sql);
		}
		
		function BuscaListaNoticia($pagina){
			$limite = 10;
			$inicio = ($pagina * $limite) - $limite;
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIATEXTO, NOTICIAEMBED FROM NOTICIA LIMIT ".$inicio.",".$limite." ORDER BY NOTICIAID DESC";
			$result = parent::Execute($sql);
			return $result;
		}
		
		function BuscaNoticia($noticia){
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIATEXTO, NOTICIAEMBED FROM NOTICIA WHERE NOTICIAID = ".$noticia;
			$result = parent::Execute($sql);
			return $result;
		}
		
		function BuscaListaPaginas($paginas){
			$sql = "SELECT NOTICIAID FROM NOTICIA";	
			$result = parent::Execute($sql);
			$totalPaginas = mysql_num_rows($result);
			$result = ceil($totalPaginas / 10);
			return $result;
		}
	}
?>
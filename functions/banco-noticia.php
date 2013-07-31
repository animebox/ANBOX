<?php
	class banconoticia extends banco{
		
		#Funчуo que cadastra a noticia
		function Cadastro($titulo, $texto, $embed){
			$sql = "INSERT INTO NOTICIA (NOTICIATITULO, NOTICIAEMBED) VALUES ('".$titulo."', '".$embed."')";
			parent::Execute($sql);
		}
		
		function BuscaListaNoticia($pagina){
			$limite = 9;
			$inicio = ($pagina * $limite) - $limite;
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIAEMBED FROM NOTICIA ORDER BY NOTICIAID DESC LIMIT ".$inicio.",".$limite."";
			$result = parent::Execute($sql);
			return $result;
		}
		
		function BuscaNoticia($noticia){
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIAEMBED FROM NOTICIA WHERE NOTICIAID = ".$noticia;
			$result = parent::Execute($sql);
			return $result;
		}
		
		function BuscaListaPaginas($paginas){
			$sql = "SELECT NOTICIAID FROM NOTICIA";	
			$result = parent::Execute($sql);
			$totalPaginas = mysql_num_rows($result);
			$result = ceil($totalPaginas / 9);
			return $result;
		}
	}
?>
<?php
	class banconoticia extends banco{
		
		#Funчуo que cadastra a noticia
		function Cadastro($titulo, $texto, $embed){
			$sql = "INSERT INTO NOTICIA (NOTICIATITULO, NOTICIAEMBED ,NOTICIATEXTO) VALUES ('".$titulo."', '".$embed."', '".$texto."')";
			parent::Execute($sql);
		}
		
		function BuscaListaNoticia($pagina){
			$limite = 2;
			$inicio = ($pagina * $limite) - $limite;
			$sql = "SELECT NOTICIAID,NOTICIATITULO,NOTICIATEXTO, NOTICIAEMBED FROM NOTICIA LIMIT ".$inicio.",".$limite."";
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
			$result = ceil($totalPaginas / 1);
			return $result;
		}
	}
?>
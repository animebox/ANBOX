<?php
	#Aqui monta as paginas e imprime na tela
	
	include('functions/banco.php');
	include('tags.php');
	
	class controle{
		public function __construct(){
		
			$banco = new banco;
			$banco->Conecta();
			$banco->CarregaPaginas();
			
			if($banco->Pagina){
				if($banco->Pagina == "novaconta"){
					$Conteudo = $banco->ChamaPhp("novaconta");
				}else{
					$Conteudo = $banco->ChamaPhp($banco->Pagina);
				}
			}else{
				$Conteudo = $banco->ChamaPhp('noticias');
				$busca = $banco->ChamaPhp('busca');						
			}
				
			$SaidaHtml = $banco->CarregaHtml('modelo');
			$SaidaHtml = str_replace('<%CONTEUDO%>',$Conteudo,$SaidaHtml);
			$SaidaHtml = str_replace('<%URLPADRAO%>',UrlPadrao,$SaidaHtml);
			$SaidaHtml = str_replace('<%BUSCA%>',$busca,$SaidaHtml);
			#Imprime tela
			echo $SaidaHtml;
			
		}
	}
?>
<?php
class busca_blog extends controller {
	
	public function init(){
		
	}
	
	public function inicial(){		
		
		$busca = $this->post('busca');
		
		if(!$busca){
			$this->msg('Preencha o campo busca para exibir os resultados!');
			$this->volta(1);
		}
		
		$this->irpara(DOMINIO.'blog/lista/busca/'.$busca);
	}
	
}
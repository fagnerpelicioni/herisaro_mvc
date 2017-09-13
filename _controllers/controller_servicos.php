<?php
class servicos extends controller {
	
	public function init(){
		
	}
	
	public function inicial(){
		
		//definições basicas (OBS: tudo que estiver na array dados é enviado como variavel para a view)
		$layout = new model_meta();
		$dados['_base'] = $layout->carrega();
		$dados['objeto'] = DOMINIO.$this->_controller.'/';
		$dados['controller'] = $this->_controller;
		
		//imagens
		$imagem = new model_imagem();
		$dados['logo'] = $imagem->codigo('147796771992551');
		
		//textos
		$texto = new model_texto();
		$dados['texto_rodape'] = $texto->conteudo('147923481328435');
		$dados['texto_servicos'] = $texto->conteudo('147569615862020'); 

		//rede social
		$redessociais = new model_redes_sociais();
		$dados['facebook'] = $redessociais->codigo('147193121148864');
				
	 	
		//carrega view e envia dados para a tela
		$this->view('servicos', $dados);
	}
	
}
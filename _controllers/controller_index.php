<?php
class index extends controller {
	
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
		$dados['imagem_inicial'] = $imagem->codigo('147925381982600');

		//textos
		$texto = new model_texto();
		$dados['texto_rodape'] = $texto->conteudo('147923481328435');
		
		//rede social
		$redessociais = new model_redes_sociais();
		$dados['facebook'] = $redessociais->codigo('147193121148864');
		
		//banner
		$banners = new model_banners();
		$dados['banners'] = $banners->lista('147502866622777');	
		
		//clientes
		$clientes = new model_clientes();
		$dados['clientes'] = $clientes->lista();	
		
		//carrega modulo de noticias/bog
		$blog = new model_postagens();
		$blog->perpage = 3;
		$blog->destaque = '148020598214630';
		
	 	//retorno do blog pra variavel
		$blogarray = $blog->lista();
	 	$dados['noticias'] = $blogarray['noticias'];
	 	
		//carrega view e envia dados para a tela
		$this->view('index', $dados);
	}
	
}
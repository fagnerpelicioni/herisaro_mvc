<?php
class ondeestamos extends controller {
	
	public function init(){
		
	}
	
	public function inicial(){
		
		//definições basicas (OBS: tudo que estiver na array dados é enviado como variavel para a view)
		$layout = new model_layout();
		$dados['_base'] = $layout->carrega();
		$dados['objeto'] = DOMINIO.$this->_controller.'/';
		$dados['controller'] = $this->_controller;	
		
		//rede social
		$redessociais = new model_redes_sociais();
		$dados['facebook'] = $redessociais->codigo('147193121148864');


		$texto = new model_texto();
		$dados['texto1'] = $texto->conteudo('147561699566423');
		$dados['texto2'] = $texto->conteudo('147561701519173');
		$dados['texto3'] = $texto->conteudo('147561702981952');


		$imagem = new model_imagem();
		$dados['imagem1'] = $imagem->codigo('147561713414301');
		$dados['imagem2'] = $imagem->codigo('147561715488044');
		$dados['imagem3'] = $imagem->codigo('147561717335872');
		
		
		//para topo
		$dados['categoria_codigo'] = 0;


		//carrega modulo de noticias/bog
		$blog = new model_postagens();
		$blog->perpage = 10;
		//define variaveis
		
		//gets caso for preenchido define a configuraçao
		$blog->categoria = '147552028813155';
		
	 	//retorno do blog pra variavel
		$blogarray = $blog->lista();
	 	$dados['estrutura'] = $blogarray['noticias'];
		

		//carrega view e envia dados para a tela
		$this->view('ondeestamos', $dados);
	}
	
}
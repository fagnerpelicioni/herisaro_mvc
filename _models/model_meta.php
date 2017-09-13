<?php

Class model_meta extends model{
    
    public function carrega(){
    	
    	$dados = array();
		
		//detecta navegador 
		$navegador = new model_navegador();
		$dados['navegador'] = $navegador->nome();
		
		//informações basicas de metan
    	$db = new mysql();
		$config = $db->executar("select * from meta where id='1' ")->fetch_object();
		$dados['titulo_pagina'] = $config->titulo_pagina;
		$dados['descricao'] = $config->descricao;
		
		//favicon
		$imagem = new model_imagem();
		$dados['favicon'] = $imagem->codigo('147193111415927');

		$cores = new model_cores();
		$dados['cor']  = $cores->lista();

		//retorna para a pagina a array com todos as informações
		return $dados;
	}

}
<?php

class textos extends controller {
	
	protected $_modulo_nome = "Textos";

	public function init(){
		$this->autenticacao();
		$this->nivel_acesso(29);
	}
	
	
	public function inicial(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
		$dados['_subtitulo'] = "";

		if($this->nivel_acesso(33, false)){
			$dados['permissao'] = true;
		} else {
			$dados['permissao'] = false;
		}

		$lista = array();

		$conexao = new mysql();
		$coisas = $conexao->executar("SELECT * FROM texto ORDER BY titulo asc");
		$n = 0;
		while($data = $coisas->fetch_object()){

			$lista[$n]['id'] = $data->id;
			$lista[$n]['codigo'] = $data->codigo;
			$lista[$n]['titulo'] = $data->titulo;

		$n++;
		}
		$dados['lista'] = $lista;

		
		$this->view('textos', $dados);
	}
	

	public function novo(){

		$this->nivel_acesso(33);
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Novo";

 		$dados['aba_selecionada'] = "dados";

		$this->view('textos.nova', $dados);
	}


	public function nova_grv(){
		
		$this->nivel_acesso(33);

		$titulo = $this->post('titulo');
		$conteudo = $_POST['conteudo'];

		$this->valida($titulo);

		$codigo = $this->gera_codigo();

		$db = new mysql();
		$db->inserir("texto", array(
			"codigo"=>"$codigo",
			"titulo"=>"$titulo",
			"conteudo"=>"$conteudo"
		));
	 	
		$this->irpara(DOMINIO.$this->_controller.'/alterar/codigo/'.$codigo);
	}
	

	public function alterar(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Alterar";
 		
 		$codigo = $this->get('codigo');
 		
 		$dados['aba_selecionada'] = "dados";
 		
 		if($this->nivel_acesso(40, false)){
 			$dados['acesso_alterar_titulo'] = true;
 		} else {
 			$dados['acesso_alterar_titulo'] = false;
 		}

 		$db = new mysql();
 		$exec = $db->Executar("SELECT * FROM texto where codigo='$codigo' ");
		$dados['data'] = $exec->fetch_object();
 		
		$this->view('textos.alterar', $dados);
	}


	public function alterar_grv(){
		
		$codigo = $this->post('codigo');

		$titulo = $this->post('titulo');
		$conteudo = $_POST['conteudo'];

		if($this->nivel_acesso(40, false)){

			$this->valida($titulo);
			
			$db = new mysql();
			$db->alterar("texto", array(
				"titulo"=>"$titulo",
				"conteudo"=>"$conteudo"
			), " codigo='$codigo' ");

		} else {

			$db = new mysql();
			$db->alterar("texto", array(
				"conteudo"=>"$conteudo"
			), " codigo='$codigo' ");

		}
	 	

		$this->irpara(DOMINIO.$this->_controller.'/alterar/codigo/'.$codigo);		
	}


	public function apagar_varios(){
		
		$this->nivel_acesso(33);
		
		$db = new mysql();
		$exec = $db->Executar("SELECT * FROM texto ");
		while($data = $exec->fetch_object()){
			
			if($this->post('apagar_'.$data->id) == 1){				
				 
				$conexao = new mysql();
				$conexao->apagar("texto", " id='$data->id' ");
			
			}
		}

		$this->irpara(DOMINIO.$this->_controller);
		
	}


}
<?php

class layout extends controller {
	
	protected $_modulo_nome = "Layout";

	public function init(){
		$this->autenticacao();
		$this->nivel_acesso(43);
	}


	public function inicial(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "";

 		$dados['data'] = $this->_dados_usuario; 
 
		if($this->get('aba')){
			$dados['aba_selecionada'] = $this->get('aba');
		} else {
			$dados['aba_selecionada'] = 'cores';
		}

		$objeto_end = DOMINIO.$this->_controller.'/'; 
	 	
		//cores
		$cores = array();

		$conexao = new mysql();
		$exec = $conexao->Executar("SELECT * FROM layout_cor order by id asc");
		$n = 0;
		while($data = $exec->fetch_object()){

			$cores[$n]['id'] = $data->id;
			$cores[$n]['titulo'] = $data->titulo;
			$cores[$n]['cor'] = $data->cor;

		$n++;
		}
		$dados['listacores'] = $cores;
		
		$this->view('layout', $dados);
	}


	public function cores_grv(){
		
		$db = new mysql();
		$exec = $db->Executar("SELECT * FROM layout_cor ");
		while($data = $exec->fetch_object()){

			$titulo = $this->post('cor_titulo_'.$data->id);
			$cor = $_POST['cor_'.$data->id];
 			
			$conexao = new mysql();
			$conexao->alterar("layout_cor", array(
				"cor"=>"$cor"
			), " id='$data->id' ");

		}

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/cores');
	}


	public function adm(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "";

 		$dados['data'] = $this->_dados_usuario;  

		if($this->get('aba')){
			$dados['aba_selecionada'] = $this->get('aba');
		} else {
			$dados['aba_selecionada'] = 'cores';
		}

		$objeto_end = DOMINIO.$this->_controller.'/'; 
	 	
		//cores
		$cores = array();

		$conexao = new mysql();
		$exec = $conexao->Executar("SELECT * FROM layout_cor order by id asc");
		$n = 0;
		while($data = $exec->fetch_object()){

			$cores[$n]['id'] = $data->id;
			$cores[$n]['titulo'] = $data->titulo;
			$cores[$n]['cor'] = $data->cor;

		$n++;
		}
		$dados['listacores'] = $cores;
		
		$this->view('layout.adm', $dados);
	} 
 
	
	public function adm_grv(){
	 
		
		$db = new mysql();
		$exec = $db->Executar("SELECT * FROM layout_cor ");
		while($data = $exec->fetch_object()){

			$titulo = $this->post('cor_titulo_'.$data->id);
			$cor = $_POST['cor_'.$data->id];
			 
			$conexao = new mysql();
			$conexao->alterar("layout_cor", array(
				"titulo"=>"$titulo",
				"cor"=>"$cor"
			), " id='$data->id' ");
			
		}

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/cores');
	}


	public function nova_cor(){

		$db = new mysql();
		$db->inserir("layout_cor", array(
			"titulo"=>"",
			"cor"=>""
		));

		$this->irpara(DOMINIO.$this->_controller.'/adm/aba/cores');
	}


	public function apagar_cor(){
		
		$id = $this->get('id');			
		$this->valida($id);

		$db = new mysql();
		$db->apagar("layout_cor", " id='$id' ");

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/cores');
	}


}
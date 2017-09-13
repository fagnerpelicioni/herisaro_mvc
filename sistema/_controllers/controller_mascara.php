<?php

class mascara extends controller {
	
	protected $_modulo_nome = "Marca d'água";

	public function init(){
		$this->autenticacao();
		$this->nivel_acesso(30);
	}

	public function inicial(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
		$dados['_subtitulo'] = "";		 

		$lista = array();

		$db = new mysql();
		$exec = $db->executar("SELECT * FROM marcadagua order by titulo asc");
		$i = 0;
		$grupo_titulo = "";
		while($data = $exec->fetch_object()) {
			
			$lista[$i]['id'] = $data->id;
			$lista[$i]['codigo'] = $data->codigo;
			$lista[$i]['titulo'] = $data->titulo;

			if($data->posicao == 1){
				$lista[$i]['posicao'] = "Centro";
			}
			if($data->posicao == 2){
				$lista[$i]['posicao'] = "Canto esquerdo superior";
			}
			if($data->posicao == 3){
				$lista[$i]['posicao'] = "Canto direito superior";
			}
			if($data->posicao == 4){
				$lista[$i]['posicao'] = "Canto esquerdo inferior";
			}
			if($data->posicao == 5){
				$lista[$i]['posicao'] = "Canto direito inferior";
			}

			if($data->preencher == 0){
				$lista[$i]['preencher'] = "Não";
			} else {
				$lista[$i]['preencher'] = "Sim";
			}

			$lista[$i]['imagem'] = PASTA_CLIENTE.'img_mascaras/'.$data->imagem;

		$i++;
		}
		$dados['lista'] = $lista;
		
		$this->view('mascara', $dados);
	}
	
	public function novo(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Nova";


		$this->view('mascara.nova', $dados);
	}

	public function novo_grv(){

		$titulo = $this->post('titulo');
		$posicao = $this->post('posicao');
		$preencher = $this->post('preencher');
		
		$arquivo_original = $_FILES['arquivo'];
		$tmp_name = $_FILES['arquivo']['tmp_name'];
		
		$this->valida($titulo);

		//carrega model de gestao de imagens
		$arquivo = new model_arquivos_imagens();

		//// Definicao de Diretorios / 
		$diretorio = "arquivos/img_mascaras/";		 
		
		if(!$arquivo->filtro($arquivo_original)){ $this->msg('Arquivo com formato inválido ou inexistente!'); $this->volta(1); } else {
			
			$nome_original = $_FILES['arquivo']['name'];
			$nome_arquivo  = $arquivo->trata_nome($nome_original);
			
			$destino = $diretorio.$nome_arquivo;
			
			if(copy($tmp_name, $destino)){

				$codigo = $this->gera_codigo();

				$db = new mysql();
				$db->inserir("marcadagua", array(
					"codigo"=>"$codigo",
					"titulo"=>"$titulo",
					"imagem"=>"$nome_arquivo",
					"posicao"=>"$posicao",
					"preencher"=>"$preencher"
				));
			 	
				$this->irpara(DOMINIO.$this->_controller);

			} else {
				$this->msg('Não foi possível copiar o arquivo!');
				$this->volta(1);
			}

		}		
	}	

	public function alterar(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Alterar";

 		$codigo = $this->get('codigo');

 		$db = new mysql();
		$exec = $db->executar("SELECT * FROM marcadagua WHERE codigo='$codigo' ");
		$dados['data'] = $exec->fetch_object();

		if(!isset($dados['data']) ) {
			$this->irpara(DOMINIO.$this->_controller);
		}

		$this->view('mascara.alterar', $dados);

	}

	public function alterar_grv(){
		
		$codigo = $this->post('codigo');

		$titulo = $this->post('titulo');
		$posicao = $this->post('posicao');
		$preencher = $this->post('preencher');
		
		$this->valida($codigo);
		$this->valida($titulo);
		
		$db = new mysql();
		$db->alterar("marcadagua", array(
			"titulo"=>"$titulo",
			"posicao"=>"$posicao",
			"preencher"=>"$preencher"
		), " codigo='$codigo' ");
	 	
		$this->irpara(DOMINIO.$this->_controller);		
	}

	public function apagar_varios(){
		
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM marcadagua ");
		while($data = $exec->fetch_object()){
			
			if($this->post('apagar_'.$data->id) == 1){
				
				unlink('arquivos/img_mascaras/'.$data->imagem);
				
				$conexao = new mysql();
				$conexao->apagar("marcadagua", " id='$data->id' ");
					
			}
		}

		$this->irpara(DOMINIO.$this->_controller);		
	}


}
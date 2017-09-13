<?php

class banners extends controller {
	
	protected $_modulo_nome = "Banners";

	public function init(){
		$this->autenticacao();
		$this->nivel_acesso(44);
	}


	public function inicial(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
		$dados['_subtitulo'] = "";
		
		if($this->nivel_acesso(55, false)){
			$dados['acesso_grupos'] = true;
		} else {
			$dados['acesso_grupos'] = false;
		}
		
		$grupo = $this->get('grupo');
		
		$categorias = array();

		$db = new mysql();
		$exec = $db->executar("SELECT * FROM banner_grupo order by titulo asc");
		$i = 0;
		$grupo_titulo = "";
		while($data = $exec->fetch_object()) {
			
			$categorias[$i]['id'] = $data->id;
			$categorias[$i]['codigo'] = $data->codigo;
			$categorias[$i]['titulo'] = $data->titulo;

			if($grupo == $data->codigo){
				$categorias[$i]['selected'] = "selected";
				$grupo_titulo = $data->titulo;
			} else {
				$categorias[$i]['selected'] = "";
			}
			
			if( ($i == 0) AND (!$grupo) ){
				$grupo = $data->codigo;
				$categorias[$i]['selected'] = "selected";
				$grupo_titulo = $data->titulo;
			}

		$i++;
		}
		$dados['categorias'] = $categorias;
		$dados['grupo'] = $grupo;


		$lista = array();

		$conexao = new mysql();
		$exec = $conexao->Executar("SELECT * FROM banner_ordem WHERE codigo='$grupo' ORDER BY id desc limit 1");
		$data_ordem = $exec->fetch_object();

		if(isset($data_ordem->data)){

			$order = explode(',', $data_ordem->data);

			$n = 0;
			foreach($order as $key => $value){

				$conexao = new mysql();
				$coisas = $conexao->Executar("SELECT * FROM banner WHERE id='$value' ");
				$data = $coisas->fetch_object();

				if(isset($data->titulo)){

					$lista[$n]['id'] = $data->id;
					$lista[$n]['codigo'] = $data->codigo;
					$lista[$n]['titulo'] = $data->titulo;
					
					$lista[$n]['categoria'] = $grupo_titulo;

				$n++;
				}
			}
		}
		$dados['lista'] = $lista;
		
		
		$this->view('banners', $dados);
	}
	

	public function novo(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Novo";

 		$dados['aba_selecionada'] = "dados";
 	 	
 		$grupo = $this->get('grupo');
 		$dados['grupo'] = $grupo;
 		
 		$lista = array();

 		$db = new mysql();
 		$exec = $db->Executar("SELECT * FROM banner_grupo order by titulo asc");
 		$n = 0;
 		while($data = $exec->fetch_object()){

 			$lista[$n]['codigo'] = $data->codigo;
 			$lista[$n]['titulo'] = $data->titulo;

 			if($grupo == $data->codigo){
 				$lista[$n]['selected'] = 'selected';
 			} else {
 				$lista[$n]['selected'] = '';
 			}

 		$n++;
 		}
 		$dados['categorias'] = $lista;

 		$lista = array(); 		 

		$this->view('banners.novo', $dados);
	}


	public function nova_grv(){
		
		$titulo = $this->post('titulo');
		$categoria = $this->post('grupo');
		$endereco = $_POST['endereco'];

		$this->valida($titulo);
		$this->valida($categoria);

		$codigo = $this->gera_codigo();

		$db = new mysql();
		$db->inserir("banner", array(
			"codigo"=>"$codigo",
			"titulo"=>"$titulo",
			"grupo"=>"$categoria",
			"endereco"=>"$endereco"
		));

	 	$ultid = $db->ultimo_id();

		$conexao = new mysql();
		$coisas = $conexao->Executar("SELECT * FROM banner_ordem where codigo='$categoria' order by id desc limit 1");
		$data = $coisas->fetch_object();

		if(isset($data->data)){
			$novaordem = $data->data.",".$ultid;
		} else {
			$novaordem = $ultid;
		}		

		$db = new mysql();
		$db->inserir("banner_ordem", array(
			"codigo"=>"$categoria",
			"data"=>"$novaordem"
		));

		$this->irpara(DOMINIO.$this->_controller.'/alterar/aba/imagem/codigo/'.$codigo);
	}
	

	public function alterar(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Alterar";

 		$codigo = $this->get('codigo');

 		$aba = $this->get('aba');
 		if($aba){
 			$dados['aba_selecionada'] = $aba;
 		} else {
 			$dados['aba_selecionada'] = 'dados';
 		}
 		
 		$db = new mysql();
 		$exec = $db->Executar("SELECT * FROM banner where codigo='$codigo' ");
		$dados['data'] = $exec->fetch_object();
		
 		$lista = array();

 		$db = new mysql();
 		$exec = $db->Executar("SELECT * FROM banner_grupo order by titulo asc");
 		$n = 0;
 		while($data = $exec->fetch_object()){

 			$lista[$n]['codigo'] = $data->codigo;
 			$lista[$n]['titulo'] = $data->titulo;

 			if($dados['data']->grupo == $data->codigo){
 				$lista[$n]['selected'] = "selected";
 			} else {
 				$lista[$n]['selected'] = "";
 			}

 		$n++;
 		}
 		$dados['categorias'] = $lista;

 		$lista = array();

 		
		$this->view('banners.alterar', $dados);
	}


	public function alterar_grv(){
		
		$codigo = $this->post('codigo');

		$titulo = $this->post('titulo');
		$endereco = $_POST['endereco'];

		$this->valida($codigo);
		$this->valida($titulo);

		$db = new mysql();
		$db->alterar("banner", array(
			"titulo"=>"$titulo",
			"endereco"=>"$endereco"
		), " codigo='$codigo' ");
	 	
		$this->irpara(DOMINIO.$this->_controller.'/alterar/codigo/'.$codigo);		
	}


	public function imagem(){

		$arquivo_original = $_FILES['arquivo'];
		$tmp_name = $_FILES['arquivo']['tmp_name'];

		//carrega model de gestao de imagens
		$arquivo = new model_arquivos_imagens();

		$codigo = $this->get('codigo');

		$diretorio = "arquivos/img_banners/";

		if(!$arquivo->filtro($arquivo_original)){ $this->msg('Arquivo com formato inválido ou inexistente!'); $this->volta(1); } else {
			
			//pega a exteção
			$nome_original = $arquivo_original['name'];
			$extensao = $arquivo->extensao($nome_original);
			$nome_arquivo  = $arquivo->trata_nome($nome_original);
			
			if(copy($tmp_name, $diretorio.$nome_arquivo)){

				if( ($extensao == "jpg") OR ($extensao == "jpeg") OR ($extensao == "JPG") OR ($extensao == "JPEG") ){
					
					$db = new mysql();
					$exec = $db->executar("SELECT grupo FROM banner where codigo='$codigo' ");
					$data = $exec->fetch_object();
					
					$db = new mysql();
					$exec = $db->executar("SELECT * FROM banner_grupo where codigo='$data->grupo' ");
					$data_grupo = $exec->fetch_object();

					if($data_grupo->largura){

						//calcula a 
						$largura_g = $data_grupo->largura;
						$altura_g = $arquivo->calcula_altura_jpg($tmp_name, $largura_g);

						//redimenciona
						$arquivo->jpg($diretorio.$nome_arquivo, $largura_g , $altura_g , $diretorio.$nome_arquivo);
					}
				}
				
				//grava banco
				$db = new mysql();
				$db->alterar("banner", array(
					"imagem"=>"$nome_arquivo"
				), " codigo='$codigo' ");
				
				$this->irpara(DOMINIO.$this->_controller.'/alterar/codigo/'.$codigo.'/aba/imagem');
				
			} else {
				
				$this->msg('Erro ao gravar imagem!');
				$this->irpara(DOMINIO.$this->_controller."/alterar/codigo/".$codigo."/aba/imagem");
				
			}

		}
		
	}


	public function apagar_imagem(){
		
		$codigo = $this->get('codigo');
		
		if($codigo){

			$db = new mysql();
			$exec = $db->executar("SELECT * FROM banner where codigo='$codigo' ");
			$data = $exec->fetch_object();

			if($data->imagem){
				unlink('arquivos/img_banners/'.$data->imagem);
			}

			$db = new mysql();
			$db->alterar("banner", array(
				"imagem"=>""
			), " codigo='$codigo' ");
		}

		$this->irpara(DOMINIO.$this->_controller.'/alterar/codigo/'.$codigo.'/aba/imagem');
	}


	public function ordem(){

		$codigo = $this->post('codigo');
		$list = $this->post('list');

		$output = array();
		parse_str($list, $output);
		$ordem = implode(',', $output['item']);

		$db = new mysql();
		$db->apagar("banner_ordem", " codigo='$codigo' ");
		
		$db = new mysql();
		$db->inserir("banner_ordem", array(
			"codigo"=>"$codigo",
			"data"=>"$ordem"
		));

	}


	public function apagar_varios(){
		
		$db = new mysql();
		$exec = $db->Executar("SELECT * FROM banner ");
		while($data = $exec->fetch_object()){
			
			if($this->post('apagar_'.$data->id) == 1){
				
				if($data->imagem){
					unlink('arquivos/img_banners/'.$data->imagem);
				}

				$conexao = new mysql();
				$conexao->apagar("banner", " codigo='$data->codigo' ");
				
				$grupo = $data->grupo;
			}			 
		}
		
		$this->irpara(DOMINIO.$this->_controller.'/inicial/grupo/'.$grupo);
		
	}


	public function grupos(){
		
		$this->nivel_acesso(55);

		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
		$dados['_subtitulo'] = "Categorias";

		$categorias = array();

		$db = new mysql();
		$exec = $db->executar("SELECT * FROM banner_grupo order by titulo asc");
		$i = 0;
		$grupo_titulo = "";
		while($data = $exec->fetch_object()) {
			
			$categorias[$i]['id'] = $data->id;
			$categorias[$i]['codigo'] = $data->codigo;
			$categorias[$i]['titulo'] = $data->titulo;
			$categorias[$i]['largura'] = $data->largura;
			$categorias[$i]['altura'] = $data->altura;
			
		$i++;
		}
		$dados['categorias'] = $categorias;		
		
		$this->view('banners.categorias', $dados);
	}


	public function novo_grupo(){

		$this->nivel_acesso(55);
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Nova Categoria";


		$this->view('banners.categorias.nova', $dados);
	}


	public function novo_grupo_grv(){
		
		$this->nivel_acesso(55);

		$titulo = $this->post('titulo');
		$largura = $this->post('largura');
		$altura = $this->post('altura');

		$this->valida($titulo);
		$this->valida($largura);
		$this->valida($altura);
		
		$codigo = $this->gera_codigo();

		$db = new mysql();
		$db->inserir("banner_grupo", array(
			"codigo"=>"$codigo",
			"titulo"=>"$titulo",
			"largura"=>"$largura",
			"altura"=>"$altura"
		));
	 	

		$this->irpara(DOMINIO.$this->_controller.'/grupos');		
	}


	public function alterar_grupo(){

		$this->nivel_acesso(55);
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Alterar Grupo";

 		$codigo = $this->get('codigo');

 		$db = new mysql();
		$exec = $db->executar("SELECT * FROM banner_grupo WHERE codigo='$codigo' ");
		$dados['data'] = $exec->fetch_object();

		if(!isset($dados['data']) ) {
			$this->irpara(DOMINIO.$this->_controller.'/grupos');
		}

		$this->view('banners.categorias.alterar', $dados);
	}


	public function alterar_grupo_grv(){
		
		$this->nivel_acesso(55);

		$codigo = $this->post('codigo');

		$titulo = $this->post('titulo');
		$largura = $this->post('largura');
		$altura = $this->post('altura');

		$this->valida($codigo);
		$this->valida($titulo);
		$this->valida($largura);
		$this->valida($altura);		
		
		$db = new mysql();
		$db->alterar("banner_grupo", array(
			"titulo"=>"$titulo",
			"largura"=>"$largura",
			"altura"=>"$altura"
		), " codigo='$codigo' ");
	 	

		$this->irpara(DOMINIO.$this->_controller.'/grupos');		
	}


	public function apagar_grupos(){
		
		$this->nivel_acesso(55);

		$db = new mysql();
		$exec = $db->Executar("SELECT * FROM banner_grupo ");
		while($data = $exec->fetch_object()){
			
			if($this->post('apagar_'.$data->id) == 1){
				
				$conexao = new mysql();
				$conexao->apagar("banner_grupo", " id='$data->id' ");

			}
		}

		$this->irpara(DOMINIO.$this->_controller.'/grupos');		
	}


}
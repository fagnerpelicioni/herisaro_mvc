<?php

class usuarios extends controller {
	
	protected $_modulo_nome = "Usuários";

	public function init(){
		$this->autenticacao();
		$this->nivel_acesso(1);
	}


	public function inicial(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
		$dados['_subtitulo'] = "";
		
		$lista = array();
		
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_usuario WHERE codigo!='1' ");
		$i = 0;
		while($data = $exec->fetch_object()) {
			
			$lista[$i]['id'] = $data->id;
			$lista[$i]['codigo'] = $data->codigo;
			$lista[$i]['cod_externo'] = $data->cod_externo;
			$lista[$i]['cod_externo_alternativo'] = $data->cod_externo_alternativo;
			$lista[$i]['nome'] = $data->nome;
			$lista[$i]['email'] = $data->email_recuperacao;
			
		$i++;
		}
		$dados['lista'] = $lista;
		
		$this->view('usuarios', $dados);
	}
	
	
	 public function confere_usuario($usuario, $cod_usuario = null){
    	
    	$usuario_md5 = md5($usuario);    	 

    	$db = new mysql();
    	if( isset($cod_usuario) ){
    		$confere = $db->executar("SELECT * FROM adm_usuario WHERE usuario='$usuario_md5' AND codigo!='$cod_usuario' ");
		} else {
			$confere = $db->executar("SELECT * FROM adm_usuario WHERE usuario='$usuario_md5' ");
		}
		
		if($confere->num_rows != 0){
			$this->msg('O usuário fornecido não está disponível!');
			$this->volta(1);
		}
		
    }


	public function novo(){
		
		$this->nivel_acesso(5);
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Novo";

 		//lista de permissoes
 		$lista = array();
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_setores order by titulo asc");
		$i = 0;
		while($data = $exec->fetch_object()) {			 	
			
			$db = new mysql();
			$exec_confere = $db->Executar("SELECT * FROM adm_setores_perfil where setor='$data->id' ");
			if($exec_confere->num_rows != 0){
				
				$lista[$i]['id'] = $data->id;
				$lista[$i]['id_pai'] = $data->id_pai;
				$lista[$i]['titulo'] = $data->titulo;
				$lista[$i]['check'] = '';
				
			$i++;
			}
		}
		
		$lista_org = new model_ordena_permissoes();
		$lista_org->monta(0, $lista);
		$dados['lista'] = $lista_org->_lista_certa;
		
		$this->view('usuarios.novo', $dados);
	}


	public function novo_grv(){
		
		$this->nivel_acesso(5);

		$nome = $this->post('nome');
		$cod_externo = $this->post('cod_externo');
		$cod_externo_alternativo = $this->post('cod_externo_alternativo');
		$usuario = $this->post('usuario_sis');
		$senha = $this->post('senha_sis');
 		
		$this->valida($nome);	
		$this->valida($usuario);
		$this->valida($senha);
		
		$this->confere_usuario($usuario);
		
		$usuario_md5 = md5($usuario);
		$senha_md5 = md5($senha);
		
		$codigo = $this->gera_codigo();
		
		$db = new mysql();
		$db->inserir("adm_usuario", array(
			"codigo"=>"$codigo",
			"nome"=>"$nome",
			"cod_externo"=>"$cod_externo",
			"cod_externo_alternativo"=>"$cod_externo_alternativo",
			"usuario"=>"$usuario_md5",
			"senha"=>"$senha_md5"
		));
	 	
	 	$ordem = array();

	 	//permissoes
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_setores order by titulo asc");
		while($data = $exec->fetch_object()) {
			
			if( $this->post('setor_'.$data->id) ){
		 		
		 		$db = new mysql();
				$db->inserir("adm_setores_usuario", array(
					"usuario"=>"$codigo",
					"setor"=>"$data->id"
				));

				if( ($data->menu == 0) AND ($data->id_pai == 0) ){
					//confere se esta na ordem 
					if(!in_array($data->id, $ordem)){					 
						array_push($ordem, $data->id);
					}
				}

			}

		}
		
		//cria data e grava no banco
		$ordem = implode(",", $ordem);

		$db = new mysql();
		$db->apagar("adm_setores_ordem", " usuario='$codigo' ");

		$db = new mysql();
		$db->inserir("adm_setores_ordem", array(
			"usuario"=>"$codigo",
			"data"=>"$ordem"
		));

		$this->irpara(DOMINIO.$this->_controller);
	}
	

	public function alterar(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
 		$dados['_subtitulo'] = "Alterar";

 		$codigo = $this->get('codigo');

 		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_usuario WHERE codigo='$codigo' ");
		$dados['data'] = $exec->fetch_object();

		if(!isset($dados['data']) ) {
			$this->irpara(DOMINIO.$this->_controller);
		}

		//lista de permissoes
 		$lista = array();
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_setores order by titulo asc");
		$i = 0;
		while($data = $exec->fetch_object()) {
			
			$db = new mysql();
			$exec_confere = $db->Executar("SELECT * FROM adm_setores_perfil where setor='$data->id' ");
			if($exec_confere->num_rows != 0){
				
				$lista[$i]['id'] = $data->id;
				$lista[$i]['id_pai'] = $data->id_pai;
				$lista[$i]['titulo'] = $data->titulo;

				$db = new mysql();
				$exec_confere = $db->Executar("SELECT * FROM adm_setores_usuario where setor='$data->id' AND usuario='$codigo' ");
				if($exec_confere->num_rows != 0){ $lista[$i]['check'] = " checked='' "; } else { $lista[$i]['check'] = ""; }
				
			$i++;
			}
		}
		
		$lista_org = new model_ordena_permissoes();
		$lista_org->monta(0, $lista);
		$dados['lista'] = $lista_org->_lista_certa;

		$this->view('usuarios.alterar', $dados);
	}


	public function alterar_grv(){
		
		$this->nivel_acesso(5);

		$codigo = $this->post('codigo');

		$nome = $this->post('nome');
		$cod_externo = $this->post('cod_externo');
		$cod_externo_alternativo = $this->post('cod_externo_alternativo');
		$usuario = $this->post('usuario_sis');
		$senha = $this->post('senha_sis');
 
		$this->valida($nome);

		if($usuario AND $senha){

			$this->valida($usuario);
			$this->valida($senha);

			$this->confere_usuario($usuario, $codigo);
			
			$usuario_md5 = md5($usuario);
			$senha_md5 = md5($senha);
			
			$db = new mysql();
			$db->alterar("adm_usuario", array(
				"nome"=>"$nome",				 
				"usuario"=>"$usuario_md5",
				"senha"=>"$senha_md5",
				"cod_externo"=>"$cod_externo",
				"cod_externo_alternativo"=>"$cod_externo_alternativo"
			), " codigo='$codigo' ");
			
		} else {
			
			$db = new mysql();
			$db->alterar("adm_usuario", array(
				"nome"=>"$nome",
				"cod_externo"=>"$cod_externo",
				"cod_externo_alternativo"=>"$cod_externo_alternativo"
			), " codigo='$codigo' ");
		 	
	 	}

	 	//ordem do menu
    	$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_setores_ordem where usuario='$codigo' order by id desc limit 1");
		$data_ordem = $exec->fetch_object();
		
		if(isset($data_ordem->data)){
			$ordem = explode(',', $data_ordem->data);
		} else {
			$ordem = array();
		}

	 	//permissoes
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_setores order by titulo asc");
		while($data = $exec->fetch_object()) {

			$db = new mysql();
			$confere = $db->executar("SELECT * FROM adm_setores_usuario where setor='$data->id' AND usuario='$codigo' ");
			
			if( $this->post('setor_'.$data->id) ){

				if($confere->num_rows == 0){

					$db = new mysql();
					$db->inserir("adm_setores_usuario", array(
						"usuario"=>"$codigo",
						"setor"=>"$data->id"
					));

				}

				if( ($data->menu == 0) AND ($data->id_pai == 0) ){
					//confere se esta na ordem 
					if(!in_array($data->id, $ordem)){					 
						array_push($ordem, $data->id);
					}
				}

			} else {
				
				if($confere->num_rows != 0){

					$db = new mysql();
					$db->apagar("adm_setores_usuario", " setor='$data->id' AND usuario='$codigo' ");
					
				}

				if( ($data->menu == 0) AND ($data->id_pai == 0) ){
					//confere se esta na ordem 
					if(in_array($data->id, $ordem)){
						$key = array_search($data->id, $ordem);
						if($key!==false){
						    unset($ordem[$key]);
						}
					}
				}

			}
			
		}

		//cria data e grava no banco
		$ordem = implode(",", $ordem);

		$db = new mysql();
		$db->apagar("adm_setores_ordem", " usuario='$codigo' ");

		$db = new mysql();
		$db->inserir("adm_setores_ordem", array(
			"usuario"=>"$codigo",
			"data"=>"$ordem"
		));

		$this->irpara(DOMINIO.$this->_controller);
	}


	public function apagar_varios(){
		
		$this->nivel_acesso(4);

		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_usuario ");
		while($data = $exec->fetch_object()){
			
			if($this->post('apagar_'.$data->id) == 1){
				
				if($data->codigo != 1){

					$remove = new mysql();
					$remove->apagar("adm_usuario", " id='$data->id' ");
					
				} else {
					echo "O usuário Administrador não pode ser removido!";
				}
			}
		}

		$this->irpara(DOMINIO.$this->_controller);
	}


}
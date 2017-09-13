<?php

class config extends controller {
	
	protected $_modulo_nome = "Configurações";

	public function init(){
		$this->autenticacao();
		$this->nivel_acesso(2);
	}


	public function inicial(){
		
		$dados['_base'] = $this->base_layout();
		$dados['_titulo'] = $this->_modulo_nome;
		$dados['_subtitulo'] = "";
 		
 		if($this->nivel_acesso(52, false)){
			$dados['acesso_emails'] = true;
		} else {
			$dados['acesso_emails'] = false;
		}
		if($this->nivel_acesso(36, false)){
			$dados['acesso_meta'] = true;
		} else {
			$dados['acesso_meta'] = false;
		}
		if($this->nivel_acesso(37, false)){
			$dados['acesso_smtp'] = true;
		} else {
			$dados['acesso_smtp'] = false;
		}
		if($this->nivel_acesso(38, false)){
			$dados['acesso_logo'] = true;
		} else {
			$dados['acesso_logo'] = false;
		}

 		$db = new mysql();
		$exec = $db->executar("SELECT * FROM meta where id='1' ");
		$dados['data_meta'] = $exec->fetch_object();
		
 		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_config where id='1' ");
		$dados['data'] = $exec->fetch_object();
 		
		if($this->get('aba')){
			$dados['aba_selecionada'] = $this->get('aba');
		} else {

			if($dados['acesso_logo']){
				$dados['aba_selecionada'] = 'imagem';
			}
			if($dados['acesso_smtp']){
				$dados['aba_selecionada'] = 'smtp';
			}
			if($dados['acesso_meta']){
				$dados['aba_selecionada'] = 'meta';
			}
			if($dados['acesso_emails']){
				$dados['aba_selecionada'] = 'emails';
			}

		}

		//lista emails
		if($dados['acesso_emails']){

			$contatos = array();

			$db = new mysql();
			$exec = $db->executar("SELECT * FROM contato order by titulo asc");
			$n = 0;
			while($dada = $exec->fetch_object()){

				$contatos[$n]['id'] = $dada->id;
				$contatos[$n]['codigo'] = $dada->codigo;
				$contatos[$n]['email'] = $dada->email;
				$contatos[$n]['titulo'] = $dada->titulo;

			$n++;
			}
			$dados['contatos'] = $contatos;

		}

		$this->view('config', $dados);
	}


	public function novo_email(){

		$dados['_base'] = $this->base_layout();


		$this->view('config.novo.email', $dados);
	}


	public function novo_email_grv(){
		
		$titulo = $this->post('titulo');
		$email = $this->post('email');

		$this->valida($titulo);
		$this->valida($email);

		$codigo = $this->gera_codigo();

		$db = new mysql();
		$db->inserir("contato", array(
			"codigo"=>"$codigo",
			"titulo"=>"$titulo",
			"email"=>"$email"
		));

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/emails');
	}


	public function alterar_email(){

		$dados['_base'] = $this->base_layout();

		$id = $this->get('codigo');

		$db = new mysql();
		$exec = $db->executar("SELECT * FROM contato where id='$id' ");
		$dados['data'] = $exec->fetch_object();

		$this->view('config.alterar.email', $dados);
	}
	
	
	public function alterar_email_grv(){
		
		$id = $this->post('id');
		$titulo = $this->post('titulo');
		$email = $this->post('email');

		$this->valida($titulo);
		$this->valida($email);
		$this->valida($id);

		$db = new mysql();
		$db->alterar("contato", array(
			"titulo"=>"$titulo",
			"email"=>"$email"
		), " id='$id' ");

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/emails');
	}


	public function apagar_emails(){

		$db = new mysql();
		$exec = $db->Executar("SELECT * FROM contato ");
		while($data = $exec->fetch_object()){
			
			if($this->post('apagar_'.$data->id) == 1){
				
				$conexao = new mysql();
				$conexao->apagar("contato", " id='$data->id' ");
					
			}
		}

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/emails');

	}


	public function meta_grv(){

		$this->nivel_acesso(36);

		$titulo_pagina = $this->post('titulo_pagina');
		$descricao = $this->post('descricao');

		$db = new mysql();
		$db->alterar("meta", array(
			"titulo_pagina"=>"$titulo_pagina",
			"descricao"=>"$descricao"
		), " id='1' ");

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/meta');
	}


	public function smtp_grv(){

		$this->nivel_acesso(37);

		$email_nome = $this->post('email_nome');
		$email_origem = $this->post('email_origem');
		$email_retorno = $this->post('email_retorno');
		$email_porta = $this->post('email_porta');
		$email_host = $this->post('email_host');
		$email_usuario = $this->post('email_usuario');
		$email_senha = $this->post('email_senha');

		$this->valida($email_nome);
		$this->valida($email_origem);
		$this->valida($email_retorno);
		$this->valida($email_porta);
		$this->valida($email_host);
		$this->valida($email_usuario);
		$this->valida($email_senha);

		$db = new mysql();
		$db->alterar("adm_config", array(
			"email_nome"=>"$email_nome",
			"email_origem"=>"$email_origem",
			"email_retorno"=>"$email_retorno",
			"email_porta"=>"$email_porta",
			"email_host"=>"$email_host",
			"email_usuario"=>"$email_usuario",
			"email_senha"=>"$email_senha"
		), " id='1' ");

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/smtp');
	}


	public function apagar_logo(){

		$this->nivel_acesso(38);

		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_config where id='1' ");
		$dada = $exec->fetch_object();

		if($dada->logo){
			unlink('arquivos/img_logo/'.$dada->logo);
		}

		$db = new mysql();
		$db->alterar("adm_config", array(
			"logo"=>""
		), " id='1' "); 

		$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/imagem');
	}


	public function logo(){

		$this->nivel_acesso(38);

		$arquivo_original = $_FILES['arquivo'];
		$tmp_name = $_FILES['arquivo']['tmp_name'];
		
		//carrega model de gestao de imagens
		$arquivo = new model_arquivos_imagens();	

		//// Definicao de Diretorios / 
		$diretorio = "arquivos/img_logo/";

		if(!$arquivo->filtro($arquivo_original)){ $this->msg('Arquivo com formato inválido ou inexistente!'); $this->volta(1); } else {	
		 
			$nome_original = $arquivo_original['name'];
			$extensao = $arquivo->extensao($nome_original);
			$nome_arquivo  = $arquivo->trata_nome($nome_original);

			$destino = $diretorio.$nome_arquivo;
				
			if(copy($tmp_name, $destino)){
					
				if( ($extensao == "jpg") OR ($extensao == "jpeg") OR ($extensao == "JPG") OR ($extensao == "JPEG") ){
					
					// foto grande
					$largura_g = 500;
					$altura_g = $arquivo->calcula_altura_jpg($diretorio.$nome_arquivo, $largura_g);
					
					//redimenciona
					$arquivo->jpg($diretorio.$nome_arquivo, $largura_g , $altura_g, $diretorio.$nome_arquivo);					
				}

				$db = new mysql();
				$db->alterar("adm_config", array(
					"logo"=>"$nome_arquivo"
				), " id='1' "); 
					
				$this->irpara(DOMINIO.$this->_controller.'/inicial/aba/imagem');
					
			} else {					
				$this->msg('Não foi possível copiar o arquivo!');
				$this->volta(1);
			}
				
		}

	}


}
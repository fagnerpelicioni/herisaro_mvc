<?php
class faleconosco extends controller {
	
	public function init(){
		
	}
	
	public function inicial(){
		
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
		$dados['mapa'] = $texto->conteudo('147928640917138');
		
		//rede social
		$redessociais = new model_redes_sociais();
		$dados['facebook'] = $redessociais->codigo('147193121148864');

	 	//carrega lista de destinos do formulario
		$destinos = new model_destinos();
		$dados['destinos'] = $destinos->lista();

	 	
		//carrega view e envia dados para a tela
		$this->view('faleconosco', $dados);
	}
	

	public function enviar(){
		
		$nome = $this->post('nome');
		$email = $this->post('email');
		$fone = $this->post('fone');
		$mensagem = $this->post('msg');

		$destino = $this->post('destino');

		$anexo = $_FILES['arquivo'];

		/* mensagem */
		$msg = "<div style='padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;'><p>Contato enviado pelo Website</p></div>";	
		$msg .= "<div style='padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;'><p><strong>Nome:</strong> ".$nome."</p></div>";
		$msg .= "<div style='padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;'><p><strong>E-mail:</strong> ".$email."</p></div>";
		$msg .= "<div style='padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;'><p><strong>Telefone:</strong> ".$fone."</p></div>";
		$msg .= "<div style='padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;'><p><strong>Mensagem:</strong> ".$mensagem."</p></div>";
		
		//pega do banco o email de destino cadastrado no painel
		$db = new mysql();
		$exec = $db->executar("select * from contato WHERE codigo='147017157989381' ");
		$data = $exec->fetch_object();
		
		$db = new mysql();
		$exec = $db->executar("SELECT * FROM adm_config WHERE id='1' ");
		$data_config = $exec->fetch_object();
		
		require_once("_api/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = $data_config->email_host;
		$mail->Port = $data_config->email_porta;
		$mail->SMTPAuth = true;
		$mail->Username = $data_config->email_usuario;
		$mail->Password = $data_config->email_senha;
		$mail->From = $data_config->email_origem;
		$mail->FromName = $data_config->email_nome;
		$mail->AddAddress($destino, "");
		$mail->WordWrap = 50;
		
 		//confere se foi anexado algo
 		if($anexo['tmp_name']){
 			
 			//confere extenções proibidas
 			if(substr($_FILES['arquivo']['name'],-3)=="exe" || 
				substr($_FILES['arquivo']['name'],-3)=="php" || 
				substr($_FILES['arquivo']['name'],-4)=="php3" || 
				substr($_FILES['arquivo']['name'],-4)=="php4"){
				
				$this->msg('Não é permitido enviar arquivos com esta extenção!');
				$this->volta(1);
				
			} else {

				$array = explode(".", $anexo['name']);
				$extensao = end($array);

				$destino_arquivo = 'temp/'.time().'.'.$extensao;

				if(copy($anexo['tmp_name'], $destino_arquivo)){

					//anexando arquivos no email
					$mail->AddAttachment($destino_arquivo);

				} else {

					$this->msg('Não foi permitido anexar o arquivo!, tente um arquivo de menor tamanho!');
					$this->volta(1);

				}
			}
 		} 		

		$mail->IsHTML(true); //enviar em HTML
		$mail->AddReplyTo("$email", "");
		$mail->Subject = "Contato website";
		$mail->Body = utf8_decode($msg);
		

		if($mail->Send()){
			$this->msg('Mensagem enviada com sucesso!');

			//remove anexo
			if($anexo['tmp_name']){
				unlink($destino_arquivo);
			}

			$this->volta(1);
		} else {
			$this->msg('Erro ao enviar mensagem!');
			$this->volta(1);
		}
		
	}

}
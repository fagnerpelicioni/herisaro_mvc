<?php

Class model_usuarios extends model{
	
    public function lista(){
    	
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
	  	
		return $lista;
	}


	public function nome($codigo){ 

    	$db = new mysql();
		$exec = $db->executar("SELECT nome FROM adm_usuario WHERE codigo='$codigo' ");
		$data = $exec->fetch_object();

		if(isset($data->nome)){
			return $data->nome;
		} else {
			return 'Não indentificado';
		}
		 
	}

	
}
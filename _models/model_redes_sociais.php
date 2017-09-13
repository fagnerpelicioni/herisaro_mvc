<?php

Class model_redes_sociais extends model{
    
    public function codigo($codigo){
    	
		$db = new mysql();
		$exec = $db->executar("select * from rede_social WHERE codigo='$codigo' ");
		$data = $exec->fetch_object();
		
		$return = array();
		
		if(isset($data->endereco)){
			$return['endereco'] = $data->endereco;
		} else {
			$return['endereco'] = '';
		}

		if(isset($data->imagem)){
			$return['imagem'] = PASTA_CLIENTE.'img_redes_sociais/'.$data->imagem;
		} else {
			$return['imagem'] = '';
		}
		
		return $return;
    }





}
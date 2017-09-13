<?php

Class model_clientes extends model{
    
    public function lista(){
    	
    	$lista = array();

		$db = new mysql();
		$exec = $db->executar("select * from clientes order by rand() ");
		$n = 0;
		while($data = $exec->fetch_object()){

			$lista[$n]['nome'] = $data->nome;
			$lista[$n]['descricao'] = $data->descricao;
			
			if($data->imagem){
				$lista[$n]['imagem'] = PASTA_CLIENTE.'img_clientes/'.$data->imagem;
			} else {
				$lista[$n]['imagem'] = "";
			}

		$n++;
		}
		
		return $lista;
    }

}
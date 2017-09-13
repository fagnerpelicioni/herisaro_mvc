<?php

Class model_texto extends model{
    
    public function conteudo($codigo){
    	
		$db = new mysql();
		$exec = $db->executar("select * from texto WHERE codigo='$codigo' ");
		$data = $exec->fetch_object();
		
		if(isset($data->conteudo)){
			$conteudo = $data->conteudo;
		} else {
			$conteudo = '';
		}
		
		return $conteudo;
    }



}
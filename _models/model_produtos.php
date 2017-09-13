<?php

Class model_produtos extends model{
    
	public $perpage = 10; //itens por pagina
	public $numlinks = 10; //total de paginas mostradas na paginação
	public $busca = '-';
	public $grupo = 0;
	public $startitem = 0;
	public $startpage = 1;
	public $endpage = '';
	public $reven = 1;
	public $ordem = ''; // 'rand' para randomico ou em branco para data desc

    public function lista(){
    	
    	//define variaveis
		$perpage = $this->perpage;
		$numlinks = $this->numlinks;
		$busca = $this->busca;
		$grupo = $this->grupo;
		$startitem = $this->startitem;
		$startpage = $this->startpage;
		$endpage = $this->endpage;
		$reven = $this->reven;
		$ordem = $this->ordem;

		//retorno 
		$dados = array();

    	//FILTROS
		$query = "SELECT * FROM produtos ";

		//se tiver busca ignora tudo e faz a busca
		if($busca != "-"){
		    $query = "SELECT * FROM produtos WHERE titulo LIKE '%$busca%' OR previa LIKE '%$busca%' ";
		} else {

			//se selecionou o grupo tem prioridade sobre o destaque
			if($grupo != 0){
				$query = "SELECT * FROM produtos WHERE grupo='$grupo' ";
			}

		}
		
		//faz a busca no banco e retorno numero de itens para paginação
		$conexao = new mysql();
		$coisas_noticias = $conexao->Executar($query);
		if($coisas_noticias->num_rows) {
		  $numitems = $coisas_noticias->num_rows;
		} else {
		  $numitems = 0;
		}
		$dados['numitems'] = $numitems;
		
		
		//calcula paginação
		if($numitems > 0) {
		  $numpages = ceil($numitems / $perpage); 
		  if($startitem + $perpage > $numitems) { $enditem = $numitems; } else { $enditem = $startitem + $perpage; }
		  if(!$startpage) { $startpage = 1; }
		  if(!$endpage) { 
		    if($numpages > $numlinks) { $endpage = $numlinks; } else { $endpage = $numpages; }
		  }
		} else {
		  $numpages = 0;
		}

		$lista = array();
		$mes = new model_data();

		//ordena e limita aos itens da pagina
		if($ordem == 'rand'){
			$query .= " ORDER BY RAND() LIMIT $startitem, $perpage";
		} else {
			$query .= " ORDER BY id desc LIMIT $startitem, $perpage";
		}

		$conexao = new mysql();
		$coisas_lista = $conexao->Executar($query);
		$n = 0;
		while($data_lista = $coisas_lista->fetch_object()){

			//seta imagem como não existente
			$imagem = "";

			//confere se tem imagem ordenada
			$conexao = new mysql();
			$coisas_ordem = $conexao->Executar("SELECT * FROM produtos_imagem_ordem WHERE codigo='$data_lista->codigo' ORDER BY id desc limit 1");
			$data_ordem = $coisas_ordem->fetch_object();
			
			//se tiver ordem segue o baile
			if(isset($data_ordem->data)){

				$order = explode(',', $data_ordem->data);

				$ii = 0;
				foreach($order as $key => $value){

					$conexao = new mysql();
					$coisas_img = $conexao->Executar("SELECT imagem FROM produtos_imagem WHERE id='$value'");
					$data_img = $coisas_img->fetch_object();

					//pega primeira imagem da ordem e coloca na variavel
					if( ($ii == 0) AND (isset($data_img->imagem)) ){

						$imagem = PASTA_CLIENTE."img_produtos_g/".$data_lista->codigo."/".$data_img->imagem;

					$ii++;
					}
				}
			}

			$lista[$n]['imagem'] = $imagem;

			//verifica nome do grupo
			$conexao = new mysql();
			$coisas_lista_cat = $conexao->Executar("SELECT titulo FROM produtos_grupos WHERE codigo='$data_lista->grupo'");
			$data_lista_cat = $coisas_lista_cat->fetch_object();

			$lista[$n]['grupo'] = $data_lista_cat->titulo;
			$lista[$n]['grupo_codigo'] = $data_lista->grupo;			 

			//restante
			$lista[$n]['id'] = $data_lista->id;
			$lista[$n]['codigo'] = $data_lista->codigo;
			$lista[$n]['titulo'] = $data_lista->titulo;
			$lista[$n]['previa'] = $data_lista->previa;
			$lista[$n]['conteudo'] = $data_lista->conteudo; 
			
		$n++;
		}
		$dados['lista'] = $lista;

		//lista paginação
		$paginacao = "<ul class='pagination'>";

		if($numpages > 1) { 
			if($startpage > 1) {
				$prevstartpage = $startpage - $numlinks;
				$prevstartitem = $prevstartpage - 1;
				$prevendpage = $startpage - 1;

				$link = DOMINIO."produtos/lista/grupo/$grupo/busca/$busca/";
				$link .= "startitem/$prevstartitem/startpage/$prevstartpage/endpage/$prevendpage/reven/$prevstartpage/";

            }

			for($n = $startpage; $n <= $endpage; $n++) {

				$nextstartitem = ($n - 1) * $perpage;

				if($n != $reven) {

					$link = DOMINIO."produtos/lista/grupo/$grupo/busca/$busca/";
					$link .= "startitem/$nextstartitem/startpage/$startpage/endpage/$endpage/reven/$n/";
					$paginacao .= "<li><a href='$link' >&nbsp;$n&nbsp;</a></li>";

				} else {
					$paginacao .= "<li><a href='#' class='active' >&nbsp;$n&nbsp;</a></li>";
				}
			}

			if($endpage < $numpages) {

				$nextstartpage = $endpage + 1;

				if(($endpage + $numlinks) < $numpages) { 
					$nextendpage = $endpage + $numlinks; 
				} else {
					$nextendpage = $numpages;
				}

				$nextstartitem = ($n - 1) * $perpage;

				$link = DOMINIO."produtos/lista/grupo/$grupo/busca/$busca/";
				$link .= "startitem/$nextstartitem/startpage/$nextstartpage/endpage/$nextendpage/reven/$nextstartpage/";

			}
		}
		$paginacao .= "</ul>";

		$dados['paginacao'] = $paginacao;

		//retorna para a pagina a array com todos as informações
		return $dados;
	}


	public function lista_grupos(){
    	
    	//lista categorias para lateral
		$categorias = array();
		$conexao = new mysql();
		$coisas_categorias = $conexao->Executar("SELECT * FROM produtos_grupos order by titulo asc");
		$n = 0;
		while($data_categorias = $coisas_categorias->fetch_object()){ 
			
			$categorias[$n]['codigo'] = $data_categorias->codigo;			 
			$categorias[$n]['titulo'] = $data_categorias->titulo;
			$categorias[$n]['imagem'] = PASTA_CLIENTE."img_produtos_grupos/".$data_categorias->imagem;
			
		$n++;
		}		
		
		//retorna para a pagina a array com todos as informações
		return $categorias;
	}


	public function titulo_grupo($codigo){
    	
		$conexao = new mysql();
		$coisas_categorias = $conexao->Executar("SELECT titulo FROM produtos_grupos where codigo='$codigo' ");
		$data_categorias = $coisas_categorias->fetch_object();
		
		return $data_categorias->titulo;
	}


}
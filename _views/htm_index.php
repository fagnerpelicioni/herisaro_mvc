<?php require_once('_system/bloqueia_view.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?=$_base['titulo_pagina']?></title>
	<link rel="shortcut icon" href="<?=$_base['favicon'];?>">

	<meta name="description" content="<?=$_base['descricao']?>" />
	<meta property="og:description" content="<?=$_base['descricao']?>">
	<meta name="author" content="Fagner Pelicioni">
	<meta name="classification" content="Website" />
	<meta name="robots" content="index, follow">
	<meta name="Indentifier-URL" content="<?=DOMINIO?>" />
	
	<link rel="stylesheet" href="<?=LAYOUT?>api/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/font-awesome-4.6.2/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/hover-master/css/hover-min.css" rel="stylesheet">


	<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" >

	<link href="<?=LAYOUT?>css/style.css" rel="stylesheet" type="text/css"  media="all" />
	<link href="<?=LAYOUT?>css/responsiveslides.css" rel="stylesheet" >	 
	<link href="<?=LAYOUT?>css/blog.css" rel="stylesheet" >
	
	<?php include_once('htm_css.php'); ?>

</head>
	
	<body>	

		<?php include_once('htm_topo.php'); ?>

		<?php include_once('htm_banners.php'); ?>



		<div class="content">
		<div class="container">

			<div class="row" >
				<div class='col-md-12'>
					<div style="text-align:center; padding-top:10px; letter-spacing: 10px;"><h2 class="titulos" >ÚLTIMAS PUBLICAÇÕES</h2></div>					
				</div>
			</div>

			<div class="row" >
			<?php

				foreach ($noticias as $key => $value) {

					$endereco_not = $value['endereco'];

					//titulo sempre aparece
					echo "
					<div class='col-md-4'>

						<div class='noticias_caixa_inicial' >
							<div class='noticia_titulo_inicial' >
								<h2 class='blog_lista_titulo' >
									<a href='$endereco_not' class='blog_lista_titulo noticia_inicial_titulo_ajuste' >".$value['titulo']."</a>
								</h2>
							</div>
							<div class='noticia_inicial_imagem' style='background-image: url(".$value['imagem'].");' onClick=\"window.location='$endereco_not';\" ></div>
							<div class='blog_lista_previa' >
								".$value['previa']."
							</div>
							<div><a class='botao_padrao hvr-float-shadow' href='$endereco_not' >Leia mais</a></div>
						</div>

					</div>
					";
					 
				}
				
			?>
			</div>

		</div>
		</div>
  		

		<?php include_once('htm_rodape.php'); ?>
		
	</body>
</html>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="<?=LAYOUT?>js/responsiveslides.min.js"></script>
<script src="<?=LAYOUT?>js/geral.js"></script>
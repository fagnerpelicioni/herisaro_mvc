<?php require_once('_system/bloqueia_view.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Quem Somos - <?=$_base['titulo_pagina']?></title>
	<link rel="shortcut icon" href="<?=$_base['favicon'];?>">

	<meta name="description" content="Quem Somos - <?=$_base['descricao']?>" />
	<meta property="og:description" content="<?=$_base['descricao']?>">
	<meta name="author" content="NuvemServ.com.br">
	<meta name="classification" content="Website" />
	<meta name="robots" content="index, follow">
	<meta name="Indentifier-URL" content="<?=DOMINIO?>" />
	
	<link rel="stylesheet" href="<?=LAYOUT?>api/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/font-awesome-4.6.2/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" >

	<link href="<?=LAYOUT?>css/style.css" rel="stylesheet" type="text/css"  media="all" />
	<link href="<?=LAYOUT?>css/responsiveslides.css" rel="stylesheet" >

	<?php include_once('htm_css.php'); ?>
	
</head>

	<body>	

		<?php include_once('htm_topo.php'); ?>



		<div class="container">

			<div style="margin-bottom:80px; width: 100%;"></div>

			<div class="row" >

				<div class="col-md-8">

                                    <h2 class="titulos" style="color: #c2c2c2;" >Quem Somos</h2>

					<div class="texto_inicial" ><?=$texto_quemsomos?></div>
					
				</div>

				<div class="col-md-4">		
					<div class="imagem_quemsomos"><img src="<?=$imagem_quemsomos?>"></div>
				</div>

			</div>

			<div style="padding-bottom:80px; width: 100%;"></div>

		</div>


		<div class="content content2">

			<div style="padding-bottom:60px; width: 100%;"></div>

			<div class="container">
			<div class="row" >
				
				<div class="col-md-3">

					<h2 class="titulos" >Visão</h2>
					<div class="texto_inicial" ><?=$texto_visao?></div>

				</div>

				<div class="col-md-1" style="text-align: center;"><div class="quemsomos_linha"></div></div>

				<div class="col-md-4">

					<h2 class="titulos" >Missão</h2>
					<div class="texto_inicial" ><?=$texto_missao?></div>

				</div>

				<div class="col-md-1" style="text-align: center;"><div class="quemsomos_linha"></div></div>

				<div class="col-md-3">

					<h2 class="titulos" >Valores</h2>
					<div class="texto_valores" ><?=$texto_valores?></div>

				</div>

			</div>
			</div>

		</div>



		<?php include_once('htm_rodape.php'); ?>
		
	</body>
</html>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="<?=LAYOUT?>js/responsiveslides.min.js"></script>
<script src="<?=LAYOUT?>js/geral.js"></script>
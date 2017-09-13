<?php require_once('_system/bloqueia_view.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?=$data->titulo?> - <?=$_base['titulo_pagina']?></title>
	<link rel="shortcut icon" href="<?=$_base['favicon'];?>">

	<meta name="description" content="<?=$data->previa?>" />
	<meta property="og:description" content="<?=$data->previa?>">
	<meta name="author" content="NuvemServ.com.br">
	<meta name="classification" content="Website" />
	<meta name="robots" content="index, follow">
	<meta name="Indentifier-URL" content="<?=DOMINIO?>" />
	
	<!--start Facebook Open Graph Protocol-->
	<meta property="og:site_name" content="<?=$_base['titulo_pagina']?>" />
	<meta property="og:title" content="<?=$data->titulo?> - <?=$_base['titulo_pagina']?>" />
	<meta property="og:image" content="<?=$imagem_principal?>"/>
	<meta property="og:url" content="<?=$endereco_noticia?>"/>
	<!--end Facebook Open Graph Protocol-->
	
	<link rel="stylesheet" href="<?=LAYOUT?>api/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/font-awesome-4.6.2/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/hover-master/css/hover-min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<link href="<?=LAYOUT?>css/style.css" rel="stylesheet" type="text/css"  media="all" />	 
	<link href="<?=LAYOUT?>css/responsiveslides.css" rel="stylesheet" >
	<link href="<?=LAYOUT?>css/page-nav.css" rel="stylesheet" >
	<link href="<?=LAYOUT?>css/images.css" rel="stylesheet" >
	<link href="<?=LAYOUT?>css/blog.css" rel="stylesheet" >

	<?php include_once('htm_css.php'); ?>
	
</head>

	<body>	

		<?php include_once('htm_topo.php'); ?>

			 
		<div style="position: relative; width: 100%; padding-top:70px;" >

		<div class="container">
		<div class="row">
			
			<div class="col-xs-12 col-sm-8 col-md-8" >
				
				<h1 class='blog_lista_titulo' >
					<a href='#' class='blog_lista_titulo' ><?=$data->titulo?></a>
				</h1>
				<ul class='blog_lista_meta' >					 
					<li><i class='fa fa-aw fa-calendar-o' ></i> <?=$dia?></li>					
					<li><i class='fa fa-folder-open' ></i> <?=$categoria?></li>
					<?php
					if($autor){
						echo "<li><i class='fa fa-user' ></i> ".$autor."</li>";
					}
					?>
				</ul>

				<div class='blog_divisao_interna' ></div>

				<div class="blog_padrao_conteudo" >
					<?=$data->conteudo?>
				</div>

				<?php
				//lista imagens da postagem

					foreach ($imagens as $key => $value) {
						
						echo "<div class='blog_imagem_interna' ><img src='".$value['imagem_g']."' ></div>";
						if($value['legenda']){
							echo "<div class='blog_legenda' >".$value['legenda']."</div>";
						}

					}

				?>

				<div class='blog_divisao_interna2' ></div>

				<div class="social" >
					
					<h2 class='blog_titulos' style="padding-bottom:20px;" >
						Gostou? Compartilhe!
					</h2>
					
					<ul>
						<li>
							<a href="http://www.facebook.com/sharer.php?u=<?=$endereco_noticia?>" class="facebook" target="_blank" title="Compartilhar via Facebook"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="http://twitter.com/intent/tweet?text=<?=$data->titulo?>&url=<?=$endereco_noticia?>" class="twitter" target="_blank" title="Compartilhar via Twitter"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="https://plus.google.com/share?url=<?=$endereco_noticia?>" target="_blank" class="googleplus" title="Compartilhar via Google+"><i class="fa fa-google-plus"></i></a>
						</li>
						<li>
							<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?=$endereco_noticia?>" target="_blank" class="linkedin" title="Compartilhar via LinkedIn"><i class="fa fa-linkedin"></i></a>
						</li>
					</ul>

				</div>			
				<div class="blog_voltar_noticia" >
					<a class="dow-btn botao_padrao hvr-float-shadow" href="#" onClick="history.go(-1)" >Voltar</a>
				</div>

				<div style="clear:left;" ></div>				 
				
			</div>

			<div class="col-xs-12 col-sm-4 col-md-4" >
				<div class="blog_divisao_lateral" >
					<?php include_once('htm_blog.lateral.php'); ?>
				</div>

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
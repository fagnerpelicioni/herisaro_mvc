<?php require_once('_system/bloqueia_view.php'); ?>

<div class="header">
	<div class="container">
		<div class="row" >
		<div class="col-md-12">

			<div class="logo">
				<a href="<?=DOMINIO?>"><img src="<?=$logo?>" title="logo" /></a>
			</div>
			
			<div class="botaomenuresponsivo">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div>

			<div class="top-nav">
				<ul>
					<li <?php if($controller == 'index'){ echo 'class="active"'; } ?> ><a href="<?=DOMINIO?>index">Inicial</a></li>	
					<li <?php if($controller == 'quemsomos'){ echo 'class="active"'; } ?> ><a href="<?=DOMINIO?>quemsomos">Quem Somos</a></li>
					<li <?php if($controller == 'servicos'){ echo 'class="active"'; } ?>><a href="<?=DOMINIO?>servicos">Artesanatos</a></li>
					<li <?php if($controller == 'blog'){ echo 'class="active"'; } ?> ><a href="<?=DOMINIO?>blog">Notícias/Blog</a></li>
					<li <?php if($controller == 'faleconosco'){ echo 'class="active"'; } ?> ><a href="<?=DOMINIO?>faleconosco">Fale Conosco</a></li>
				</ul>
			</div>

			<div class="clear"></div>

		</div>
		</div>
	</div>
</div>
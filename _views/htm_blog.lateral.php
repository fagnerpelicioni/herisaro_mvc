<?php require_once('_system/bloqueia_view.php'); ?>

<div>
	<h2 class='h3' >
		<a class='blog_lista_titulo' >Buscar</a>
	</h2>

	<form id="form_busca" name="form_busca" action="<?=DOMINIO?>busca_blog" method="post" >
						
		<div style="padding-top:20px;">
			<input name="busca" type="text" class="form-control campo_busca" placeholder="O que procura?" style="width:100%; border-radius:0px;" >

			<a class='dow-btn botao_padrao hvr-float-shadow' style="width:100%; margin-top:10px" onclick="document.form_busca.submit()" ><i class="fa fa-search"></i> BUSCAR</a>
		</div>

	</form>
</div>

<div style="margin-top:30px">

	<h2 class='h3' >
		<a class='blog_lista_titulo' >Categorias</a>
	</h2>	

	<div style="padding-top:5px;">
	<?php

		foreach ($categorias as $key => $value) {
			
			$endereco_cat = DOMINIO."blog/lista/categoria/".$value['codigo'];

			if($categoria_codigo == $value['codigo']){
				$ativo = " blog_cate_ativa";
			} else {
				$ativo = "";
			}

			echo "
			<div class='blog_categorias".$ativo."' >
				<a href='$endereco_cat' ><i class='fa fa-folder-open-o'></i> ".$value['titulo']."</a>
			</div>
			";

		}

	?>
	</div>
	
</div>


<div style="margin-top:30px">

	<div class="image-slider">
		<ul class="rslides" id="slider1">
		<?php
			
			foreach ($banners as $key => $value) {
				echo "
				<li ".$value['link']." >
					<img src='".$value['imagem']."' >
				</li>
				";
			}
			
		?>
		</ul>
	</div>

<div class="clear"></div>

</div>
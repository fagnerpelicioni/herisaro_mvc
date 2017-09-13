<?php require_once('_system/bloqueia_view.php'); ?>

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
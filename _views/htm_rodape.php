<?php require_once('_system/bloqueia_view.php'); ?>

<div class="footer">
	<div class="container">
		<div class="row" >
			
			<div class="col-md-4">
				<div class="footer-grid">
					<h3>FALE CONOSCO</h3>
					<div><?=$texto_rodape?></div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-grid">
					<h3>LINKS RÁPIDOS</h3>
					<div class="row">
						<div class="col-md-5">

							<ul>
								<li><a href="<?=DOMINIO?>quemsomos">Quem Somos</a></li>
								<li><a href="<?=DOMINIO?>servicos">Serviços</a></li> 
							</ul>

						</div>
						<div class="col-md-7">

							<ul>
								<li><a href="<?=DOMINIO?>blog">Notícias/Blog</a></li> 
								<li><a href="<?=DOMINIO?>faleconosco">Fale Conosco</a></li>
							</ul>

						</div>						
					</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="footer-grid">
					<div class="rodape_facebook"><iframe src="//www.facebook.com/plugins/likebox.php?href=<?=$facebook['endereco']?>&amp;width=350&amp;height=140&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:140px;" allowTransparency="true"></iframe></div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="copy-right">
	<p>2017 © Todos os direitos reservados.</p>
</div>
<?php
class sitemap extends controller {
	
	public function init(){
		
	}
	
	public function inicial(){		
		
		header("Content-Type: application/xml; charset=UTF-8");
		echo '<?xml version="1.0" encoding="UTF-8"?>';

		$hoje = date('Y-m-d');

	echo '
	<urlset
		xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
		http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

		<url>
		  <loc>'.DOMINIO.'</loc>
		  <lastmod>'.$hoje.'</lastmod>
		  <priority>1.00</priority>
		  <changefreq>monthly</changefreq>
		</url>
		
		<url>
		  <loc>'.DOMINIO.'faleconosco</loc>
		  <lastmod>'.$hoje.'</lastmod>
		  <priority>0.9</priority>
		  <changefreq>monthly</changefreq>
		</url>

		<url>
		  <loc>'.DOMINIO.'quemsomos</loc>
		  <lastmod>'.$hoje.'</lastmod>
		  <priority>0.9</priority>
		  <changefreq>monthly</changefreq>
		</url>

		<url>
		  <loc>'.DOMINIO.'servicos</loc>
		  <lastmod>'.$hoje.'</lastmod>
		  <priority>0.9</priority>
		  <changefreq>monthly</changefreq>
		</url>

		<url>
		  <loc>'.DOMINIO.'blog/inicial</loc>
		  <lastmod>'.$hoje.'</lastmod>
		  <priority>1.0</priority>
		  <changefreq>monthly</changefreq>
		</url>
		
	';
	
	  	//carrega modulo de noticias/bog
		$blog = new model_postagens();
		$blog->perpage = 999999999;
		
	 	//retorno do blog pra variavel
		$blogarray = $blog->lista();
	 	$noticias = $blogarray['noticias'];
	 	
		foreach ($noticias as $key => $value) {

			$endereco = $value['endereco'];

			echo '
			<url>
				<loc>'.$endereco.'</loc>
				<lastmod>'.$hoje.'</lastmod>
				<priority>1.0</priority>
				<changefreq>monthly</changefreq>
			</url>
			';
		}

		
	echo '
	</urlset>
	';


	}
	
	
}
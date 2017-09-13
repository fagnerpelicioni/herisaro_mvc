<?php require_once('_system/bloqueia_view.php'); ?>
<style type="text/css">
.header{
	background-color: <?=$_base['cor']['55']?>;
}
.content {
	background: <?=$_base['cor']['60']?>;
}
.top-nav li.active> a, .top-nav li> a:hover {
	background: <?=$_base['cor']['56']?>;
	color: <?=$_base['cor']['57']?>;
}
.logo {
	padding-top: 20px;
	width: 300px;
}
.logo img {
	width: 100%;
}
.top-nav ul li a {
    padding: 40px 15px;
    color: <?=$_base['cor']['58']?>;
}
.botaomenuresponsivo {
	display: none;
	float: right;
	margin-top: 25px;
	margin-bottom: 25px;
	padding-left: 10px;
	padding-right: 10px;
	cursor: pointer;
	font-size: 20px;
	color:<?=$_base['cor']['58']?>;
}
@media only screen and (max-width: 1200px) {
	.logo {
		padding-top: 25px;
		width: 220px;
	}
	.top-nav ul li a {
	    padding: 40px 11px;
	}
}
@media only screen and (max-width: 1050px) {
	.logo {
		padding-top: 20px;
		width: 160px;
	}
	.top-nav ul li a {
	    padding: 30px 8px;
	}
	.top-nav ul li a {
		font-size: 11px;
	}
}
@media only screen and (max-width: 840px) {
	.logo {
		padding-top: 23px;
		width: 140px;
	}
	.top-nav ul li a {
		font-size: 10px;
	}
}
@media only screen and (max-width: 770px) {
	.botaomenuresponsivo {
		display: inline-block;
	}
	.logo {
		padding-top: 20px;
		width: 170px;
	}	
	.top-nav{
		display: none;
		border-top:1px solid rgba(255,255,255,0.2);
	}
	.top-nav ul li {
		width: 100%;
		text-align: center;
	}
	.top-nav ul li a {
	    padding: 15px 15px;
}
	.top-nav ul li a {
		font-size: 13px;
	}
}


.footer {
    background: <?=$_base['cor']['63']?>;
    padding-top: 0px;
    padding-bottom: 50px;
}
.copy-right p {
    font-size: 14px;
    color: <?=$_base['cor']['67']?>;
}
.copy-right{
	background: <?=$_base['cor']['66']?>;
}
.footer-grid {
	padding-top: 50px;
    float: none;
    width: 100%;
}
.footer-grid ul li a {
	color: <?=$_base['cor']['65']?>;
}
.footer-grid ul li a:hover {
	color: <?=$_base['cor']['65']?>;
}
.footer-grid p {
	font-size: 16px;
	color: rgba(255, 255, 255, 0.80);
}
.footer-grid h3 {
	color: <?=$_base['cor']['64']?>;
}
.footer-grid ul li a {
    padding-bottom:7px;
    margin-bottom:7px;
    padding-top: 0px;
    font-size: 15px;
}
.rodape_facebook{
	width: 100%;
	overflow: hidden;
}



.titulos {    
    text-transform: uppercase;
    color: <?=$_base['cor']['59']?>;
    text-shadow: 0 1px 0 #ffffff;
    margin-top: 20px;
    margin-bottom: 20px;
    font-family: 'Open Sans', sans-serif;
    letter-spacing: 10px;
    font-size: 26px;
}
.texto_inicial {
    font-size: 0.8725em;
    color: #555555;
    line-height: 1.8em;
    font-family: 'Open Sans', sans-serif;
}


.noticias_caixa_inicial{
	padding-top:20px;
	padding-left:20px;
	padding-right:20px;
	padding-bottom:20px;
	margin-top:40px;
	height: auto;

}
.noticias_caixa_inicial:hover{
	background: rgba(255,255,255,0.3);
}
.noticia_titulo_inicial {
	padding-bottom:10px;
}
.noticia_inicial_imagem{
	margin-bottom:20px;
	width: 100%;
	height:150px;
	background-repeat: no-repeat;
	background-position: center;
	background-size: cover;
	cursor: pointer;
}
.noticia_inicial_imagem:hover{
 
}
a.noticia_inicial_titulo_ajuste{
	font-size: 18px !important;
}
.blog_lista_previa{
	font-size: 14px;
}

.botao_padrao {
    font-family: 'Open Sans', sans-serif;
	text-align: center;
    height: auto;
    padding-top: 8px;
    padding-bottom: 8px;
    padding-left: 20px;
    padding-right: 20px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    display: inline-block;
    border-radius: 0px;
    background-color: <?=$_base['cor']['61']?>;
    color: <?=$_base['cor']['62']?>;
}
.botao_padrao:hover{
	background: #289cd8;
	color:#fff;
}
.content{
	padding-top:60px;
	padding-bottom: 120px;
}
@media only screen and (max-width: 770px) {
	.noticias_caixa_inicial{
		min-height:none;
		height: auto;
	}	 
}





 
.imagem_quemsomos {
	width: 100%;
	padding-top:10px;
	padding-bottom:20px;
}
.texto_valores{
	font-size: 0.8725em;
    color: #555555;
    line-height: 1.8em;
    font-family: 'Open Sans', sans-serif;
}
.texto_valores li{
	list-style: initial;
 	list-style-type: circle;
 	margin-left: 20px;
}
.quemsomos_linha{
	padding-left:10px;
	margin-left: 10px;
	border-left: 1px solid #bbb;
	height: 300px;
	display: inline-block;
}
@media only screen and (max-width: 990px) {

	.quemsomos_linha{
		height: 30px;
		border-left: none;
	}
	.imagem_quemsomos {
		padding-top:30px;
	}
	.content2{
		padding-top:0px;
		padding-bottom: 90px;
	}

}


.mapa{
	width: 100%;
}
@media only screen and (max-width: 500px) {
	.botaocontatogambia{
		width:100%;
	}
}
label{
	margin-bottom:3px;
	font-family: 'Open Sans', sans-serif;
	font-size:14px;
}
.form-control{
	font-family: 'Open Sans', sans-serif;
	font-size:14px;
}
.form-group{
	margin-bottom:12px;
}


.caixa_pergunta{
	padding: 20px;
	width: 100%;
	font-family: 'Open Sans', sans-serif;
}
.pergunta{
	font-size: 16px;
	font-weight: bold;
	color:#000;
}
.resposta{
	font-size: 16px;
	color:#666;
	padding-top: 5px;
}



/* start cauresol */
.nbs-flexisel-container {
	padding:4% 0;
	position: relative;
	max-width: 100%;
}
.nbs-flexisel-ul {
	position: relative;
	width: 9999px;
	margin: 0px;
	padding: 0px;
	list-style-type: none;
	text-align: center;
}
.nbs-flexisel-inner {
	overflow: hidden;
	width:90%;
	margin: 0 auto;
}
.nbs-flexisel-item {
	float: left;
	margin: 0px;
	padding: 0px;
	cursor: pointer;
	position: relative;
	line-height: 0px;
}
.nbs-flexisel-item > img {
	width:200px;
	height:100px;
	cursor: pointer;
	position: relative;
	margin-top: 10px;
	margin-bottom: 10px;
	max-width: 100px;
	max-height: 45px;
}
/*** start cauresol  navigation ***/
.nbs-flexisel-nav-left, .nbs-flexisel-nav-right {
	width: 46px;
	height: 100px;
	position: absolute;
	cursor: pointer;
	z-index: 100;
}
.nbs-flexisel-nav-left {
	left: 0px;
	background: url(../images/img-sprite.png) no-repeat -19px -21px;
}
.nbs-flexisel-nav-right {
	right: 0px;
	background: url(../images/img-sprite.png) no-repeat -55px -20px;
}
</style>
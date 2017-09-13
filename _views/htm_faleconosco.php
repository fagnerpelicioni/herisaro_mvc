<?php require_once('_system/bloqueia_view.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Fale Conosco - <?=$_base['titulo_pagina']?></title>
	<link rel="shortcut icon" href="<?=$_base['favicon'];?>">

	<meta name="description" content="Fale Conosco - <?=$_base['descricao']?>" />
	<meta property="og:description" content="<?=$_base['descricao']?>">
	<meta name="author" content="Fagner Pelicioni">
	<meta name="classification" content="Website" />
	<meta name="robots" content="index, follow">
	<meta name="Indentifier-URL" content="<?=DOMINIO?>" />
	
	<link rel="stylesheet" href="<?=LAYOUT?>api/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/font-awesome-4.6.2/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/hover-master/css/hover-min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=LAYOUT?>api/bootstrap-fileupload/bootstrap-fileupload.min.css" />

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

			<div class="row" >
				


				<div class="col-md-6">
					
					<div style="padding-top:60px;">
                                            <div class="titulos" style="color: #c2c2c2;">ONDE ESTAMOS</div>
						<div class="mapa"><?=$mapa?></div>
					</div>
				</div>

				<div class="col-md-6">

					<div style="padding-top:60px; padding-bottom:120px;"  >

						<div class="titulos">ENTRE EM CONTATO</div> 

	                    <div>
						<form action="<?=DOMINIO?>faleconosco/enviar" method="post" id="formcontato" name="formcontato" enctype="multipart/form-data"  >

							<div class="form-group">
								<label for="destino">Assunto</label>
								<select class="form-control" style="border-radius:0px;" name="destino" >
								<?php

									foreach ($destinos as $key => $value) {
										echo "<option value='".$value['email']."'>".$value['titulo']."</option>";
									}

								?>
								</select>
		                    </div>

							<div class="form-group">
								<label for="name">Nome</label>
								<input type="text" class="form-control" style="border-radius:0px;" id="name" name="nome" placeholder="Digite seu nome" required="required" />
		                    </div>
		                    
		                    <div class="form-group" >
								<label for="email">E-mail</label>
								<div class="input-group">
									<span class="input-group-addon" style="border-radius:0px;"><span class="glyphicon glyphicon-envelope"></span></span>
									<input type="email" class="form-control" style="border-radius:0px;" id="email" name="email" placeholder="Digite seu e-mail" required="required" />
								</div>
							</div>
							
							<div class="form-group">
		                    	<label for="fone">Telefone</label>
		                        <div class="input-group">
		                        	<span class="input-group-addon" style="border-radius:0px;"><span class="glyphicon glyphicon-phone"></span></span>
		                            <input type="text" class="form-control" style="border-radius:0px;" id="fone" name="fone" placeholder="Digite seu Telefone" required="required" />
		                        </div>
		                    </div>
		                    
		                    <div class="form-group">
		                    	<label for="mensagem">Mensagem</label>
		                        <textarea name="msg" id="message" class="form-control" cols="25" required placeholder="Escreva sua Mensagem..." style="height:80px; text-align: left; border-radius:0px;"></textarea>
		                    </div>

		                    <div class="row">

		                    	<div class="col-xs-9 col-sm-9 col-md-9 botaocontatogambia" >
		                    		<div class="form-group">
					        			<label for="anexo" >Anexar Arquivo</label>
					                    <div class="fileupload fileupload-new" data-provides="fileupload">
					                        <div class="input-append">
					                          <div class="uneditable-input">
					                            <i class="fa fa-file fileupload-exists"></i>
					                            <span class="fileupload-preview"></span>
					                          </div>
					                          <span class="btn btn-default btn-file">
					                          <span class="fileupload-exists">Alterar</span>
					                          <span class="fileupload-new">Procurar arquivo</span>
					                            <input type="file" name="arquivo" />
					                          </span>
					                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
					                        </div>
					                    </div>					         
					        		</div>
		                		</div>

		                		<div class="col-xs-3 col-sm-3 col-md-3 botaocontatogambia" >
					                <div style="text-align:right; padding-top:17px;" >
					                	<div class="botao_padrao hvr-float-shadow" onClick="formcontato.submit();" >ENVIAR</div>
									</div>
								</div>

							</div>

						</form>
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
<script src="<?=LAYOUT?>api/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
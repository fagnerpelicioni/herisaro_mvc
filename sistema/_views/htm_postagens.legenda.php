<?php require_once('_system/bloqueia_view.php'); ?>
<form action="<?=$_base['objeto']?>legenda_grv" method="post" >

<div>
	<input name="legenda" type="text" class="form-control" value="<?=$legenda?>" >
</div>

<div style="padding-top:15px;">
	<button type="submit" class="btn btn-primary">Salvar</button>
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="codigo" value="<?=$codigo?>">
</div>

</form>
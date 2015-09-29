<?php use micro\js\Jquery; 
$date = date("d-m-Y");
$heure = date("H:i");
?>
<form method="post" action="faqs/update">
	<fieldset>
		<legend>Ajouter</legend>
		<input name="id" type="hidden">
		<div class="form-group">
			<label>titre</label>
			<input name="titre" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label>contenu</label>
			<?php echo "<textarea name='contenu' id='editor1'>Ecrivez votre article...</textarea>";
			echo Jquery::execute("CKEDITOR.replace( 'editor1');");?>
		</div>
		<div class="form-group">
			<label>date de creation</label>
			<input name="dateCreation" type="text" class="form-control" value="<?=$date." ".$heure?>" disabled>
		</div>
		<div class="form-group">
			<label>categorie</label>
			<select class="form-control" name="idCategorie">
				<?php echo $listCat;?>
			</select>
		</div>
		<div class="form-group">
			<label>auteur</label>
			<input name="auteur" type="text" class="form-control" value="<?=$_SESSION["user"]?>" disabled>
		</div>
		<div class="form-group">
			<label>version</label>
			<input name="version" type="text" class="form-control" value="1.0" disabled>
		</div>
		<div class="form-group">
			<label>popularity</label>
			<input name="popularity" type="text" class="form-control" value="0" disabled>
		</div>
		<div class="form-group">
			<input type="submit" value="Valider" class="btn btn-default">
			<a class="btn btn-default" href="faqs">Annuler</a>
		</div>
	</fieldset>
</form>

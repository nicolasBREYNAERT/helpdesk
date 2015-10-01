<?php use micro\js\Jquery; ?>
<form method="post" action="faqs/update">
	<fieldset>
		<legend>Modifier</legend>
		<input name="id" type="hidden" value="<?=$id?>">
		<input name="suspendre" type="hidden" value="<?=$suspendre?>">
		<div class="form-group">
			<label>titre</label>
			<input name="titre" type="text" class="form-control" value="<?=$titre?>">
		</div>
		<div class="form-group">
			<label>contenu</label>
			<?php echo "<textarea name='contenu' id='editor1'>".$contenu."</textarea>";
			echo Jquery::execute("CKEDITOR.replace( 'editor1');");?>
		</div>
		<div class="form-group">
			<label>date de creation</label>
			<input name="dateCreation" type="text" class="form-control" value="<?=$dateCreation?>" disabled>
		</div>
		<div class="form-group">
			<label>categorie</label>
			<select class="form-control" name="idCategorie">
				<?php echo $listCat;?>
			</select>
		</div>
		<div class="form-group">
			<label>auteur</label>
			<input name="auteur" type="text" class="form-control" value="<?=$user?>" disabled>
		</div>
		<div class="form-group">
			<label>version</label>
			<input name="version" type="text" class="form-control" value="<?=$version?>">
		</div>
		<div class="form-group">
			<label>popularity</label>
			<input name="popularity" type="text" class="form-control" value="<?=$popularity?>" disabled>
		</div>
		
		<div class="form-group">
			<input type="submit" value="Modifier" class="btn btn-default">
			<a class="btn btn-default" href="faqs">Annuler</a>
		</div>
	</fieldset>
</form>

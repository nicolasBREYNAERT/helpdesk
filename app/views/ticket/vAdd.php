<form method="post" action="tickets/update">
<fieldset>
<legend>Ajouter</legend>
	<div class="form-group">
		<input type="submit" value="Valider" class="btn btn-default">
		<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
	</div>
<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
<div class="form-group">
	<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
	<input type="hidden" name="affectation" value=NULL>
	<label for="type">Type</label>
	<select class="form-control type" name="type">
	<?php echo $listType;?>
	</select>
	<label for="idCategorie">Catégorie</label>
	<select class="form-control categorie" name="idCategorie">
	<?php echo $listCat;?>
	</select>
	<label for="titre">Titre</label>
	<input class="titre" type="text" name="titre" id="titre" value="<?php echo $ticket->getTitre()?>" placeholder="Entrez le titre" class="form-control">
	<label for="description">Description</label>
	<textarea name="description" id="description" placeholder="Entrez la description" class="form-control"><?php echo $ticket->getDescription()?></textarea>
</div>
<div class="form-group">
	<label for="statut">Statut</label>
	<select id="idStatut" class="form-control" name="idStatut">
	<?php echo $listStatut;?>
	</select>
	<label>Emetteur</label>
	<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
	<label for="dateCreation">Date de création</label>
	<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
	<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default valid">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
</fieldset>
</form>

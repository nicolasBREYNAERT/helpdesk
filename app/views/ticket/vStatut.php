<form method="post" action="tickets/updateStatut">
<fieldset>
<legend>Modifier le Statut</legend>
	<div class="form-group">
		<input type="submit" value="Valider" class="btn btn-default">
		<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
	</div>
<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
<div class="form-group">
	<label for="titre">Titre</label>
	<input type="text" name="titre" id="titre" disabled value="<?php echo $ticket->getTitre()?>" placeholder="Entrez le titre" class="form-control">
	<label for="description">Description</label>
	<input type="description" name="description" id="description" disabled value="<?php echo $ticket->getDescription()?>" placeholder="Entrez la description" class="form-control">
</div>
<div class="form-group">
	<label for="statut">Statut</label>
	<?php foreach ()?>
	<input type="radio" id="idStatut" class="form-control" name="idStatut" name="Genre" value="<?php echo $listStatut;?>"> <?php echo $listStatut;?>
	<label>Emetteur</label>
	<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
	<label for="dateCreation">Date de création</label>
	<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
	<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
</fieldset>
</form>

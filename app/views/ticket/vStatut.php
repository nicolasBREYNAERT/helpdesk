<form method="post" action="tickets/update">
<fieldset>
<legend>Modifier le Statut</legend>
	<div class="form-group">
		<input type="submit" value="Valider" class="btn btn-default">
		<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
	</div>
<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
<div class="form-group">
	<label for="statut">Statut</label></br>
	<?php foreach ($listStatut as $lStatut){
		$disabled="";
		if($lStatut->getOrdre()<=$ticket->getStatut()->getOrdre())
			$disabled="disabled";
		echo "<input type='radio' ".$disabled." class='rStatut' id='idStatut'".$lStatut->getId()."' name='idStatut' value=".$lStatut->getId()."><label class='control-label' ".$disabled." for='idStatut".$lStatut->getId()."'>&nbsp;".$lStatut."</label></br>";
	}?>
	<label>Emetteur</label>
	<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
	<label for="dateCreation">Date de création</label>
	<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
	<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
	<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
	<input type="hidden" name="idCategorie" value="<?php echo $ticket->getCategorie()->getId()?>">
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default valid">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
</fieldset>
</form>

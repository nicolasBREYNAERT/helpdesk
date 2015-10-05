<?php use micro\orm\DAO;?>
<form method="post" action="tickets/update">
<fieldset>
<legend>Messages</legend>
	<div class="form-group">
		<input type="submit" value="Valider" class="btn btn-default">
		<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
	</div>
<div class="alert alert-info">Ticket : <?php echo $ticket->toString()?></div>
<div class="form-group">
	<label for="statut">Statut</label></br>
	<div class="form-control" disabled><?php echo $ticket->getStatut()?></div>
	<label>Emetteur</label>
	<div class="form-control" disabled><?php echo $ticket->getUser()?></div>
	<label for="dateCreation">Date de création</label>
	<input type="text" name="dateCreation" id="dateCreation" value="<?php echo $ticket->getDateCreation()?>" disabled class="form-control">
	<input type="hidden" name="id" value="<?php echo $ticket->getId()?>">
	<input type="hidden" name="idUser" value="<?php echo $ticket->getUser()->getId()?>">
	<input type="hidden" name="idCategorie" value="<?php echo $ticket->getCategorie()->getId()?>">
</div>
<div class="form-group">
	<label>Conversation</label>
	<?php foreach ($messages as $mess){
		echo "<div class='' disabled>".$mess->getContenu()."</div><HR>";
	}?>
	<label>Nouveau message</label>
	<textarea name="message" id="message" placeholder="Entrez le message" class="form-control"><?php echo $ticket->getDescription()?></textarea>
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default">
	<a class="btn btn-default" href="<?php echo $config["siteUrl"]?>tickets">Annuler</a>
</div>
</fieldset>
</form>
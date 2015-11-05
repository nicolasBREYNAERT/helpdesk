<legend>Nouveaux tickets</legend>
<table class='table table-striped'>
<tbody>
<?php 
$icon="flag";
foreach ($listNouveaux as $t){
	echo "<tr>";
	echo "<td id='".$t->getTitre()."' class='listTickets' name='".$t->getStatut()."'><b>".$t->getTitre()."</b> - ".$t->getUser()." - <span class='glyphicon glyphicon-".$icon."' aria-hidden='true'></span>&nbsp;".$t->getStatut();
	echo "<form method='post' action='Tickets/update'>";
	echo "<input name='id' type='hidden' value='".$t->getId()."'>";
	echo "<input name='idCategorie' type='hidden' value='".$t->getCategorie()->getId()."'>";
	echo "<input name='idStatut' type='hidden' value='".$t->getStatut()->getId()."'>";
	echo "<input name='idUser' type='hidden' value='".$t->getUser()->getId()."'>";
	echo "
			<select class='form-control' name='idAffectation'>";
	echo $listTechnicien;
	echo "</select>";
	echo "<input type='submit' class='btn btn-default valid'>";
	echo "</form>		
		</td>";
	//echo "<td class='td-center'><a name='".$t->getTitre()."' class='btn btn-primary btn-xs' href='tickets/update/".$t->getId()."'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></a></td>";
	echo "<td class='td-center'><a name='".$t->getTitre()."' class='btn btn-warning btn-xs delete' href='tickets/delete/".$t->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
	echo "</tr>";
}
?>
</tbody>
</table>
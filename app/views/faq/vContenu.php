<?php $a=$faqs->getId();
$a=$a-1;
$b=$faqs->getId();
$b=$b+1;?>
<div class="container">
	<div class="table">
		<table>
			<tr><td colspan="2"><a class="btn btn-primary" href=<?php echo "faqs/contenu/".$a?>>Precedent</a>&nbsp;<a class="btn btn-primary" href=<?php echo "faqs/contenu/".$b?>>Suivant</a><td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2" class="bg-info"><h2><?=$title?></h2><td></tr>
			<tr><td colspan="2"><p class="bs-example"><div class='text-justify'><?=$contenu?></div></p><br/><td></tr>
			<tr><td class="bg-info"><b>auteur : <?=$user?></b></td><td class="bg-info"><b>Date de creation : <?=$dateCreation?></b><td></tr>
			<tr><td class="bg-info"><b>version : <?=$version?></b></td><td class="bg-info"><b>Nombre de vues : <?=$a?></b><td></tr>
		</table>
	</div>
</div>
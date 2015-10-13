<?php 
use micro\orm\DAO;
$faqs=DAO::getAll("Faq","1=1 order by idCategorie limit 10");?>
<div class="container">
	<h2>Classe par categorie</h2>	
	<table class="table table-striped">
	<?php foreach($faqs as $c){?>
		<?php 
		echo "<thead><tr><th><h3><i>".$c->getCategorie()."</i></h3></th></tr></thead>";
		$tpx=$c->getCategorie();
		foreach($faqs as $f){
			$x=$f->getSuspendre();
			if($f->getCategorie()==$tpx && $x==0){
				$test=$f->getTitre();
				echo "<tr><td class='carticle'><a class='' href='faqs/contenu/".$f->getId()."'>".$test."<br></a></td></tr>";
	}}}?>
	</table>
</div>
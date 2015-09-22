<div class="container">
	<h2>Classe par categorie</h2>	
	<table class="table table-striped">
	<?php foreach($faqs as $c){?>
		<?="<thead><tr><th><h3><i>".$c->getCategorie()."</i></h3></th></tr></thead>";
		$tpx=$c->getCategorie();
		foreach($faqs as $f){
			if($f->getCategorie()==$tpx){
				$test=$f->getTitre();
				echo "<tr><td><a class='' href='faqs/contenu/".$f->getId()."'>".$test."<br></a></td></tr>";
			}}}?>
	</table>
</div>
<div class="container">
	<h2>Classe par categorie</h2>
	
	<table class="table table-striped">
	<?php foreach($faqs as $c){?>
		<?="<thead><tr><th><h3>".$c->getCategorie()."</h3></th></tr></thead>"?>
		<?php 
		foreach($faqs as $f){
			echo "<tr><td><a class='' href='../'>".$f->getTitre()."<br></a></td></tr>";
		}?>
		<?php }?>
	</table>
	
</div>
<div class="container">
<table class="table table-striped">
		<?="<thead><tr><th><h2>".$title."</h2></th></tr></thead>"?>
		<?php 
		foreach($faqs as $f){
			if($f->getSuspendre()==0){
				echo "<tr><td class='farticle'><a class='' href='faqs/contenu/".$f->getId()."'>".$f->getTitre()."<br></a></td></tr>";
			}}?>
	</table>
</div>
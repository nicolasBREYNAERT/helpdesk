<div class="container">
	<?php foreach($faqs as $c){?>
	<table class="table table-striped">
		<?="<thead><tr><th><h2>".$c."</h2></th></tr></thead>"?>
		<?php 
		foreach($faqs as $f){
			echo "<tr><td><a class='' href='../'>".$f->getTitre()."<br></a></td></tr>";
		}?>
	</table>
</div>

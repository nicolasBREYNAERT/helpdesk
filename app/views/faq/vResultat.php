<div class="container">
	<div class="list">
		<form method="post" action="faqs/">
			<input type="textarea" name="recherche" value="votre recherche...">
			<input type="submit" name="rechercher" value="rechercher">
		</form>
	</div>
<?php 
if($faqs==NULL){
	echo "<h5>Aucun resultat ne correspond a votre recherche.</h5>";
}else{
?>
	<table class="table table-striped">
		<?="<thead><tr><th><h2>".$title."</h2></th></tr></thead>"?>
		<?php 
		foreach($faqs as $f){
			echo "<tr><td><a class='' href='faqs/contenu/".$f->getId()."'>".$f->getTitre()."<br></a></td></tr>";
		}}?>
	</table>
</div>

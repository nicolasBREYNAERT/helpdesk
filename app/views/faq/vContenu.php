<?php
use micro\orm\DAO;
//le premier
$faqMin=DAO::getOne("Faq","1=1 limit 1");
$min=$faqMin->getId();
//le dernier
$faqMax=DAO::getOne("Faq","1=1 order by id DESC limit 1");
$max=$faqMax->getId();
$c=$faqs->getId();
if($c<=$min){
	$a=$c;
}else{
	$faqPre=DAO::getAll("Faq"," id<$c order by id DESC limit 1");
	$a=$faqPre[0]->getId();
	
}
if($c>=$max){
	$b=$c;
}else{
	$faqSui=DAO::getAll("Faq","id>$c limit 1");
	$b=$faqSui[0]->getId();
}
?>
<div class="container">
	<div class="table">
		<table>
			<tr><td colspan="2"><a class="btn btn-primary" href=<?php echo "faqs/contenu/".$a?>>Precedent</a>&nbsp;<a class="btn btn-primary" href=<?php echo "faqs/contenu/".$b?>>Suivant</a><td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2" class="bg-info"><h2><?=$title?></h2><td></tr>
			<tr><td colspan="2"><p class="bs-example"><div class='text-justify'><?php 
			if($suspendu==1){echo "<h2><center>article suspendu</center></h2>";}
			else{echo $contenu;}
			?></div></p><br/><td></tr>
			<tr><td class="bg-info"><b>auteur : <?=$user?></b></td><td class="bg-info"><b>Date de creation : <?=$dateCreation?></b><td></tr>
			<tr><td class="bg-info"><b>version : <?=$version?></b></td><td class="bg-info"><b>Nombre de vues : <?=$a?></b><td></tr>
		</table>
	</div>
</div>

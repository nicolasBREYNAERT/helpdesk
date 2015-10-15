<?php
class SeleniumTest extends AjaxUnitTest{
	/*public function testIndex(){
		$this->get("DefaultC/index");
		self::$webDriver->manage()->timeouts()->implicitlyWait(5);
		$this->assertPageContainsText("HelpDesk");
		$bt=$this->getElementBySelector(".btn-default");
		$this->assertEquals("", $bt->getText());
		
		$btsDefault=$this->getElementsBySelector(".btn-default");
		foreach ($btsDefault as $bt){
			if($bt->getAttribute("value")=="connexion"){
				$bt->click();
				$this->waitFor();
				$doIt=true;
				$this->assertPageContainsText("HelpDesk");
				break;
			}
		}
		$this->assertTrue($doIt);
		//$this->getElementById("")->sendKeys($value);
		$champs=$this->getElementsBySelector(".form-control");
		foreach ($champs as $chp){
			if($chp->getAttribute("name")=="login"){
				$chp->sendKeys("admin");
			}
			if($chp->getAttribute("name")=="password"){
				$chp->sendKeys("admin");
			}
		}
		$btnConnexion=$this->getElementsBySelector(".btn-default");
		foreach ($btnConnexion as $bt){
			if($bt->getAttribute("value")=="connexion"){
				$bt->click();
				$this->waitFor();
				$this->assertPageContainsText("admin");
				$this->assertPageContainsText("Information/modification du compte");
				break;
			}
		}
	}*/
	/*public function testTicketUser(){
	}

	}

	public function testTicketUser(){
		//se logger
		$this->get("DefaultC/asUser");
		$this->waitFor(5);
		//acc�s a la page
		$this->get("tickets/index");
		$this->waitFor(5);
		
		$tr=$this->getElementsBySelector(".ticket");
		$this->assertEquals(6, count($tr));
		
	}*/
	//ON EFFECTUERA LE TEST SUR LE TICKET QU ON VA CREER
	public function testCretaionTicket(){
		//se logger
		$this->get("DefaultC/asAdmin");
		$this->waitFor(5);
		//acc�s a la page
		$this->get("tickets/index");
		$this->waitFor(5);
		
		//compter les tickets
		$tr=$this->getElementsBySelector(".listTickets");
		$nbTickets=count($tr);
		
		//Nouveau ticket
		$ajouter=$this->getElementBySelector(".ajout");
		$ajouter->click();
		$this->waitFor(5);
		
		//Formulaire
		$elements=$this->getElementsBySelector(".element");
		foreach($elements as $element){
			if($element->getAttribute("id")=="element1"){
				$element->click();
			}
		}
		$titre=$this->getElementBySelector(".titre");
		$titre->sendKeys("TEST");
		$this->waitFor(5);
		
		//Valider
		$valider=$this->getElementBySelector(".valid");
		$valider->click();
		$this->waitFor(5);
		
		//Compter les tickets
		$newTr=$this->getElementsBySelector(".listTickets");
		$nbNewTickets=count($newTr);
		
		//Test
		$this->assertEquals($nbTickets+1,$nbNewTickets);		
		$this->waitFor(5);
		
	}	
	public function testModifStatut(){
		//On change le statut de l'élément récement créé
		//On recupere son statut
		$statuts=$this->getElementsBySelector(".statut");
		foreach($statuts as $statutQ){
			if($statutQ->getAttribute("id")=="TEST"){
				$statut=$statutQ;
			}
		}		
		//On clique sur le bouton statut 
		$statut->click();
		$this->waitFor(5);
		
		//Sélection du dernier statut
		$rStatut=$this->getElementsBySelector(".rStatut");
		foreach($rStatut as $radio){
			//On clique sur le bouton statut
			$radio->click();
			$this->waitFor(5);
			
		}
		//Valider
		$valider=$this->getElementBySelector(".valid");
		$valider->click();
		$this->waitFor(5);
		//Récupère les statuts
		$newStatuts=$this->getElementsBySelector(".statut");
		foreach($newStatuts as $newStatutQ){
			if($newStatutQ->getAttribute("id")=="TEST"){
				$newStatut=$newStatutQ;
			}
		}
		$nameStatut=$newStatut->getAttribute("name");
		$this->assertEquals("Clos",$nameStatut);
	}
	public function testSupressionTicket(){
		$btnSupp=$this->getElementsBySelector(".delete");
		//Compter les tickets
		$tr=$this->getElementsBySelector(".listTickets");
		$nbTickets=count($tr);
		
		foreach($btnSupp as $supp){
			if($supp->getAttribute("name")=="TEST"){
				//On clique sur le bouton statut
				$supp->click();
				$this->waitFor(5);
			}
		}
		//Recompter les tickets
		$newTr=$this->getElementsBySelector(".listTickets");
		$nbNewTickets=count($newTr);
		//TEST
		$this->assertEquals($nbTickets-1,$nbNewTickets);
		$this->waitFor(5);
	}
	
	public function testNouveauxTickets(){
		$nbNouveau=$this->getElementBySelector(".nbNouveau");
		$affichage=$nbNouveau->getAttribute("name");
		
		//Nombre de nouveaux tickets 
		$tr=$this->getElementsBySelector(".listTickets");
		$nouveau=0;
		foreach($tr as $ticket){
			if($ticket->getAttribute("name")=="Nouveau"){
				$nouveau=$nouveau+1;
			}	
		}
		//TEST
		$this->assertEquals($affichage,$nouveau);
		$this->waitFor(5);
	}
	
	public function testDeconnexionOne(){
		$btnAcc=$this->getElementBySelector(".accueil");
		$btnAcc->click();
		$this->waitFor(5);
		$btnDeco=$this->getElementBySelector(".deconnexion");
		$btnDeco->click();
		$this->waitFor(5);
		$this->assertPageContainsText("Connection");
	}
	
	public function testCreationArticle(){
		//se logger
		$this->get("DefaultC/asAdmin");
		$this->waitFor(5);
		//acc�s � la page
		$this->get("Faqs/index");
		$this->waitFor(5);
		//on compte
		$articles=$this->getElementsBySelector(".article");
		$nbArticles=count($articles);
		//clique sur le bouton ecrire un article
		$btn=$this->getElementBySelector(".ecrire");
		$btn->click();
		//creation dun article vierge
		$titre=$this->getElementBySelector(".titre");
		$titre->sendKeys("test");
		$this->waitFor(5);
		$btn2=$this->getElementBySelector(".valider");
		$btn2->click();
		$this->waitFor(5);
		//on compte
		$articlesNew=$this->getElementsBySelector(".article");
		$nbArticlesNew=count($articlesNew);
		$this->assertEquals($nbArticles+1, $nbArticlesNew);
	}
	public function testDeconnexion(){
		$btnAcc=$this->getElementBySelector(".accueil");
		$btnAcc->click();
		$this->waitFor(5);
		$btnDeco=$this->getElementBySelector(".deconnexion");
		$btnDeco->click();
		$this->waitFor(5);
		$this->assertPageContainsText("Connection");
	}
	public function testRecherche(){
		//se logger
		$this->get("DefaultC/asAdmin");
		$this->waitFor(5);
		//acc�s � la page
		$this->get("Faqs/index");
		$this->waitFor(5);
		//acc�der au champ de recherche
		$texteRecherche=$this->getElementBySelector(".recherche");
		//y ins�rer une valeur de test
		$texteRecherche->sendKeys("test");
		//chercher le bouton rechercher
		$btnRechercher=$this->getElementBySelector(".btnRechercher");
		$btnRechercher->click();
		$this->waitFor(5);
		//on v�rifie la pr�sence de l'article
		$this->assertPageContainsText("test");
		$this->waitFor(5);
	}
	public function testAccederArticle(){
		//selection de l'�l�ment test
		$access=$this->getElementsBySelector(".titreArticle");
		foreach($access as $acc){
			if($acc->getAttribute("name")=="test"){
				$clickAcc=$acc;
			}
		}
		$clickAcc->click();
		$this->waitFor(5);
		$this->assertNotNull($this->getElementBySelector(".precedent"));
		$this->assertNotNull($this->getElementBySelector(".suivant"));
		//on retourne a la page des article
		$this->get("Faqs/index");
		$this->waitFor(5);
	}
	public function testSuppressionArticle(){
		$articles=$this->getElementsBySelector(".article");
		$nbArticles=count($articles);
		$btnSuppression=$this->getElementsBySelector(".suppression");
		foreach($btnSuppression as $sup){
			if($sup->getAttribute("name")=="test"){
				$sup->click();
			}
		}
		$articlesNew=$this->getElementsBySelector(".article");
		$nbArticlesNew=count($articlesNew);
		$this->assertEquals($nbArticles-1, $nbArticlesNew);
	}
	public function testFaqAdmin(){
		//on verifie qu'on affiche tous les article de la bdd dans la premiere liste
		$articles=$this->getElementsBySelector(".article");
		$this->assertEquals(4, count($articles));
		//on recup�re les btn suspendre
		$suspendre=$this->getElementBySelector(".suspendre");
		$suspendre->click();
		$this->waitFor(5);
		$populaireArticles=$this->getElementsBySelector(".particle");
		$this->assertEquals(3, count($populaireArticles));
		$activer=$this->getElementBySelector(".activer");
		$activer->click();
		$this->waitFor(5);
	}
	
}
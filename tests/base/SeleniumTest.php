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
	
	
	
}
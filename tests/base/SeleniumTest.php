<?php
class SeleniumTest extends AjaxUnitTest{
	public function testIndex(){
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
		
	}
	
	
	
}
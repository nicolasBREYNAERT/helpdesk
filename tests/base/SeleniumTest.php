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
	}
}
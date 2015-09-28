<?php
use micro\orm\DAO;
/**
 * Gestion des articles de la Faq
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Faqs extends \_DefaultController {
	public function Faqs(){
		parent::__construct();
		$this->title="Foire aux questions";
		$this->model="Faq";
	}

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
	}

	public function test(){
		$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 1,1");
		foreach ($faqs as $faq){
			echo $faq."<br>";
		}
		echo DAO::$db->query("SELECT max(id) FROM Faq")->fetchColumn();
		$ArticleMax=DAO::getOne("Faq","id=(SELECT max(id) FROM Faq)");
		echo $ArticleMax;
	}

	public function contenu($id){
		$a=$this->getInstance($id[0]);
		//ajout d'un de popularit�
		$popularity=$a->getPopularity();
		$popularity=$popularity + 1;
		$a->setPopularity($popularity);
		//mettre � jour a dans la base
		DAO::update($a);
		$test=$a->getPopularity();
		//chargement de la vue
		$contenu=$a->getContenu();
		$titre=$a->getTitre();
		$user=$a->getUser();
		$version=$a->getVersion();
		$dateCreation=$a->getDateCreation();
		$this->loadView("faq/vContenu",array("faqs"=>$a,"title"=>$titre,"contenu"=>$contenu,"a"=>$test,"user"=>$user,"version"=>$version,"dateCreation"=>$dateCreation));
	}

	public function index(){
		//sujet les plus populaire
		$faqs=DAO::getAll("Faq","1=1 order by popularity limit 10");
		$this->loadView("faq/vPopulaire",array("faqs"=>$faqs,"title"=>"Sujets les plus populaires"));
		//sujet les plus r�cents
		$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 10");
		$this->loadView("faq/vFaqs",array("faqs"=>$faqs,"title"=>"Sujets les plus recents"));
		//sujet par cat�gorie
		$faqs=DAO::getAll("Faq","1=1 order by idCategorie limit 10");
		$this->loadView("faq/vCate",array("faqs"=>$faqs));

		//$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 1,10");
		//foreach ($faqs as $faq){
		//	echo $faq."<br>";
		//}
		
		//echo DAO::$db->query("SELECT max(id) FROM Faq")->fetchColumn();
		//$ArticleMax=DAO::getOne("Faq","id=(SELECT max(id) FROM Faq)");
		//echo $ArticleMax;
		}
	/* (non-PHPdoc)
	 * @see BaseController::isValid()
	 */
	public function isAdmin(){
		$a=$_SESSION["admin"];
		return $a;
	}
	
	public function isValid() {
		return Auth::isAuth();
	}
	
	/* (non-PHPdoc)
	 * @see BaseController::onInvalidControl()
	 */
	public function onInvalidControl() {
		$this->initialize();
		$this->messageDanger("<strong>Autorisation refusÃ©e</strong>,<br>Merci de vous connecter pour accÃ©der Ã  ce module.&nbsp;".Auth::getInfoUser("danger"));
		$this->finalize();
		exit;
	}
}
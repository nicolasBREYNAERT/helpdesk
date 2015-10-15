<?php
use micro\orm\DAO;
use micro\views\Gui;
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
		//$popularity=$a->getPopularity();
		//$popularity=$popularity + 1;
		//$a->setPopularity($popularity);
		//mettre � jour a dans la base
		//DAO::update($a);
		//$test=$a->getPopularity();
		//chargement de la vue
		$contenu=$a->getContenu();
		$titre=$a->getTitre();
		$user=$a->getUser();
		$version=$a->getVersion();
		$dateCreation=$a->getDateCreation();
		$suspendu=$a->getSuspendre();
		$this->loadView("faq/vContenu",array("faqs"=>$a,"title"=>$titre,"contenu"=>$contenu,/*"a"=>$test,*/"user"=>$user,"version"=>$version,"dateCreation"=>$dateCreation,"suspendu"=>$suspendu));
	}
	
	public function editionArticle(){
		$categories=DAO::getAll("Categorie");
		$listCat=Gui::select($categories,"selectionner une categorie ...");
		$this->loadView("faq/vAjout",array("listCat"=>$listCat));
	}
	public function modifierArticle($id){
		$a=$this->getInstance($id[0]);
		$id=$a->getId();
		$contenu=$a->getContenu();
		$titre=$a->getTitre();
		$user=$a->getUser();
		$version=$a->getVersion();
		$dateCreation=$a->getDateCreation();
		$categorie=$a->getCategorie();
		$popularity=$a->getPopularity();
		$suspendre=$a->getSuspendre();
		
		$categories=DAO::getAll("Categorie");
		$listCat=Gui::select($categories,$categorie);
		
		$this->loadView("faq/vModif",array("suspendre"=>$suspendre,"faqs"=>$a,"titre"=>$titre,"contenu"=>$contenu,"user"=>$user,"version"=>$version,"dateCreation"=>$dateCreation,"categorie"=>$categorie,"popularity"=>$popularity,"id"=>$id,"listCat"=>$listCat));
	}
	public function index(){
		//en tant qu'admin je peux ecrire un article
		if($_SESSION["admin"]=="1"){
			$this->loadView("faq/vAdmin");
			// en tant qu'admin je peux voir mes articles et les modifier
			$db=DAO::$db;
			$mesAtricles=$db->query("select faq.id from faq where faq.idUser=".Auth::getUser()->getId());
			echo "<table class='table table-striped'>";
			foreach ($mesAtricles as $m){
				$monArticle=DAO::getOne("Faq",$m[0]);
				echo "<tr class='article'><td><a class='titreArticle' name='".$monArticle->getTitre()."' href='faqs/contenu/".$monArticle->getId()."'>".$monArticle->getTitre()."<br></a></td>";
				echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='faqs/modifierArticle/".$monArticle->getId()."'>Modifier</a></td>";
				$x=$monArticle->getSuspendre();
				if($x==0){
					echo "<td class='td-center'><a class='btn btn-primary btn-xs suspendre' href='faqs/suspendre/".$monArticle->getId()."'>Suspendre</a></td>";
				}else{
					echo "<td class='td-center'><a class='btn btn-primary btn-xs activer' href='faqs/Rsuspendre/".$monArticle->getId()."'>Activer</a></td>";
				}
				echo "<td class='td-center'><a name='".$monArticle->getTitre()."' class='btn btn-warning btn-xs suppression' href='faqs/delete/".$monArticle->getId()."'>Supprimer</a></td>";
				echo "</tr>";
			}
			echo"</table>";
		}
		//recherche
		if(isset($_POST["recherche"]) && $_POST["recherche"]!="" && $_POST["recherche"]!="votre recherche..."){
			$recherch=$_POST["recherche"];
			$faqs=DAO::getAll("Faq","titre LIKE '%".$recherch."%'");
			$this->loadView("faq/vResultat",array("faqs"=>$faqs,"title"=>"Resultat de votre recherche : "));
		}else{
		$this->loadView("faq/vRecherche");
		//sujet les plus populaire
		$faqs=DAO::getAll("Faq","1=1 order by popularity limit 10");
		$this->loadView("faq/vPopulaire",array("faqs"=>$faqs,"title"=>"Sujets les plus populaires"));
		//sujet les plus r�cents
		$faqs=DAO::getAll("Faq","1=1 order by dateCreation limit 10");
		$this->loadView("faq/vFaqs",array("faqs"=>$faqs,"title"=>"Sujets les plus recents"));
		//sujet par cat�gorie
		$this->loadView("faq/vCate",array("faqs"=>$faqs));
		}}
		public function suspendre($id){
			$a=$this->getInstance($id[0]);
			$a->setSuspendre(1);
			DAO::update($a);
			$this->index();
		}
		public function Rsuspendre($id){
			$a=$this->getInstance($id[0]);
			$a->setSuspendre(0);
			DAO::update($a);
			$this->index();
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
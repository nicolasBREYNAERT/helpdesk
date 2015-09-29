<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\views\Gui;
use micro\utils\RequestUtils;
use micro\db\Database;
/**
 * Gestion des tickets
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Tickets extends \_DefaultController {
	public function Tickets(){
		parent::__construct();
		$this->title="Tickets";
		$this->model="Ticket";
	}

	public function index() {
		if ($_SESSION["admin"] == "1"){
			$nouveaux=DAO::getAll("Ticket","idStatut=1");
			$this->loadView("ticket/vNouveaux", array("nouveaux"=>$nouveaux));
			$ticket=DAO::getAll("Ticket", "1=1 order by idStatut");
			echo "<table class='table table-striped'>";
			echo "<tbody>";
			foreach ($ticket as $t){
				echo "<tr>";
				echo "<td><b>".$t->getTitre()."</b> - ".$t->getUser()." - ".$t->getStatut()."</td>";
				echo "<td class='td-center'><a class='btn btn-primary btn-xs' href='tickets/updateStatut/".$t->getId()."'>Statut</a></td>".
						"<td class='td-center'><a class='btn btn-primary btn-xs' href='tickets/frm/".$t->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
						"<td class='td-center'><a class='btn btn-warning btn-xs' href='tickets/delete/".$t->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<a class='btn btn-primary' href='tickets/frm'>Ajouter...</a> &nbsp; ";
			echo "<a class='btn btn-primary' href='tickets/ticketAdmin'>Mes tickets</a>";
		}
		else{
			$ticket=DAO::getAll("Ticket", "1=1 order by idStatut");
			echo "<table class='table table-striped'>";
			echo "<tbody>";
			foreach ($ticket as $t){
				echo "<tr>";
				echo "<td><b>".$t->getTitre()."</b> - ".$t->getUser()." - ".$t->getStatut()."</td>";
				echo 	"<td class='td-center'><a class='btn btn-primary btn-xs' href='tickets/frm/".$t->getId()."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>".
						"<td class='td-center'><a class='btn btn-warning btn-xs' href='tickets/delete/".$t->getId()."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<a class='btn btn-primary' href='tickets/frm'>Ajouter...</a>";
		}
	}
	
	public function ticketAdmin($id=NULL){
		$db=DAO::$db;
		$messages=$db->query("select message.id from message inner join ticket on message.idTicket=ticket.id where message.idUser=".Auth::getUser()->getId());
		$statement=$db->query("select distinct ticket.id from ticket inner join message on message.idTicket=ticket.id where message.idUser=".Auth::getUser()->getId());
		foreach ($statement as $s){
			$ticket=DAO::getOne("Ticket",$s[0]);
			echo $ticket."</br>";
		}
		
		$this->loadView("ticket/vMessages",array("ticket"=>$ticket,"messages"=>$messages));
		echo Jquery::execute("CKEDITOR.replace('message');");
		//EN COUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUURS !! 
	}
	
	
	public function messages($id){
		$ticket=DAO::getOne("Ticket", $id[0]);
		if($ticket!=NULL){
			echo "<h2>".$ticket."</h2>";
			$messages=DAO::getOneToMany($ticket, "messages");
			echo "<table class='table table-striped'>";
			echo "<thead><tr><th>Messages</th></tr></thead>";
			echo "<tbody>";
			foreach ($messages as $msg){
				echo "<tr>";
				echo "<td title='message' data-content='".htmlentities($msg->getContenu())."' data-container='body' data-toggle='popover' data-placement='bottom'>".$msg->toString()."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo Jquery::execute("$(function () {
					  $('[data-toggle=\"popover\"]').popover({'trigger':'hover','html':true})
				})");
		}
	}

	public function frm($id=NULL){
		$ticket=$this->getInstance($id);
		$categories=DAO::getAll("Categorie");
		if($ticket->getCategorie()==null){
			$cat=-1;
		}else{
			$cat=$ticket->getCategorie()->getId();
		}
		
		$statut=DAO::getAll("Statut");
		if($ticket->getStatut()==null){
			$stat=-1;
		}else{
			$stat=$ticket->getStatut()->getId();
		}
		
		$listCat=Gui::select($categories,$cat,"SÃ©lectionner une catÃ©gorie ...");
		$listType=Gui::select(array("demande","intervention"),$ticket->getType(),"SÃ©lectionner un type ...");
		$listStatut=Gui::select($statut,$stat,"SÃ©lectionner un statut ...");
		
		

		$this->loadView("ticket/vAdd",array("ticket"=>$ticket,"listCat"=>$listCat,"listType"=>$listType, "listStatut"=>$listStatut));
		echo Jquery::execute("CKEDITOR.replace( 'description');");
	}
	
	public function updateStatut($id=NULL){
		$ticket=$this->getInstance($id);	
		$statut=DAO::getAll("Statut");
		if($ticket->getStatut()==null){
			$stat=-1;
		}
		else{
			$stat=$ticket->getStatut()->getId();
		}
	
		$listStatut=Gui::select($statut,$stat,"SÃ©lectionner un statut ...");
		$statuts=DAO::getAll("Statut", "1=1");
		$this->loadView("ticket/vStatut",array("ticket"=>$ticket, "listStatut"=>$statuts));
	}
	

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
		$statut=DAO::getOne("Statut", $_POST["idStatut"]);
		$object->setStatut($statut);
		$user=DAO::getOne("User", $_POST["idUser"]);
		$object->setUser($user);
	}

	



	

	/* (non-PHPdoc)
	 * @see _DefaultController::getInstance()
	 */
	public function getInstance($id = NULL) {
		$obj=parent::getInstance($id);
		if(null==$obj->getType())
			$obj->setType("intervention");
		if($obj->getStatut()===NULL){
			$statut=DAO::getOne("Statut", 1);
			$obj->setStatut($statut);}
		
		if($obj->getUser()===NULL){
			$obj->setUser(Auth::getUser());
		}
		if($obj->getDateCreation()===NULL){
			$obj->setdateCreation(date('Y-m-d H:i:s'));
		}
		return $obj;
	}


	/* (non-PHPdoc)
	 * @see BaseController::isValid()
	 */
	public function isValid() {
		return Auth::isAuth();
	}
	
	public function isAdmin(){
		
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

	public function update(){
		if(RequestUtils::isPost()){
			$className=$this->model;
			$object=new $className();
			$this->setValuesToObject($object);
			if($_POST["id"]){
				try{
					DAO::update($object);
					$msg=new DisplayedMessage($this->model." `{$object->toString()}` mis à jour");
					/* ICI JE CREE UN MESSAGE */
					
				}catch(Exception $e){
					$msg=new DisplayedMessage("Impossible de modifier l'instance de ".$this->model,"danger");
				}
			}else{
				try{
					DAO::insert($object);
					$msg=new DisplayedMessage("Instance de ".$this->model." `{$object->toString()}` ajoutée");
				}catch(Exception $e){
					$msg=new DisplayedMessage("Impossible d'ajouter l'instance de ".$this->model,"danger");
				}
			}
			$this->forward(get_class($this),"index",$msg);
		}
	}


}
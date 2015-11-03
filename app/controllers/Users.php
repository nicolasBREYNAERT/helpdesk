<?php
/**
 * Gestion des users
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
use micro\orm\DAO;
use micro\utils\RequestUtils;
class Users extends \_DefaultController {
	
	public function Users(){
		parent::__construct();
		$this->title="Utilisateurs";
		$this->model="User";
	}

	public function frm($id=NULL){
		$user=$this->getInstance($id);
		$this->loadView("user/vAdd",array("user"=>$user));
	}

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setAdmin(isset($_POST["admin"]));
	}

	public function tickets(){
		$this->forward("tickets");
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
				}catch(Exception $e){
					$msg=new DisplayedMessage("Impossible de modifier l'instance de ".$this->model,"danger");
				}
			}else{
				try{
					//crypter le mdp
					$pass=$object->getPassword();
					$hash = crypt($pass);
					$object->setPassword($hash);
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
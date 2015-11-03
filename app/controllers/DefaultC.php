<?php
use micro\orm\DAO;
use micro\js\Jquery;
use micro\controllers\BaseController;
use micro\views\Gui;
/**
 * Contrôleur par défaut (défini dans config => documentRoot)
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class DefaultC extends BaseController {

	public function connexion(){
		
		$user=$_POST["login"];
		$password=$_POST["password"];
		$use=DAO::getAll("User");
		$x=0;
		foreach ($use as $u){
			$toto=crypt($u->getPassword());
			if($u->getLogin()==$user && $toto=crypt($password,$toto)){
				if(isset($_POST["cookie"])){
					$expire = 365*24*3600; // on définit la durée du cookie, 1 an
					setcookie("utilisateur",$u,time()+$expire);  // on l'envoi;
				}
				$x=1;
				$_SESSION["user"]=$u;
				$_SESSION["password"]=$password;
				$_SESSION["login"]=$user;
				$y=$u->getAdmin();
				if($y==true){
					$_SESSION["admin"]=1;
				}else{
					$_SESSION["admin"]=0;
				}
				$this->index();
			}
		}
		if($x==0){
			$this->index();
			$this->loadView("main/vEchecConnexion");
		}
	}
	public function ajaxLogin(){
		echo '<div class="login col-md-2 col-md-offset-4"><b>Votre login est : </b>'.$_SESSION["login"].'</div>';
		echo '<br><form method="post" action="Users/update" id="modifLogin" name="modifLogin">';
		echo '	<br>
				<input name="id" type="hidden">
				<input type="text" class="col-md-3 col-md-offset-4" name="login" placeholder="Entrez votre nouveau login ...">
				<br>
				<br>
			</form>';
		echo '<button id="brValidate" class="btn btn-primary col-md-1 col-md-offset-4">Valider</button>';
		echo '<button id="btClose"" class="btn btn-primary col-md-1 col-md-offset-1">Retour</button>';
		Jquery::bindMethods(true,false);
		Jquery::getOn("click", ".login", "users/frm","#response");
		Jquery::doJqueryOn(".ck", "click", "$(event.target).parent()", "toggleClass",array("disabled","$(event.target).prop('checked')"));
		Jquery::doJqueryOn(".list-group-item", "mouseenter", "this", "addClass",array("active"));
		Jquery::doJqueryOn(".list-group-item", "mouseout", "this", "removeClass","active");
		Jquery::doJqueryOn("#btClose", "click", "#response", "html","");
		Jquery::doJqueryOn("#btClose", "click", "#main", "show");
		Jquery::postFormOn("click", "#brValidate", "Users/update", "modifLogin");
		Jquery::doJqueryOn("#brValidate", "click", "#response", "html");
		Jquery::doJqueryOn("#brValidate", "click", "#main", "show");
		Jquery::doJquery("#main", "hide");
		echo Jquery::compile();
	}
	public function ajaxPassword(){
		echo '<div class="login col-md-2 col-md-offset-4"><b>Votre mot de passe est : </b><input class="form-control" type="password" value="'.$_SESSION["password"].'" disabled></div>';
		echo '<br><form method="post" action="Users/update" id="modifPassword" name="modifPassword">';
		echo '	<br><br>
				<input name="id" type="hidden">
				<input type="text" class="col-md-3 col-md-offset-4" name="login" placeholder="Entrez votre nouveau Password ...">
				<br>
				<br>
			</form>';
		echo '<button id="brValidate" class="btn btn-primary col-md-1 col-md-offset-4">Valider</button>';
		echo '<button id="btClose"" class="btn btn-primary col-md-1 col-md-offset-1">Retour</button>';
		Jquery::bindMethods(true,false);
		Jquery::getOn("click", ".login", "users/frm","#response");
		Jquery::doJqueryOn(".ck", "click", "$(event.target).parent()", "toggleClass",array("disabled","$(event.target).prop('checked')"));
		Jquery::doJqueryOn(".list-group-item", "mouseenter", "this", "addClass",array("active"));
		Jquery::doJqueryOn(".list-group-item", "mouseout", "this", "removeClass","active");
		Jquery::doJqueryOn("#btClose", "click", "#response", "html","");
		Jquery::doJqueryOn("#btClose", "click", "#main", "show");
		Jquery::postFormOn("click", "#brValidate", "Users/update", "modifPassword");
		Jquery::doJqueryOn("#brValidate", "click", "#response", "html");
		Jquery::doJqueryOn("#brValidate", "click", "#main", "show");
		Jquery::doJquery("#main", "hide");
		echo Jquery::compile();
	}
		
	public function information(){
		$user=$_SESSION["login"];
		$password=$_SESSION["password"];
		$use=DAO::getAll("User","login=$user && password=$password");
		$this->loadView("main/vHeader");
		$this->loadView("main/modif",array("user"=>$use[0],"login"=>$user,"password"=>$password));
		
	}

	/**
	 * Affiche la page par défaut du site
	 * @see BaseController::index()
	 */
	public function index() {
		$this->loadView("main/vHeader",array("infoUser"=>Auth::getInfoUser()));
		if(isset($_SESSION["user"])){
			$this->loadView("main/vDefault",array("infoUser"=>Auth::getInfoUser()));
		}else{
			$this->loadView("main/vDefault1");
		}
		$this->loadView("main/vFooter");
		Jquery::getOn("click", ".btAjax", "sample/ajaxSample","#response");
		echo Jquery::compile();
	}

	/**
	 * Affiche la page de test
	 */
	public function test() {
		$this->loadView("main/vHeader",array("infoUser"=>Auth::getInfoUser()));
		$this->loadView("main/vTest");
		$this->loadView("main/vFooter");
	}
	/**
	 * Connecte le premier administrateur trouvé dans la BDD
	 */
	public function asAdmin(){
		$_SESSION["user"]=DAO::getOne("User", "admin=1");
		$_SESSION["admin"]=1;
		$_SESSION['KCFINDER'] = array(
				'disabled' => false
		);
		$this->index();
	}

	/**
	 * Connecte le premier utilisateur (non admin) trouvé dans la BDD
	 */
	public function asUser(){
		$_SESSION["user"]=DAO::getOne("User", "admin=0");
		$_SESSION["admin"]=0;
		$_SESSION['KCFINDER'] = array(
				'disabled' => true
		);
		$this->index();
	}

	/**
	 * Déconnecte l'utilisateur actuel
	 */
	public function disconnect(){
		$_SESSION = array();
		$_SESSION['KCFINDER'] = array(
				'disabled' => true
		);
		$this->index();
	}

	public function ckEditorSample(){
		$this->loadView("main/vHeader",array("infoUser"=>Auth::getInfoUser()));
		echo "<div class='container'>";
		echo "<h1>Exemple ckEditor</h1>";
		echo "<textarea id='editor1'>Exemple de <strong>contenu</strong></textarea>";
		echo Jquery::execute("CKEDITOR.replace( 'editor1');");
		echo "</div>";
		$this->loadView("main/vFooter");
	}

	public function ajaxSample(){
		$users=DAO::getAll("User");
		echo '<ul class="list-group">';
		foreach ($users as $u){
			echo '<li class="list-group-item" id="'.$u->getId().'"><input type="checkbox" class="ck">&nbsp;'.$u->toString()."</li>";
		}
		echo "</ul>";
		echo "<button id='btClose' class='btn btn-primary'>Fermer</button>";
		Jquery::bindMethods(true,false);
		Jquery::getOn("click", ".list-group-item", "users/frm","#response");
		Jquery::doJqueryOn(".ck", "click", "$(event.target).parent()", "toggleClass",array("disabled","$(event.target).prop('checked')"));
		Jquery::doJqueryOn(".list-group-item", "mouseenter", "this", "addClass",array("active"));
		Jquery::doJqueryOn(".list-group-item", "mouseout", "this", "removeClass","active");
		Jquery::doJqueryOn("#btClose", "click", "#response", "html","");
		Jquery::doJqueryOn("#btClose", "click", "#main", "show");
		Jquery::doJquery("#main", "hide");
		echo Jquery::compile();
	}
}
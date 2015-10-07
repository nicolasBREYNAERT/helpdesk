<?php
namespace micro\controllers;

/**
 * Classe de base des contrôleurs
 * @author jc
 * @version 1.0.0.1
 * @package controllers
 */
abstract class BaseController {
	/**
	 * action par défaut
	 */
	abstract function index();
	/**
	 * Constructeur<br>
	 * Appelle automatiquement la méthode isValid() pour vérifier l'accès autorisé
	 */
	public function __construct(){
		if(!$this->isValid())
			$this->onInvalidControl();
	}

	/**
	 * Méthode appelée avant chaque action
	 */
	public function initialize(){

	}

	/**
	 * Méthode appelée après chaque action
	 */
	public function finalize(){

	}

	/**
	 * Charge la vue $viewName en lui passant éventuellement les variables $pdata
	 * @param string $viewName nom de la vue à charger
	 * @param mixed $pData variable ou tableau associatif à passer à la vue<br>Si une variable est passée, elle aura pour nom <b>$data</b> dans la vue,<br>
	 * Si un tableau associatif est passé, la vue récupère des variables du nom des clés du tableau
	 * @param boolean $asString Si vrai, la vue n'est pas affichée mais retournée sous forme de chaîne (utilisable dans une variable)
	 * @throws Exception
	 * @return string
	 */
	public function loadView($viewName,$pData="",$asString=false){
		global $config;
		$data=$pData;
		if(is_array($pData)){
			extract($pData);
		}
		$fileName=ROOT.DS."views/".$viewName.".php";
		if(file_exists($fileName)){
			if($asString)
				return $this->includeFileAsString($fileName);
			else
				include($fileName);
		}else{
			throw new \Exception("Vue inexistante");
		}
	}
	private function includeFileAsString($file){
		ob_start();
		include $file;
		return ob_get_clean();
	}

	/**
	 * retourne Vrai si l'accès au contrôleur est autorisé
	 * A surdéfinir dans les classes dérivées
	 * @return boolean
	 */
	public function isValid(){
			return true;
	}

	/**
	 * Appelée si isValid() a retourné faux<br>
	 * A surdéfinir dans les classes dérivées
	 */
	public function onInvalidControl(){
		header('HTTP/1.1 401 Unauthorized', true, 401);
		exit;
	}

	/**
	 * Charge le contrôleur $controller et appelle sa méthode $action en lui passant les paramètres $params
	 * @param string $controller Contrôleur
	 * @param string $action action
	 * @param mixed $params paramètres passés ) $action
	 * @param boolean $initialize si vrai, la méthode initialize du contrôleur est appelée avant $action
	 * @param boolean $finalize si vrai, la méthode finalize du contrôleur est appelée après $action
	 * @throws Exception
	 */
	public function forward($controller,$action="index",$params=array(),$initialize=false,$finalize=false){
		try{
			$obj=new $controller();
			if($initialize===true){
				$obj->initialize();
			}
			if(method_exists($obj, $action)){
				$obj->$action($params);
			}else{
				throw new \Exception("La méthode `{$action}` n'existe pas sur le contrôleur `{$controller}`");
			}
			if($finalize===true){
				$obj->finalize();
			}
		}catch(\Exception $e){
			echo $e->getMessage();
		}
	}
}
?>

<?php
require_once ROOT.DS.'micro/log/chromePhp.php';

class Logger{
	public static $test;
	public static function init(){
		global $config;
		Logger::$test=$config["test"];
		ChromePhp::getInstance()->addSetting(ChromePhp::BACKTRACE_LEVEL, 2);
	}
	public static function log($id,$message){
		/*if(Logger::$test===false)
		ChromePhp::log($id.":".$message);*/
	}
	public static function warn($id,$message){
		/*if(Logger::$test===false)
		ChromePhp::warn($id.":".$message);*/
	}
	public static function error($id,$message){
		/*if(Logger::$test===false)
		ChromePhp::error($id.":".$message);*/
	}
}
<?php
/**
 * GAdmin Helper!
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GAdminHelper{
	public $controller;
	function __construct(){
		$this->controller=Yii::app()->controller;
		if (method_exists($this,'init')){
			$args = func_get_args();
			call_user_func_array(array(&$this,'init'),$args);
		}
	}
	private function PublishAssetsInit(){
		$folder=dirname(__FILE__). DS.'assets';
		if(is_dir($folder)){
			$this->AssetsBase = Yii::app() -> assetManager -> publish($assets);
		}
	}
	
	
}

?>
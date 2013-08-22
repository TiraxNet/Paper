<?php
/**
 * Some useful functions to work with JSON
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class JSON extends CComponent{
	/**
	 * Do nothing!
	 */
	public function init(){}
	/**
	 * Convert an array to javascript object
	 * @param string $name Javascript Object name
	 * @param Array $array Array to convert
	 */
	public static function sendArrayToJS($name,$array){
		$jstring=json_encode($array);
		$script='var '.$name.' = $.parseJSON(\''.$jstring."');\n";
		Yii::app()->clientScript->registerScript(uniqid(), $script);
		//return $script;
	}	
}
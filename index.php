<?php
/**
 * Paper index.php :)
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */

define( 'DS', DIRECTORY_SEPARATOR );
defined('YII_DEBUG') or define('YII_DEBUG',true);


require_once(dirname(__FILE__).DS.'framework'.DS.'yii.php');


$app=Yii::createWebApplication(dirname(__FILE__).DS.'protected'.DS.'config'.DS.'main.php')->run();


?>
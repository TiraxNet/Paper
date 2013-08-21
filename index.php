<?php
/**
 * Paper index.php :)
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
defined('YII_DEBUG') or define('YII_DEBUG',false);
defined('MULTI_USER') or define('MULTI_USER',true);
defined('USER') or define('USER','main');

define( 'BASE_PATH', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

require_once(dirname(__FILE__).DS.'framework'.DS.'yii.php');

$app=Yii::createWebApplication(dirname(__FILE__).DS.'protected'.DS.'config'.DS.'main.php')->run();


?>
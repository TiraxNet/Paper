<?php
/**
 * Paper! isntaller
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
 
defined('YII_DEBUG') or define('YII_DEBUG',false);

define( 'BASE_PATH', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

require_once(dirname(__FILE__).DS.'..'.DS.'framework'.DS.'yii.php');

$app=Yii::createWebApplication(dirname(__FILE__).DS.'protected'.DS.'config.php')->run();
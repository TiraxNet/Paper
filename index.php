<?php
//error_reporting(E_ALL);
//Test

define( 'DS', DIRECTORY_SEPARATOR );
defined('YII_DEBUG') or define('YII_DEBUG',true);


require_once(dirname(__FILE__).DS.'framework'.DS.'yii.php');


$app=Yii::createWebApplication(dirname(__FILE__).DS.'protected'.DS.'config'.DS.'main.php')->run();


?>
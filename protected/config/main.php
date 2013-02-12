<?php
/**
* Paper! Config File 
* @author Mohammad Hosein Saadatfar
* @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
*/
include 'User_config.php';
return array(
	'params'=>array(
		'AdminUsername' => 'admin',
		'AdminPass' => '13721372'
	),
	'modules'=>array(
		'gii'=>array(
		    'class'=>'system.gii.GiiModule',
		    'password'=>'13721372',
		),
		'admin'=>array(
		    'class'=>'application.admin.AdminModule',
		),
    ),
	'name'=>$UConfig['website']['Name'],
	'basePath'=>dirname(__FILE__).DS.'..',
	'import'=>array(
    	'application.components.*',
		'application.extensions.*',
		'application.extensions.functions.*',
		'application.models.*',
		'application.GWidgets.*',
		'application.admin.components.*',
	),
	'preload'=>array(
			'bootstrap',
	),
	'aliases' => array(
	),
	'components'=>array(
		'Paper' => array(
			'class' => 'application.components.GRuntime',
		),
		'cache'=>array(
		    	'class'=>'system.caching.CFileCache',
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
	    	),
	    'functions'=>array(
	    	'class'=>'ext.functions.functions',
	    ),
	    'db'=>array(
	    		'class'=>'CDbConnection',
	    		'connectionString'=>'mysql:host='.$UConfig['db']['Host'].';dbname='.$UConfig['db']['Table'],
	    		'username'=>$UConfig['db']['UserName'],
	    		'password'=>$UConfig['db']['Password'],
	    		'emulatePrepare'=>true,
	    		'charset'=>'utf8',
	    ),
    ),
);


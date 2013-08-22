<?php
/**
* Paper! Config File 
* @author Mohammad Hosein Saadatfar
* @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
*/
if (MULTI_USER)
	$user_folder=BASE_PATH.DS.'user'.DS.'_'.USER;
else
	$user_folder=BASE_PATH.DS.'user';
Yii::setPathOfAlias('user', $user_folder);
if (!file_exists($user_folder.DS.'User_config.php'))
{
	header('Location: install');
	die();
}
require($user_folder.DS.'User_config.php');

return array(
	'params'=>array(
		'AdminUsername' => 'admin',
		'AdminPass' => '13721372'
	),
	'name'=>$UConfig['website']['Name'],
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'import'=>array(
    	'application.components.*',
		'application.extensions.*',
		'application.models.*',
		'application.GWidgets.*',
		'application.admin.components.*',
	),
	'modules'=>array(
		'admin'=>array(
			'class'=>'application.admin.AdminModule',
			'preload'=>array('bootstrap','AdminAuth'),
			'components'=>array(
				'bootstrap'=>array(
					'class'=>'ext.bootstrap.components.Bootstrap'
				),
				'AdminAuth'=>array(
					'class'=>'application.admin.components.AdminAuth'
				)
			)
		),
	),
	'components'=>array(
		'TempRep'=>array(
				'class'=>'application.components.GTempRepository'
		),
		'cache'=>array(
		    	'class'=>'system.caching.CFileCache',
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
	    ),
	    'functions'=>array(
	    	'class'=>'ext.functions',
	    ),
		'functions'=>array(
			'class'=>'ext.JSON',
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


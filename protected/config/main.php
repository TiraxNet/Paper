<?php
/**
* Paper! Config File 
* @author Mohammad Hosein Saadatfar
* @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
*/

if(preg_match('$u/[0-9A-Za-z-]*[^\/]*$',$_SERVER['REQUEST_URI'],$m)){
	$userName=substr($m[0],2);
	$user_folder = BASE_PATH.DS.'user'.DS.$userName;
	define('USER',$userName);
}else if (file_exists(BASE_PATH.DS.'user'.DS.'config.php')){
	define('USER','main');
	$user_folder = BASE_PATH.DS.'user';
}else{
	$url=$_SERVER['REQUEST_URI'];
	$found=false;
	require(BASE_PATH.DS.'user'.DS.'users.php');
	foreach($USERS as $key=>$val){
		if (@preg_match('/'.$val.'/i', $_SERVER['HTTP_HOST']) || @preg_match('/'.$val.'/i', $_SERVER['REQUEST_URI'])){
			$userName=$key;
			$found=true;
			break;
		}
	}
	if (!$found){
		echo '404 Not Found!';
		die();
	}
	define('USER',$userName);
	$user_folder = BASE_PATH.DS.'user'.DS.$userName;
}
define('USER_PATH',$user_folder);
require($user_folder.DS.'config.php');

Yii::setPathOfAlias('user', $user_folder);

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
		'system.caching.CFileCache'
	),
	'modules'=>array(
		'admin'=>array(
			'class'=>'application.admin.AdminModule',
			'preload'=>array('bootstrap'),
			'components'=>array(
				'bootstrap'=>array(
					'class'=>'ext.bootstrap.components.Bootstrap'
				),
				'adminAuth'=>array(
					'class'=>'application.admin.components.AdminAuth'
				)
			)
		),
	),
	'components'=>array(
		'TempRep'=>array(
				'class'=>'application.components.GTempRepository'
		),
		'ImgCache'=>array(
				'class'=>'ext.ImgCache',
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
	    ),
	    'functions'=>array(
	    	'class'=>'ext.functions',
	    ),
		'JSON'=>array(
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
		'urlManager'=>array(
			'class'=>'application.components.GUrlManager',
			'showScriptName'=> false,
			'urlFormat'=>'path',
			'rules'=>array(
					'page<id:\d+>'=>'site/index', //Page id for single User
					'u/<u:\w+>(/page<id:\d+>)?'=>'site/index', //Page id for multi user 
					'u/<u:\w+>/<A:.+>'=>'<A>',
			),
		),
		
    ),
);


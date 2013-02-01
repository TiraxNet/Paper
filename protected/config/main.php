<?php
/**
* Paper! Config File 
* @author Mohammad Hosein Saadatfar
* @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
*/

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
	'name'=>'Paper!',
	'basePath'=>dirname(__FILE__).DS.'..',
	'import'=>array(
    	'application.components.*',
		'application.extensions.*',
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
		'decoda' => array(
        	'class' => 'ext.decoda.YiiDecoda',
        	'defaults' => true,
    	),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
		'db'=>array(
            'class'=>'CDbConnection',
            'connectionString'=>'mysql:host=localhost;dbname=paper',
            'username'=>'root',
            'password'=>'',
            'emulatePrepare'=>true,
			'charset'=>'utf8',
        ),
		'bootstrap'=>array(
        	'class'=>'ext.bootstrap.components.Bootstrap',
    	),
    	'functions'=>array(
    		'class'=>'ext.functions.functions',
    	)
    ),
);
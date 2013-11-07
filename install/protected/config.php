<?php
/**
* Paper! Config File 
* @author Mohammad Hosein Saadatfar
* @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
*/
Yii::setPathOfAlias ( 'parentRoot', dirname ( __FILE__ ) . DS . '..' . DS . '..' );
return array (
		'name' => 'Paper Installer',
		'basePath' => dirname ( __FILE__ ),
		'import' => array (
				'application.components.*',
				'application.models.*',
		),
		'components' => array (
				'bootstrap' => array (
						'class' => 'parentRoot.protected.extensions.bootstrap.components.Bootstrap' 
				),
				'SQL' => array (
						'class' => 'application.components.SQL' 
				),
				'render' => array (
						'class' => 'application.components.render' 
				) 
		),
		'preload' => array (
				'bootstrap' 
		) 
);


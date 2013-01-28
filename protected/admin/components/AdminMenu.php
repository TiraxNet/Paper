<?php
class AdminMenu{
	public static function Render($c){
		return Yii::app()->controller->widget('bootstrap.widgets.BootNavbar', array(
		'fixed'=>false,
		'brand'=>'Paper!',
		'brandUrl'=>'#',
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'items'=>array(
					array('label'=>'Home', 'url'=>'index.php', 'active'=>true),
					array('label'=>'Templates', 'url'=>'index.php?r=admin/Tmp/list'),
					array('label'=>'Logout', 'url'=>'index.php?r=admin/login/logout'),
				),
			),
			$c
		),
		)); 
	}
}
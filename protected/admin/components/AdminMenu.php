<?php
class AdminMenu{
	public function Render($c){
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
					array('label'=>'Edit', 'url'=>'index.php?r=admin/Tmp/list'),
					array('label'=>'New Template', 'url'=>'index.php?r=admin/Tmp/new'),
					array('label'=>'Test', 'url'=>'#OptionsDialog',data-toggle=>"modal"),
					array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
						array('label'=>'Action', 'url'=>'#'),
						array('label'=>'Another action', 'url'=>'#'),
						array('label'=>'Something else here', 'url'=>'#'),
						'---',
						array('label'=>'NAV HEADER'),
						array('label'=>'Separated link', 'url'=>'#'),
						array('label'=>'One more separated link', 'url'=>'#'),
					)),
					array('label'=>'Logout', 'url'=>'index.php?r=admin/login/logout'),
				),
			),
			$c
		),
		)); 
	}
}
<?php
class Menu extends CWidget
{
	public $control;
	
	/**
	 * (non-PHPdoc)
	 * @see CWidget::run()
	 */
	public function run() {
		Yii::app()->controller->widget('bootstrap.widgets.TbNavbar', array(
			'fixed'=>false,
			'brand'=>'Paper!',
			'brandUrl'=>'#',
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbMenu',
					'items'=>array(
						array('label'=>'Home', 'url'=>'index.php', 'active'=>true),
						array('label'=>'Templates', 'url'=>'index.php?r=admin/Tmp/list'),
						array('label'=>'Logout', 'url'=>'index.php?r=admin/login/logout'),
					),
				),
				$this->control,
			),
		));
	}
}
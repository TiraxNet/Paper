<?php
/**
 * Admin menu widget
 * @package Paper.admin.widgets
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Menu extends CWidget
{
	/**
	 * An HTML code that will be presented on the right side of menu
	 * @var string
	 */
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
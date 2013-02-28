<?php
/**
 * Paper admin default controller
 * @package Paper.admin.controllers
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class DefaultController extends CController
{
	public $Title;
	/**
	 * Make sure that current user is admin
	 * @see CController::init()
	 */
	public function init(){
		Yii::app()->getModule('admin')->AdminAuth->check();
	}
	public function actionIndex()
	{
		$this->redirect(array('Tmp/list'));
	}
}
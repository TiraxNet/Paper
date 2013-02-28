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
	public function actionIndex()
	{
		if (Yii::app()->user->id=='admin'){
			$this->redirect(array('Tmp/list'));
		}else{
			$this->redirect(array('login/login'));
		}
	}
}
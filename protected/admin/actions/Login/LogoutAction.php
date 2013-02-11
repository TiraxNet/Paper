<?php
/**
 * Admin logout action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class LogoutAction extends CAction{
	/**
	 * Run logout action
	 */
	public function run(){
		Yii::app()->user->logout();
		$this->controller->redirect('index.php');
	}
}
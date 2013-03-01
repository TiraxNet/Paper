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
	/**
	 * Each page should has a title, even redirecting page!
	 * @var string
	 */
	public $Title;
	/**
	 * Redirect user to templates list
	 */
	public function actionIndex()
	{
		$this->redirect(array('Tmp/list'));
	}
}
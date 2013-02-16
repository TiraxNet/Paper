<?php
/**
 * SiteController is the default controller to handle user requests.
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class SiteController extends CController
{
	/**
	 * Requested template id will be stored here.
	 * @var string
	 */
	public $tmp;
	/**
	 * Page title will be stored here, main layout uses this attribute as page title.
	 * @var string
	 */
	public $Title;
	/**
	 * Paper starts here!
	 * @param string $tmp Optional; Get template id from request. if no id is requested, show template "1"
	 */ 
	public function actionIndex($id='1')
	{	
		Yii::app() -> clientScript -> registerCSSFile($this->createUrl("css/index",array('id'=>$id)));
		Yii::app() -> clientScript -> registerScriptFile($this->createUrl("javascript/index",array('id'=>$id)));
		$this->Title=Yii::app()->Paper->GTemp->title;
		$body=Yii::app()->Paper->GTemp->GetContent();
		$this->render("main",array('body'=>$body));
	}
}
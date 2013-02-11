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
	 * Template id
	 * @var string
	 */
	public $tmp;
	/**
	 * Page title
	 * @var string
	 */
	public $Title;
	/**
	 * Body will be stored here
	 * @var string
	 */
	public $body;
	/**
	 * Paper starts here!
	 * @param string $tmp Optional; Get template id from request O.W. "1" will be loaded.
	 */ 
	public function actionIndex($id='1')
	{	
		$css_addr=$this->createUrl("css/index",array('id'=>$id));
		$js_addr=$this->createUrl("javascript/index",array('id'=>$id));
		$this->body=Yii::app()->Paper->GTemp->GetContent();
		$this->Title=Yii::app()->Paper->GTemp->title;
		$this->render("main",array('css_addr'=>$css_addr,'js_addr'=>$js_addr));
	}
}
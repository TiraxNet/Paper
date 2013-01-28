<?php

/**
 * SiteController is the default controller to handle user requests.
 * @author Mohammad hosein Saadatfar
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
	public function actionIndex($tmp='1')
	{	
		$css_addr=$this->createUrl("css/index",array('tmp'=>$tmp));
		$js_addr=$this->createUrl("javascript/index",array('tmp'=>$tmp));
		$this->body=Yii::app()->gc->GC->Render->HTML();
		$this->render("main",array('css_addr'=>$css_addr,'js_addr'=>$js_addr));
	}
}
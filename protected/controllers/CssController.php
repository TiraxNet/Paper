<?php

/**
 * This Controller shows dynamic css pages
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class CssController extends CController
{
	/**
	 * Template id will be stored here
	 * @var string
	 */
	public $tmp;
	/**
	 * Show template css
	 * @param string $tmp Get template id from request
	 */
	public function actionIndex($tmp)
	{
		$this->tmp=$tmp;
		
		header("Content-type: text/css; charset: UTF-8");
		
		$CSS=GRender::CSStoText(Yii::app()->gc->GC->Render->CSS());
		$CSS.=Yii::app()->gc->GC->CSS;
		echo $CSS;
	}
}
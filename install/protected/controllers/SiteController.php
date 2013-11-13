<?php
/**
 * SiteController is the default controller to handle user requests.
 * @package Paper.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class SiteController extends CController
{
	public function actionIndex()
	{	
		$this->render("start");
	}
	public function actionGetoptions($type){
		Yii::app()->render->CheckFilePermissions();
		if (array_key_exists('OptionsModel',$_POST))
		{
			Yii::app()->render->Render_Request();
			$msg=Yii::app()->render->MSG;
		}else $msg=null;
		$this->render("main",array('msg'=>$msg,'type'=>$type));
	}
}
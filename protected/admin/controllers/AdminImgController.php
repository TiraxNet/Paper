<?php
/**
 * Admin panel image controller
 * @package Paper.admin.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class AdminImgController extends CController
{
	/**
	 * Make sure that current user is admin
	 * @see CController::init()
	 */
	public function init(){
		Yii::app()->getModule('admin')->AdminAuth->check();
	}
	/**
	 * Show given template id and type as a complete, non-edited picture 
	 * @param string $tmp template id
	 * @param string $type template type
	 * @throws CHttpException 10002:Template not found
	 */
	public function actionFullTmp($id,$type='index'){
		if ($id==false) throw new CHttpException(10002,'No Template specified!');	
		
		$hndl=imagecreatefromjpeg(GTemplate::GetPath($id).DS.$type.".jpg");
		header('Content-Type: image/jpeg');
		imagejpeg($hndl,NULL,100);
	}
}
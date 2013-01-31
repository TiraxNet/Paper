<?php
/**
 * Admin panel image controller
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class ImgController extends CController
{
	/**
	 * Show given template id and type as a complete, non-edited picture 
	 * @param string $tmp template id
	 * @param string $type template type
	 * @throws CHttpException 10002:Template not found
	 */
	public function actionFullTmp($tmp,$type='index'){
		if ($tmp==false) throw new CHttpException(10002,'No Template specified!');	
		$GC=Yii::app()->gc->GC;
		
		$hndl=imagecreatefromjpeg($GC->Pic->Address.DS.$type.".jpg");
		header('Content-Type: image/jpeg');
		imagejpeg($hndl,NULL,100);
	}
}
<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class ImgController extends CController
{
	public function actionFullTmp($tmp){
		if ($tmp==false) throw new CHttpException(404,'No Template specified!');	
		$GC=Yii::app()->gc->GC;
		
		$hndl=imagecreatefromjpeg($GC->Pic->Address.DS."index.jpg");
		header('Content-Type: image/jpeg');
		imagejpeg($hndl,NULL,100);
	}
}
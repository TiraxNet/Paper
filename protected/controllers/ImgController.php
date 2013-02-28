<?php

/**
 * Create & show a template/block image such as a table cell background
 * @package Paper.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class ImgController extends CController
{
	/**
	 * Create & show block image
	 * @param string $id Get Block id from request
	 * @param string $type Optional; Get Type from request
	 * @param string $tmp Optional; Get Template id from request
	 */
	public function actionIndex($id,$type=NULL,$tmp=NULL)
	{	
		if ($tmp==NULL){
			$block=GBlock::FindById($id);
			$GTemp=GTemplate::FindById($block->id);
		}else{
			$GTemp=GTemplate::FindById($tmp);
		}
		$GTemp->RenderStructure();
		$block=$GTemp->blocks->GetById($id);
		if ($block==null) throw  new CHttpException('10003','Block not found'); 
		$hndl=$block->GetImage($type);
		header('Content-Type: image/jpeg');
		imagejpeg($hndl,NULL,100);
		imagedestroy($hndl);
	}
}
<?php

/**
 * This Controller create an show dynamic images 
 * @author Mohammad hosein Saadatfar
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
			$GC=new GClass($block->tmp);
		}else{
			$GC=new GClass($tmp);
		}
		$hndl=$GC->blocks[$id]->GetImage($type);
		header('Content-Type: image/jpeg');
		imagejpeg($hndl,NULL,100);
		imagedestroy($hndl);
	}
}
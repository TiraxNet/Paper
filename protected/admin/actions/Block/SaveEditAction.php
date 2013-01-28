<?php

/**
 * Save Edited block action
 * @author Mohammad Hosein Saadatfar
 *
 */
class SaveEditAction extends GAdminAction{
	/**
	 * GBlock Class of editing block
	 * 
	 * @var GBlock
	 */
	public $spblock;
	
	/**
	 * Run Save Edited Block action
	 * 
	 * @param string $block Gets Block id from request url
	 */
	public function run($block){
		$this->spblock=GBlock::FindById($block);
		$this->SavePos();
		$this->SaveOptions();
		
		$tmp=$this->spblock->tmp;
		$id=$this->spblock->id;
		$this->controller->redirect($this->controller->createUrl("block/edit",array('tmp'=>$tmp,'block'=>$id)));
	}
	/**
	 * Get Position of block from request and Save it in database.
	 * 
	 */
	public function SavePos(){
		if (!array_key_exists('EditBlockPos',$_POST)) return false;
		$data=$_POST['EditBlockPos'];
		$db=blocks::model()->findByPk($data['block']);
		if ($data['x1']==0 && $data['y1']==0 && $data['x2']==0 && $data['y2']==0){
			$tmp=$db->tmp;
			$db->delete();
			$this->controller->redirect($this->controller->createUrl("tmp/edit",array('tmp'=>$tmp)));
			exit();
			return true;
		}
		$db->x1=$data['x1'];
		$db->y1=$data['y1'];
		$db->x2=$data['x2'];
		$db->y2=$data['y2'];
		$db->save();
	 }
	 /**
	 * Get Options of block from request and Save it in database.
	 * 
	 */
	 public function SaveOptions(){
	 	 $block=$this->spblock;
		 $widget=$block->WidgetClass();
		 $formname=get_class($widget->FormModel());
		 if (!array_key_exists($formname,$_POST)) return false;
		 $str=$widget->AnalizeOptions($_POST[$formname]);
		 $db=blocks::model()->findByPk($this->spblock->id);
		 $db->opt=$str;
		 $db->save();
	 }
	
}
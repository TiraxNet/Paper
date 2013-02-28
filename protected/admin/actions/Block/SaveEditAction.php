<?php
/**
 * Save edited block action
 * @package Paper.admin.actions
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class SaveEditAction extends CAction{
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
		$block=GBlock::FindById($data['block']);
		if ($data['x1']==0 && $data['y1']==0 && $data['x2']==0 && $data['y2']==0){
			$tmp=$block->tmp;
			$block->delete();
			$this->controller->redirect($this->controller->createUrl("Tmp/update",array('id'=>$tmp)));
			exit();
			return true;
		}
		$block->x1=$data['x1'];
		$block->y1=$data['y1'];
		$block->x2=$data['x2'];
		$block->y2=$data['y2'];
		$block->Save();
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
		 $block->opt=$str;
		 $block->save();
	 }
	
}
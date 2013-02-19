<?php
/**
 * Admin, Save new block action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class SaveNewAction extends CAction{
	/**
	 * Run Save New Block action.
	 * This funtion just runs "Save" funtion.
	 */
	public function run(){
		$this->Save();
	}
	/**
	 * Gets Required parameters of new block from Post request and insert it in database.
	 * 
	 */
	public function Save()
	{
		$data=$_POST['NewBlockModel'];
		$block=new GBlock();
		$block->name=$data['name'];
		$block->widget=$data['widget'];
		$block->x1=$data['x1'];
		$block->y1=$data['y1'];
		$block->x2=$data['x2'];
		$block->y2=$data['y2'];
		$block->tmp=$data['tmp'];
		$id=$block->SaveNew();
		$this->controller->redirect(
			$this->controller->createUrl("block/edit",array('tmp'=>$block->tmp,'block'=>$id))
		);
	}

	
}

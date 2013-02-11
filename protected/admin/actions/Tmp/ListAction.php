<?php
/**
 * Admin, Show Template List action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class ListAction extends CAction{
	
	/**
	 * Stores array of template records; "Create_list()" function fill it.
	 * @var CActiveRecord[]
	 */
	public $Tlist;
	
	/**
	 * Run Template list Action
	 */
	public function run(){
		$this->Create_list();
		$this->controller->render("List",array(
											   'Tlist'=>$this->Tlist
								  			   )
								  );
	}
	/**
	 * Creates a list of Templates and save it in $this->Tlist
	 */
	public function Create_list(){
		$this->Tlist=new CActiveDataProvider('templates', array(
				'criteria'=>array(
						'condition'=>'parent=0',
				),
		));
	}
	
}
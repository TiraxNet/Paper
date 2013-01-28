<?php

/**
 * Show Template List action
 * @author Mohammad Hosein Saadatfar
 *
 */
class ListAction extends GAdminAction{
	
	/**
	 * Stores array of template records; "Create_list()" function fill it.
	 * @var CActiveRecord[]
	 */
	public $Tlist;
	
	/**
	 * Run Template list Action
	 */
	public function run(){
		$this->init();
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
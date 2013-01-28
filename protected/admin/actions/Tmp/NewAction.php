<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class NewAction extends GAdminAction{
	
	public $msg;
	
	public function run(){
		$this->init();
		if (array_key_exists('NewTmpModel',$_POST)) $this->save();
		$this->controller->render("new",array('msg'=>$this->msg));
	}
	public function save(){
		$model=new NewTmpModel;
		$model->setAttributes($_POST['NewTmpModel'],false);
		$tmp=new GTemplate();
		$tmp->name=$model->name;
		$tmp->css=$model->css;
		$tmp->title=$model->title;
		$tmp->parent=0;
		$id=$tmp->SaveNew();
		$this->msg='Now you should copy your images in "protected\templates\\'.$id.'"';
	}
	
}
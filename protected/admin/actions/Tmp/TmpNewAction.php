<?php
/**
 * New template action
 * @package Paper.admin.actions
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class TmpNewAction extends CAction{
	
	/**
	 * User Massage and alerts will be stored here by "save" method
	 * @var string
	 */
	public $msg;
	
	/**
	 * Run New Action!
	 */
	public function run(){
		if (array_key_exists('NewTmpModel',$_POST)) $this->save();
		$this->controller->render("new",array('msg'=>$this->msg));
	}
	/*
	 * Save Template
	 */
	public function save(){
		$model=new NewTmpModel;
		$model->setAttributes($_POST['NewTmpModel'],false);
		if ($model->validate()){
			$tmp=new GTemplate(null);
			$tmp->name=$model->name;
			$tmp->css=$model->css;
			$tmp->title=$model->title;
			$tmp->parent=0;
			$id=$tmp->SaveNew();
			$this->controller->redirect(array('Tmp/uploadimg','id'=>$id,'type'=>'index'));
		}else{
			$this->msg='You need some changes!:';
			foreach($model->getErrors() as $key=>$Error){
				$this->msg=$this->msg.'<br/>-'.$Error[0];
			}
		}
	}
	
}
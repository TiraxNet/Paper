<?php
/**
 * Get an html code and echo it on apropriate location
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Whtml extends GWidget{
	public function Options(){
		return array('html');
	}
	public function Content(){
		$con='<div class="Whtml" id="'.$this->block->name.'">';
		$con.=$this->GetOpt('html');
		$con.='</div>';
		return $con;
	}
	public function RenderOptions($Arg){
		$con=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $con->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'horizontalForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
		));
		echo $form->textAreaRow($model, 'html', array('rows'=>5));
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save'));
		echo '</div>';
		$con->endWidget();
	}
	public function CreateNew(){
		$tmpl=new GTemplate();
		$tmpl->name=$this->block->name.'_TMPL';
		$tmpl->parent=$this->block->id;
		$tmplid=$tmpl->SaveNew();
		$hndl=$this->block->GetImage();
		$path=GTemplate::GetPath($tmplid).DS.'index.jpg';
		imagejpeg($hndl,$path,100);
		$db=blocks::model()->findByPk($this->block->id);
		$db->opt=serialize(array('tmp'=>$tmplid));
		$db->save();
	} 
	
}
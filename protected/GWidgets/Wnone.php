<?php
/**
 * Do nothing, just mouse over action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Wnone extends GWidget{
	
	public function Options(){
		return array('hover');
	}
	public function Types(){
		if ($this->GetOpt('hover')==1) return array('index','hover');
		else return array('index'); 
	}
	public function CSS(){
		$GTemp=$this->GTemp;
		$CSS=new GCSS();
		$id=$this->block->id;
		$img_addr=$this->BlockImgUrl();
		$CSS->Add("#".$GTemp->name."_".$id, array("background" => "url('".$img_addr."') 0px"));
		if ($this->GetOpt('hover')==1){
			$start=$this->BlockImgPosition('hover');
			$CSS->Add("#".$GTemp->name."_".$id.":hover", array("background" => "url('".$img_addr."') ".$start."px"));
		}
		return $CSS;
	}
	public function RenderOptions($Arg){
		$con=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $con->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'horizontalForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
		));
		echo $form->checkBoxRow($model, 'hover');
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save'));
		echo '</div>';
		$con->endWidget();
	}
	
}
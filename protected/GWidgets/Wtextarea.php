<?php

class Wtextarea extends GWidget{
	private $form_name;
	
	public function init(){
		$this->form_name = GBlock::FindById($this->GTemp->parent)->getOptions('NameID');
	}
	
	public function Options(){
		return array('name','direction');
	}
	public function Content(){
		$name=$this->form_name.'['.$this->GetOpt('name').']';
		$content ='<textarea name="'.$name.'" ';		
		$content.='dir="'.$this->GetOpt('direction').'" >';
		$content.=@$_POST[$this->GetOpt('form')][$this->GetOpt('name')];
		$content.='</textarea> ';
		return $content;
	}
	public function RenderOptions($Arg){
		$con=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $con->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id'=>'OptionsForm',
				'type'=>'horizontal',
				'action'=>$Arg->action,
		));
		echo $form->textFieldRow($model, 'name');
		echo $form->dropDownListRow($model, 'direction', array('RTL'=>'Right to Left',
				'LTR'=>'Left to Right'));
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.TbButton', array('label'=>'Close','url'=>'#','htmlOptions'=>array('data-dismiss'=>'modal')));
		echo '</div>';
		$con->endWidget();
	}
}
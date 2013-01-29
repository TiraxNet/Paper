<?php
class Wsubmit extends GWidget{
	public function Options(){
		return array('name','value');
	}
	public function Content(){
		$c='<input type="submit" name="'.$this->GetOpt('name').'" ';
		$c.='value="'.$this->GetOpt('value').'" ';
		$c.=' />';
		return $c;
	}
	public function RenderOptions($Arg){
		$con=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $con->beginWidget('bootstrap.widgets.BootActiveForm', array(
			'id'=>'horizontalForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
		));
		echo $form->textFieldRow($model, 'name');
		echo $form->textFieldRow($model, 'value');
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save'));
		echo '</div>';
		$con->endWidget();
	}
}
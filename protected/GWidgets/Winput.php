<?php
/**
 * Use image part as input button
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Winput extends GWidget{
	public function Options(){
		return array('name','direction','form');
	}
	public function Content(){
		$name=$this->GetOpt('form').'['.$this->GetOpt('name').']';
		$content = '<input type="text" name="'.$name.'" ';
		$content.='style="font-size:'.($this->block->height*80/100).'px;" ';
		$content.='value="'.$_POST[$this->GetOpt('form')][$this->GetOpt('name')].'" ';
		$content.='dir="'.$this->GetOpt('direction').'" ';
		$content.='/>';
		return $content;
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
		echo $form->textFieldRow($model, 'form');
		echo $form->dropDownListRow($model, 'direction', array('RTL'=>'Right to Left',
																'LTR'=>'Left to Right'));
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save'));
		echo '</div>';
		$con->endWidget();
	}
}
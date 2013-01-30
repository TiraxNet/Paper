<?php

class Wnone extends GWidget{
	
	public function Options(){
		return array('hover');
	}
	public function Types(){
		if ($this->GetOpt('hover')==1) return array('index','hover');
		else return array('index'); 
	}
	public function CSS(){
		$GC=$this->GC;
		$CSS=new GCSS();
		$id=$this->block->id;
		$img_addr=GWTools::BlockImgUrl($id,NULL,$GC->id);
		$CSS->Add("#".$GC->name."_".$id, array("background" => "url('".$img_addr."') 0px"));
		if ($this->GetOpt('hover')==1){
			$start=GWTools::BlockImgPos($id,'hover',$GC->id);
			$CSS->Add("#".$GC->name."_".$id.":hover", array("background" => "url('".$img_addr."') ".$start."px"));
		}
		return $CSS;
	}
	public function RenderOptions($Arg){
		$con=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $con->beginWidget('bootstrap.widgets.BootActiveForm', array(
			'id'=>'horizontalForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
		));
		echo $form->checkBoxRow($model, 'hover');
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save'));
		echo '</div>';
		$con->endWidget();
	}
	
}
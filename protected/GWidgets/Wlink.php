<?php
/**
 * Link image part to given location
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */

class Wlink extends GWidget{
	public function Options(){
		return array('href','hover');
	}
	public function Content(){
		$block=$this->block;
		$link=$this->GetOpt('link');
		$HTML='<a ';
		foreach ($this->opt as $key=>$val){
			$HTML.=$key.'="'.$val.'" ';
		}
		$HTML.='>';
		$HTML.='<img src="publics/images/spacer.gif" width="'
			    .$block->width.'" height="'.$block->height.'"/>';
		$HTML.="</a>";
		return $HTML;
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
	public function Types(){
		if ($this->GetOpt('hover')==1) return array('index','hover');
		else return array('index');  
	}
	public function RenderOptions($Arg){
		$con=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $con->beginWidget('bootstrap.widgets.BootActiveForm', array(
			'id'=>'horizontalForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
		));
		echo $form->textFieldRow($model, 'href', array('id'=>'href'));
		$con->widget('application.widgets.TmpLinkWidget',array('InputId'=>'href'));
		echo $form->checkBoxRow($model, 'hover');
		echo '<div class="form-actions">';
		$con->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save'));
		echo '</div>';
		$con->endWidget();
	}
}
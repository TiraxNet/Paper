<?php
/**
 * Create a form main body and its template
 * @package Paper.gwidgets
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Wform extends GWidget{
	public function Options(){
		return array('NameID','tmp','action','method','RenderFile');
	}
	public function Content(){
		$con=$this->GetSubGTemp()->Render->HTML();
		$form='<form method="post" style="margin:0px;">';
		return $form.$con.'</form>';
	}
	public function CSS(){
		return $this->GetSubGTemp()->Render->CSS();
	}
	public function RenderInit(){
		if (array_key_exists($this->GetOpt('NameID'),$_POST)){
			$this->EvalFile('');
		}
	}
	public function EvalFile(){
		$path=GBlock::GetPath($this->block->id).DS.$this->GetOpt('RenderFile');
		if (!file_exists($path)) return false;
		$code=file_get_contents($path);
		$code=str_replace('<?php','',$code);
		foreach ($_POST[$this->GetOpt('NameID')] as $key=>$val){
			$$key=$val;
		}
		$result=eval($code);
		Yii::app()->params[$this->GetOpt('NameID').'Result']=$result;
	}
	public function GetSubGTemp(){
		$subtmp=$this->GetOpt('tmp');
		$WGT=GTemplate::FindById($subtmp);
		return $WGT;
	}
	public function RenderOptions($Arg){
		$controller=Yii::app()->controller;
		$model=$Arg->FormModel;
		$form = $controller->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'OptionsForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
		));
		echo $form->textFieldRow($model, 'NameID');
		echo $form->textFieldRow($model, 'RenderFile');
		echo $form->textFieldRow($model, 'tmp');
		echo $form->textFieldRow($model, 'action');
		echo $form->textFieldRow($model, 'method');
		echo '<a href="'.$controller->createUrl('Tmp/update',array('id'=>$model->tmp)).'">Edit Inside Template!</a><br/>';
		echo 'Copy Your PHP files in "protected/blocks/',$this->block->id.'"';
		echo '<div class="form-actions">';
		$this->Widget->widget('Button', array('label'=>'Close','url'=>'#','htmlOptions'=>array('data-dismiss'=>'modal')));
		echo '</div>';
		$controller->endWidget();
	}
	public function CreateNew(){
		$tmpl=new GTemplate(null);
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
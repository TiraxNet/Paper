<?php
/**
 * Link image part to given location
 * @package Paper.gwidgets
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
		$HTML='<a href="';
		$HTML.=$this->GetOpt('href');
		$HTML.='">';
		$HTML.='<img src="publics/images/spacer.gif" width="'
			    .$this->block->width.'" height="'.$this->block->height.'"/>';
		$HTML.="</a>";
		return $HTML;
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
	public function Types(){
		if ($this->GetOpt('hover')==1) return array('index','hover');
		else return array('index');  
	}
	public function RenderOptions($Arg){
		$form = $this->Widget->beginWidget('Form', array(
			'id'=>'OptionsForm',
			'type'=>'horizontal',
			'action'=>$Arg->action,
			'model'=>$Arg->FormModel,
		));
		$form->widget('textFieldRow','href', array('id'=>'href'));
		$this->Widget->widget('TmpLinkWidget',array('InputId'=>'href'));
		$form->widget('checkBoxRow', 'hover',array());
		echo '<div class="form-actions">';
		$this->Widget->widget('Button', array('label'=>'Close','url'=>'#','htmlOptions'=>array('data-dismiss'=>'modal')));
		echo '</div>';
		$form->endWidget();
	}
}
<?php

class GAdminController extends CController{
	public $AssetsBase;
	public $Name;
	public $BasePath;
	public $Action;
	
	public $Title;

	public function init(){
		$reflector = new ReflectionClass(get_class($this));
		$this->Name=str_replace(array('Controller','.php'),'',basename($reflector->getFileName()));
		$this->BasePath=Yii::getPathOfAlias('application.admin.actions').DS.$this->Name;
		$this->PublishAssetsInit();
	}
	
	public function PublishAssetsInit(){
		$f=$this->BasePath.DS.'assets';
		if(is_dir($f)){
			$this->AssetsBase = Yii::app() -> assetManager -> publish($f);
		}
	}
	public function InsertAsset($name,$type){
		if ($type=='script'){
			Yii::app() -> clientScript -> registerScriptFile($this->AssetsBase.'/'.$name);
		}else if ($type=='CSS'){
			Yii::app() -> clientScript -> registerCssFile($this->AssetsBase.'/'.$name);
		}	
	}
	public function Insert($text,$type,$pos=CClientScript::POS_END){
		if ($type=='script'){
			Yii::app() -> clientScript ->registerScript (uniqid(),$text,$pos);
		}else if ($type=='CSS'){
			Yii::app() -> clientScript ->registerCss(uniqid(),$text);
		}	
	}
}
?>
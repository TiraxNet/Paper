<?php
/**
 * update template action
 * @package Paper.admin.actions
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class UpdateAction extends CAction{
	
	/**
	 * Template id will be stored here
	 * @var string
	 */
	public $tmp;
	/**
	 * Template type will be stored here
	 * @var string
	 */
	public $type;
	/**
	 * Template class will be stored here
	 * @var GTemplate
	 */
	public $GTemp;
	/**
	 * JavaScript Code will be stored here
	 * @var string
	 */
	public $script;
	
	/**
	 * Run action!
	 * @param string $id	Get template id form request
	 * @param string $type	Get template type form request
	 */
	public function run($id,$type='index'){
		$this->tmp=$id;
		$this->type=$type;
		$this->GTemp=GTemplate::FindById($id);
		$this->RenderScript();
		$urls=$this->CreateUrlsScript();
		$this->controller->render("update",array(
												 'gtemp'=>$this->GTemp,
												 'types'=>GTemplate::GetTypes($id),
												 'urls'=>$urls
											  )
								  );
		
	}
	public function RenderScript(){
		$ImgURL=$this->controller->createUrl("AdminImg/FullTmp",array('id'=>$this->tmp,'type'=>$this->type));
		$NewURL=$this->controller->createUrl("block/new",array('tmp'=>$this->tmp));
		$tmp = $this->tmp;
		$script = 
<<<END
gc.init($tmp,'$ImgURL');
END;
		Yii::app()->clientScript->registerScript(uniqid(), $script);
	}
	public function CreateUrlsScript(){
		$urls="var URLs={}\n";
		$urls.="URLs.JsonList = '".$this->getController()->createUrl("block/JsonList")."';";
		$urls.="URLs.SavePos = '".$this->getController()->createUrl("block/savePos")."';";
		$urls.="URLs.blockOptions = '".$this->getController()->createUrl("block/blockOptions")."';";
		$urls.="URLs.saveNew = '".$this->getController()->createUrl("block/saveNew")."';";
		$urls.="URLs.SavePos = '".$this->getController()->createUrl("block/savePos")."';";
		$urls.="URLs.base = '".Yii::app()->baseUrl."';";
		return $urls;
	}
	
}
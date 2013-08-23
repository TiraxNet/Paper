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
		$this->controller->render("update",array(
												 'gtemp'=>$this->GTemp,
												 'types'=>GTemplate::GetTypes($id),
											  )
								  );
		
	}
	public function RenderScript(){
		$this->GTemp->RenderStructure();
		$blocks=$this->GTemp->blocks->GetAll();
		$_barray=array();
		foreach ($blocks as $block){
			if ($block->auto==false){
				array_push($_barray, array('id'=>$block->id,
										   'x1'=>$block->x1,
										   'y1'=>$block->y1,
										   'x2'=>$block->x2,
										   'y2'=>$block->y2,
										   'href'=>$this->controller->createUrl("block/edit",array('tmp'=>$this->tmp,'block'=>$block->id))
				));
			}
		}
		JSON::sendArrayToJS('blocks', $_barray);
		$ImgURL=$this->controller->createUrl("AdminImg/FullTmp",array('id'=>$this->tmp,'type'=>$this->type));
		$script = 
<<<END
jc.start('mainCanvas',true);
var GC=new GCTmpEdit();
GC.addBackImg('$ImgURL');
GC.addAllBlocks(blocks);
//GC.activeBlock(106);
END;
		Yii::app()->clientScript->registerScript(uniqid(), $script);
	}
	
}
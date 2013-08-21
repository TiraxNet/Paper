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
		$ImgURL=$this->controller->createUrl("AdminImg/FullTmp",array('id'=>$id,'type'=>$type));
		$this->RenderScript();
		$this->controller->render("update",array('script'=>$this->script,
												 'ImgURL'=>$ImgURL,
												  'tmpId'=>$id,
												 'types'=>GTemplate::GetTypes($id),
											  )
								  );
		
	}
	public function RenderScript(){
		$this->GTemp->RenderStructure();
		$blocks=$this->GTemp->blocks->GetAll();
		foreach ($blocks as $block){
			if ($block->auto==true) continue;
			$script.='GC.addBlock('.$block->x1.','.$block->y1.','.$block->x2.','.$block->y2.',"'.$block->id.'");';
		}
		$this->script=$script;
	}
	
}
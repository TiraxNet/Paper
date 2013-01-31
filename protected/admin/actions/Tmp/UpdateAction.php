<?php
/**
 * Admin, update template action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class UpdateAction extends GAdminAction{
	
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
	 * Template GClass will be stored here
	 * @var string
	 */
	public $GC;
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
		$this->init();
		$this->tmp=$id;
		$this->type=$type;
		$this->GC=new GClass($id);
		$ImgURL=$this->controller->createUrl("Img/FullTmp",array('tmp'=>$id,'type'=>$type));
		$this->RenderScript();
		$this->controller->render("update",array('script'=>$this->script,
												 'ImgURL'=>$ImgURL,
												 'types'=>GTemplate::GetTypes($id),
											  )
								  );
		
	}
	public function RenderScript(){
		$blocks=$this->GC->blocks;
		$script='XOffset = $("#MainIMG").offset().left;
				YOffset = $("#MainIMG").offset().top;
				$(\'#MainIMG\').ready(function(){
					update();
				});
				';
		$script.='var blocks=[';
		$first=true;
		foreach ($blocks as $block){
			if ($block->auto==true) continue;
			if ($first==false) $script.=',';
			else $first=false;
			$script.='['.$block->x1.','.$block->y1.','.$block->x2.','.$block->y2.']';
		}
		$script.="];\n";
		$script.="function update(){\n";
		$blocks=$this->GC->blocks;
		foreach ($blocks as $block){
			if ($block->auto==true) continue;
			$script.='$("body").append(\'<a href="'
				.$this->controller->createUrl("block/edit",array('tmp'=>$this->tmp,'block'=>$block->id))
				.'" id="'
				.$block->name.'"></a>\');$("#'
				.$block->name.'").addClass("WidgetBox").css({width:"'
				.$block->width.'px",height:"'
				.$block->height.'px",top:YOffset+'
				.$block->y1.',left:XOffset+'
				.$block->x1.',});';
		}
		$script.='}';
		$this->script=$script;
	}
	
}
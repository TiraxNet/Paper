<?php
/**
 * Admin Creatig new block action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class NewAction extends GAdminAction{
	
	/**
	 * Template id
	 * @var string
	 */
	public $tmp;
	/**
	 * GClass of template
	 * @var GClass
	 */
	public $GC;
	/**
	 * Stores page script; "RenderScript" function fill it.
	 * @var string
	 */
	public $script;
	
	/**
	 * Run New Block Action
	 * @param string $tmp Gets Template id from request url
	 */
	public function run($tmp){
		$this->init();
		$this->tmp=$tmp;
		$this->GC=new GClass($tmp);
		$ImgURL=$this->controller->createUrl("Img/FullTmp",array('tmp'=>$tmp));
		$this->RenderScript();
		$this->controller->render("new",array(
												'script'=>$this->script,
												'ImgURL'=>$ImgURL
											  )
								  );
	}
	/**
	 * Renders JavaScript code of Block editing page and save it in $this->scripr
	 */
	public function RenderScript(){
		$blocks=$this->GC->blocks;
		$script='$(\'#MainIMG\').ready(function(){
					ready();
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
			$script.='$("body").append(\'<div id="'
				.$block->name.'"></div>\');$("#'
				.$block->name.'").addClass("WidgetBox").css({width:"'
				.$block->width.'px",height:"'
				.$block->height.'px",top:YOffset+'
				.$block->y1.',left:XOffset+'
				.$block->x1.',});';
		}
		$script.='NewReady();';
		$script.='}';
		$this->script=$script;
	}
	
}
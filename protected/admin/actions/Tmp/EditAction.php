<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class EditAction extends GAdminAction{
	
	public $tmp;
	public $GC;
	public $script;
	
	public function run($tmp){
		$this->init();
		$this->tmp=$tmp;
		$this->GC=new GClass($tmp);
		$ImgURL=$this->controller->createUrl("Img/FullTmp",array('tmp'=>$tmp));
		$this->RenderScript();
		$this->controller->render("edit",array('script'=>$this->script,
												'ImgURL'=>$ImgURL
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
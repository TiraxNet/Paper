<?php

/**
 * Admin, Block editing action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class EditAction extends GAdminAction{
	/**
	 * Template id
	 * @var string
	 */
	public $tmp;
	/**
	 * Template class
	 * @var GTemplate
	 */
	public $GTemp;
	/**
	 * GBlock Class of editing block
	 * @var GBlock
	 */
	public $spblock;
	/**
	 * Stores page script; "RenderScript" function fill it.
	 * @var string
	 */
	public $script;
	
	/**
	 * Run Block Editing Action
	 * 
	 * @param string $tmp Gets Template id from request url
	 * @param string $block Gets Block id from request url
	 */
	public function run($tmp,$block){
		$this->controller->Action=$this;
		$this->tmp=$tmp;
		$this->GTemp=GTemplate::FindById($tmp);
		$this->spblock=GBlock::FindById($block);
		$ImgURL=$this->controller->createUrl("Img/FullTmp",array('id'=>$tmp));
		$this->RenderScript();
		$this->controller->render("edit",array(
												'script'=>$this->script,
												'ImgURL'=>$ImgURL
											  )
								  );
	}
	/**
	 * Renders JavaScript code of Block editing page and save it in $this->scripr
	 */
	public function RenderScript(){
		$this->GTemp->RenderStructure();
		$blocks=$this->GTemp->blocks;
		$script='$(\'#MainIMG\').ready(function(){
					ready();
					update();
				});
				';
		$script.='var blocks=[';
		$first=true;
		foreach ($blocks as $block){
			if ($block->id==$this->spblock->id){continue;}
			if ($block->auto==true) continue;
			if ($first==false) $script.=',';
			else $first=false;
			$script.='['.$block->x1.','.$block->y1.','.$block->x2.','.$block->y2.']';
		}
		$script.="];\n";
		
		$script.="function update(){\n";
		$blocks=$this->GTemp->blocks;
		$spblock=$this->spblock;
		foreach ($blocks as $block){
			if ($block->id==$spblock->id) {continue;}
			if ($block->auto==true) continue;
			$script.='$("body").append(\'<div id="'
				.$block->name.'"></div>\');$("#'
				.$block->name.'").addClass("WidgetBox").css({width:"'
				.$block->width.'px",height:"'
				.$block->height.'px",top:YOffset+'
				.$block->y1.',left:XOffset+'
				.$block->x1.',});';
		}
		$script.='EditReady('.$spblock->x1.','.$spblock->y1.','.$spblock->x2.','.$spblock->y2.");\n";
		$script.='}';
		$this->script=$script;
	}
	/**
	 * Creates & insert Block Options panel.
	 */
	public function OptionsDialog(){
		?>
		<div id="OptionsDialog" class="modal fade" style="display: none;">
	        <div class="modal-header"> 
	            <a class="close" data-dismiss="modal">&times;</a>
	            <h3>One Step to Save...</h3>
	        </div>
	        <div class="modal-body">
	        <?php $this->RenderWidgetOptions(); ?>
	        </div>
        </div> 
		<?php
     }
     /**
      * Render Widget Options, This function is used in "OptionsDialog()"
      */
	 public function RenderWidgetOptions(){
	 	$block=$this->spblock;
	 	$widget=$block->WidgetClass();
		$Arg=new GWOptionsArguments;
		$Arg->action=$this->controller->createUrl("block/SaveEdit",array('block'=>$this->spblock->id));
		$FormModel=$widget->FormModel();
		if (!$FormModel){
			echo 'No Options';
			return false;
		}
		foreach ($FormModel->attributes as $var=>$tmp){
			if ($widget->GetOpt($var)){
				$FormModel->$var=$widget->GetOpt($var);
			}
		}
		$Arg->FormModel=$FormModel;
		$widget->RenderOptions($Arg); 
	 }
	
}

/**
 * A Class to Save Windget Option Argument.
 * @author Mohammad Hosein Saadatfar
 *
 */
class GWOptionsArguments{
	public $action;
	public $FormModel;
}

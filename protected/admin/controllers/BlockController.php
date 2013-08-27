<?php
/**
 * Admin Block managment controller
 * @package Paper.admin.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensources.org/licenses/bsd-license.php New BSD License
 *
 */
class BlockController extends CController
{
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Block Managment';
	/**
	 * Control will be added to Menu by layout
	 * @var string
	 */
	public $control='';
	/**
	 * Get New Block Options and save It!
	 */
    public function actionSaveNew(){
    	$block=new GBlock();
    	$block->name=$_POST['NewBlockModel']['name'];
    	$block->widget=$_POST['NewBlockModel']['widget'];
    	$block->x1=$_POST['x'];
    	$block->y1=$_POST['y'];
    	$block->x2=$_POST['x']+$_POST['width'];
    	$block->y2=$_POST['y']+$_POST['height'];
    	$block->tmp=$_POST['id'];
    	$id=$block->SaveNew();
    	$msg['m']="New Block saved successfully.";
    	$msg['t']='s';
    	JSON::sendToPage($msg);
    }
    /**
     * Print template block list as json object
     * @param string $id block id
     */
    public function actionJsonList($id){
    	$tmp=GTemplate::FindById($id);
    	$blocks=$tmp->blocks->GetAll();
    	$_barray=array();
    	foreach ($blocks as $block){
    		if ($block->auto==false){
    			array_push($_barray, array('id'=>$block->id,
    			'x1'=>$block->x1,
    			'y1'=>$block->y1,
    			'x2'=>$block->x2,
    			'y2'=>$block->y2,
    			'href'=>$this->createUrl("block/edit",array('tmp'=>$tmp->id,'block'=>$block->id))
    			));
    		}
    	}
    	JSON::sendToPage($_barray);
    }
    /**
     * Get block position and save it
     * @param string $block
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     */
    public function actionSavePos($block,$x,$y,$width,$height){
    	$block=GBlock::FindById($block);
    	if ($width==0){
    		$block->delete();
    		$msg['m']="Deleted Successfully.";
    	}else{
	    	$block->x1=$x;
	    	$block->y1=$y;
	    	$block->x2=$x+$width;
	    	$block->y2=$y+$height;
	    	$block->Save();
	    	$msg['m']="Changed Successfully.";
    	}
    	$msg['t']='s';
    	JSON::sendToPage($msg);
    }
    /**
     * Print Block options form
     * @param string $block block id
     */
    public function actionBlockOptions($block){
    	$block=GBlock::FindById($block);
    	$widget=$block->WidgetClass();
    	$Arg=new GWOptionsArguments;
    	$Arg->action=$this->createUrl("block/SaveOptions",array('block'=>$block->id));
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
    /**
     * Get Block options and save it
     * @param string $block block id
     */
    public function actionSaveOptions($block){
    	$block=GBlock::FindById($block);
    	$widget=$block->WidgetClass();
    	$formname=get_class($widget->FormModel());
    	//if (!array_key_exists($formname,$_POST)) return false;
    	$str=$widget->AnalizeOptions($_POST[$formname]);
    	$block->opt=$str;    	
    	$block->save();
    	$msg['m']="Options Saved Successfully.";
    	$msg['t']='s';
    	JSON::sendToPage($msg);
    }
	
}


<?php
/**
 * This Class provides all we need to work with Blocks.
 * @author Mohammad Hosein Saadatfar
 *
 */
class GBlock{
	/**
	 * Block id
	 * @var string
	 */
	public $id;
	/**
	 * Block name
	 * @var string
	 */
	public $name;
	/**
	 * Block Start X
	 * @var integer
	 */
	public $x1;
	/**
	 * Block End X
	 * @var integer
	 */
	public $x2;
	/**
	 * Block Start Y
	 * @var integer
	 */
	public $y1;
	/**
	 * Block End Y
	 * @var integer
	 */
	public $y2;
	/**
	 * Block Options
	 * @var string
	 */
	public $opt;
	/**
	 * Block Template id
	 * @var string
	 */
	public $tmp;
	/**
	 * Block Parent id
	 * @var string
	 */
	public $parent;
	/**
	 * Block Widget
	 * @var string
	 */
	public $widget;
	/**
	 * Block Width
	 * @var integer
	 */
	public $width;
	/**
	 * Block Height
	 * @var integer
	 */
	public $height;
	/**
	 * Block Colspan
	 * @var integer
	 */
	public $colspan;
	/**
	 * Block Rowspan
	 * @var string
	 */
	public $rowspan;
	/**
	 * Shows block is auto made or not.
	 * @var bool
	 */
	public $auto;
	/**
	 * Block Template GClass
	 * @var GClass
	 */
	public $GC;
	/**
	 * GBlock Constructor
	 * @param GClass $GC Block Template GClass 
	 */
	public function __construct($GC=NULL){
		$this->GC=$GC;
	}
	/**
	 * Fill Parameters from an array.
	 * @param array $arr parameters array
	 */
	public function SetFromArray($arr){
		foreach (get_class_vars('GBlock') as $var=>$val){
			if (array_key_exists($var,$arr)){
						$this->$var=$arr[$var];
			}
		}
		$this->width=$this->x2-$this->x1;
		$this->height=$this->y2-$this->y1;
	}
	/**
	 * Fill parameters from database active record
	 * @param CActiveRecord $db
	 */
	public function SetFromDB($db){
		$this->SetFromArray($db->getAttributes());
	}
	/**
	 * Search and fill parameters from database.
	 * @param string $id Block id 
	 */
	public static function FindById($id){
		$block=new GBlock();
		$db=blocks::model()->findByPk($id);
		if ($db==null) throw new CHttpException('10003','Block not found');
		$block->SetFromDB($db);
		return $block;
	}
	/**
	 * Saves current parameters as new block.
	 */
	public function SaveNew(){
		$db=new blocks;
		$db->name=$this->name;
		$db->widget=$this->widget;
		$db->x1=$this->x1;
		$db->y1=$this->y1;
		$db->x2=$this->x2;
		$db->y2=$this->y2;
		$db->parent=$this->parent;
		$db->tmp=$this->tmp;
		$db->save();
		$this->SetFromDB($db);

		$this->GC=new GClass($db->tmp);
		$this->width=$this->GC->blocks[$db->id]->width;
		$this->height=$this->GC->blocks[$db->id]->height;

		$this->WidgetClass()->CreateNew();
		
		return $db->id;
	}
	/**
	 * Return Widget Class of block.
	 * @return GWidget Widget Class extends of GWidget
	 */
	public function WidgetClass(){
		Yii::import("application.widgets.".".W".$this->widget);
		$cname='W'.$this->widget;
		$widget=new $cname($this->GC,$this);
		return $widget;
	}
	/**
	 * Creates Block background image based on "type" param.
	 * @param string $type Optional; if you need an special type, enter it.
	 * @return resource Created image resource handle
	 */
	public function GetImage($type=NULL){
		$GC=$this->GC;
		if ($type!=NULL){
			$hndl=imagecreatefromjpeg($GC->Pic->Address.DS.$type.".jpg");
			$width=$this->width;
			$height=$this->height;
			$hndl_dest=imagecreate($width,$height);
			imagecopymerge($hndl_dest,$hndl,0,0,$this->x1,$this->y1,$this->width,$this->height,100);
			return $hndl_dest;
		}
		$types=$this->WidgetClass()->Types();
		$hndl=imagecreatefromjpeg($GC->Pic->Address.DS.$types[0].".jpg");
		$width=(sizeof($types))*($this->width);
		$height=$this->height;
		$hndl_dest=imagecreate($width,$height);
		imagecopymerge($hndl_dest,$hndl,0,0,$this->x1,$this->y1,$this->width,$this->height,100);
		$counter=0;
		if ($types!=''){
			foreach ($types as $index => $val){
				if ($index==0) continue;
				$counter++;
				imagedestroy($hndl);
				$hndl=imagecreatefromjpeg($GC->Pic->Address.DS.$val.".jpg");
				imagecopymerge($hndl_dest,$hndl,($counter)*$this->width,0,
					$this->x1,$this->y1,$this->width,$this->height,100);
			}
		}
		return $hndl_dest;
	}
}
<?php
/**
 * This Class provides all we need to work with Blocks.
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class GBlock{
	/**
	 * Block active record
	 * @var blocks
	 */
	private $db;
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
	 * Shows if block is auto made or not.
	 * @var bool
	 */
	public $auto;
	/**
	 * Block template class
	 * @var GTemplate
	 */
	public $GTemp;
	/**
	 * GBlock Constructor
	 * @param GTemplate $GTemp Block Template class 
	 */
	public function __construct($GTemp=NULL){
		$this->GTemp=$GTemp;
		$this->db=new blocks();
	}
	/**
	 * Database getter!
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name){
		if ($this->db->hasAttribute($name)) return $this->db->$name;
		else if (method_exists($this, 'Get'.$name))
		{
			$method_name='Get'.$name;
			return $this->$method_name();
		}
		else trigger_error('Undefined property '.$name);
	}
	/**
	 * Database Setter!
	 * @param string $name
	 * @param string $value
	 */
	public function __set($name,$value){
		if ($this->db->hasAttribute($name)) $this->db->$name=$value;
		else trigger_error('Undefined property '.$name);
	}
	/**
	 * Returns block width
	 * @return number block width
	 */
	private function Getwidth() {
		return $this->x2-$this->x1;
	}
	/**
	 * Returns block height
	 * @return number block height
	 */
	private function Getheight() {
		return $this->y2-$this->y1;
	}
	/**
	 * Fill parameters from database active record
	 * @param CActiveRecord $db
	 */
	public function SetFromDB($db){
		$this->db=$db;
	}
	/**
	 * Search and fill parameters from database.
	 * @param string $id Block id 
	 */
	public static function FindById($id){
		$block=new GBlock();
		$db=blocks::model()->findByPk($id);
		if ($db==null) return null;
		$block->db=$db;
		return $block;
	}
	/**
	 * Saves current parameters as new block.
	 */
	public function SaveNew(){
		$this->db->save();
		$this->GTemp=GTemplate::FindById($this->tmp);
		$this->GTemp->RenderStructure();
		$this->WidgetClass()->CreateNew();
		return $this->db->id;
	}
	/**
	 * Save current settings in database
	 */
	public function Save(){
		$this->db->save();
	}
	/**
	 * Delete block which has current "id" parameter
	 */
	public function delete(){
		$this->db->delete();
	}
	/**
	 * Return Widget Class of block.
	 * @return GWidget Widget Class extends of GWidget
	 */
	public function WidgetClass(){
		Yii::import("application.GWidgets.".".W".$this->widget);
		$cname='W'.$this->widget;
		$widget=new $cname($this->GTemp,$this);
		return $widget;
	}
	/**
	 * Creates Block background image based on "type" param.
	 * @param string $type Optional; if you need an special type, enter it.
	 * @return resource Created image resource handle
	 */
	public function GetImage($type=NULL){
		$GTemp=$this->GTemp;
		if ($type!=NULL){
			$hndl=imagecreatefromjpeg(GTemplate::GetPath($GTemp->id).DS.$type.".jpg");
			$width=$this->width;
			$height=$this->height;
			$hndl_dest=imagecreatetruecolor($width,$height);
			imagecopy($hndl_dest,$hndl,0,0,$this->x1,$this->y1,$this->width,$this->height);
			return $hndl_dest;
		}
		$types=$this->WidgetClass()->Types();
		$hndl=imagecreatefromjpeg(GTemplate::GetPath($GTemp->id).DS.$types[0].".jpg");
		$width=(sizeof($types))*($this->width);
		$height=$this->height;
		$hndl_dest=imagecreatetruecolor($width,$height);
		imagecopy($hndl_dest,$hndl,0,0,$this->x1,$this->y1,$this->width,$this->height);
		$counter=0;
		if ($types!=''){
			foreach ($types as $index => $val){
				if ($index==0) continue;
				$counter++;
				imagedestroy($hndl);
				$hndl=imagecreatefromjpeg(GTemplate::GetPath($GTemp->id).DS.$val.".jpg");
				imagecopymerge($hndl_dest,$hndl,($counter)*$this->width,0,
					$this->x1,$this->y1,$this->width,$this->height,100);
			}
		}
		return $hndl_dest;
	}
	/**
	 * Get a block id and return folder location
	 * @param string $id block id
	 * @return Ambigous <boolean, string, mixed, multitype:string >
	 */
	public static function GetPath($id){
		return Yii::getPathOfAlias('application.GBlocks.'.$id);
	}
}
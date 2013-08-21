<?php
/**
 * This Class provides all we need to work with Templates
 * @package Paper.core
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 * @property string $id 		Template id
 * @property string $name 		Template name
 * @property string $title 		Template title
 * @property strign $css 		Template CSS
 * @property int $version 	Template version
 * @property int $width 	Template width
 * @property int $height 	Template height
 */
class GTemplate extends CComponent{
	
	/**
	 * Database active record
	 * @var templates
	 */
	private $db;
	/**
	 * Template blocks
	 * @var GBlockList
	 */
	public $_blocks=null;
	/**
	 * Template structure
	 * @var GStruct
	 */
	public $_struct=null;
	/**
	 * Constructor!
	 * @param int $id set id=null to create new one! 
	 */
	function __construct($id){
		$this->db=new templates();
		if ($id!=null){
			$this->id=$id;
			$this->_blocks=new GBlockList($this);
			Yii::app()->TempRep->Insert($this);
			$this->RenderStructure();
		}
	}
	/**
	 * Read Template attributes from database active record
	 * @param string $name
	 * @param string $value
	 */
	public function __set($name,$value){
		if ($this->db->hasAttribute($name)){
			$this->db->$name=$value;
			return;
		}
		parent::__set($name, $value);
	}
	/**
	 * Write Template attributes to database active record
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name){
		if ($this->db->hasAttribute($name)) return $this->db->$name;
		return parent::__get($name);
	}
	/**
	 * Get Blocks list
	 * @return GBlockList
	 */
	public function getblocks(){
		return $this->_blocks;
	}
	/**
	 * Get Template structure 
	 * @return GStruct 
	 */
	public function getstruct(){
		return $this->_struct;
	}
	/**
	 * Return template width
	 * @return int template width
	 */
	protected function getwidth(){
		$size=getimagesize(self::GetPath($this->id).DS.'index.jpg');
		return $size[0];
	}
	/**
	 * Return template height
	 * @return int template height
	 */
	protected function getheight(){
		$size=getimagesize(self::GetPath($this->id).DS.'index.jpg');
		return $size[1];
	}
	/**
	 * Save current parameters as new template.
	 */
	public function SaveNew(){
		$this->db->save();
		if(!@mkdir(self::GetPath($this->db->id))) throw  new CException("Could not create template directory.");
		copy(dirname(__FILE__).DS.'assets'.DS.'NewTmp.jpg',self::GetPath($this->db->id).DS.'index.jpg');
		return $this->db->id;
	}
	/**
	 * Save template changes
	 */
	public function Save(){
		$this->db->save();
	}
	/**
	 * Increase template version
	 */
	public function Increase_Version(){
		$this->db->version=$this->db->version+1;
		$this->db->save();
	}
	/**
	 * Delete template using "ID" property
	 */
	public function delete(){
		$this->db->delete();
		$dir=self::GetPath($this->db->id);
		functions::rrmdir($dir);
	}
	/**
	 * Render template structure
	 */
	public function RenderStructure()
	{
		$this->_struct=GRender::RenderStructure($this);
	}
	/**
	 * Render template & return Template Content (HTML Code)
	 * @return string
	 */
	public function GetContent()
	{
		return GRender::HTML($this);
	}
	/**
	 * Render template & return Template CSS object
	 * @return GCSS
	 */
	public function GetCSS()
	{
		return GRender::CSS($this);
	}
	/**
	 * Render template & return Template JavaScript Code
	 * @return string
	 */
	public function GetJS(){
		return GRender::JS($this);
	}
	/**
	 * Find a template by Id and return corresponding GTemplate object
	 * @param string $id Block id 
	 * @return GTemplate|null if template found, return its class else return null
	 */
	public static function FindById($id){
		$template=new GTemplate($id);
		$db=templates::model()->findByPk($id);
		if ($db==null) return null;
		$template->db=$db;
		return $template;
	}
	/**
	 * Get a template ID and return corresponding folder location
	 * @param string $id template id
	 * @return Ambigous <boolean, string, mixed, multitype:string >
	 */
	public static function GetPath($id){
		return Yii::getPathOfAlias('user.GTemplates.'.$id);
	}
	/**
	 * Scan template folder and return types
	 * @param $id Template id
	 */
	public static function GetTypes($id){
		$con=scandir(GTemplate::GetPath($id));
		$con=preg_grep('/jpg/', $con);
		foreach ($con as $key=>$val){
			$con[$key]=substr($con[$key],0,-4);
		}
		return $con;
	}
}
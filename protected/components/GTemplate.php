<?php
/**
 * This Class provides all we need to work with Templates
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 * @property string $id Template id
 * @property string $name Template name
 * @property string $title Template title
 * @property strign $css Template CSS
 * @property int 	$version Template version
 */
class GTemplate{
	
	/**
	 * Database active record
	 * @var templates
	 */
	private $db;
	
	/**
	 * Constructor!
	 */
	function __construct(){
		$this->db=new templates();
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
	 * Database getter!
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name){
		if ($this->db->hasAttribute($name)) return $this->db->$name;
		else if ($name=='db') return $this->db;
		else trigger_error('Undefined property '.$name);
	}
	/**
	 * Saves current parameters as new template.
	 */
	public function SaveNew(){
		$this->db->save();
		mkdir(self::GetPath($this->db->id));
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
	 * Delete template by current "id" parameter
	 */
	public function delete(){
		$this->db->delete();
		$dir=self::GetPath($this->db->id);
		Yii::app()->functions->rrmdir($dir);
	}
	/**
	 * Fill Parameters from an array.
	 * @param array $arr parameters array
	 */
	public function SetFromArray($arr){
		foreach ($this->db->getAttributes() as $var=>$val){
			if (array_key_exists($var,$arr)){
						$this->db->$var=$arr[$var];
			}
		}
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
		$template=new GTemplate();
		$db=templates::model()->findByPk($id);
		$template->SetFromDB($db);
		return $template;
	}
	/**
	 * Gets a template id and returns folder location
	 * @param string $id template id
	 * @return Ambigous <boolean, string, mixed, multitype:string >
	 */
	public static function GetPath($id){
		return Yii::getPathOfAlias('application.GTemplates.'.$id);
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
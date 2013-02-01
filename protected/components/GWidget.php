<?php
/**
 * This Class contains main param an methods for using Widgets and is used as extends.
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GWidget{
	/**
	 * Current Widget GTemplate
	 * @var GTemplate
	 */
	public $GTemp;
	/**
	 * Widget GBlock
	 * @var GBlock
	 */
	public $block;
	/**
	 * Widget Options array
	 * @var array
	 */
	public $opt=array();
	/**
	 * Widget Renderer will be stored here by constructor. 
	 * @var GRender
	 */
	public $Render;
	
	/**
	 * GWidget Constructor 
	 * @param GTemplate $GTemp
	 * @param GBlock $block
	 */
	function __construct($GTemp,$block){
		$this->GTemp=$GTemp;
		$this->block=$block;
		$this->Render=new GWRender($this);
		if (array_key_exists('opt',$block))
			if ($block->opt!='')
				$this->opt=unserialize($block->opt);
		if (method_exists($this,'init')) $this->init();
	}
	/**
	 * Widgets has no options in default 
	 */
	public function Options(){
	 return false;
	}
	/**
	 * Returns Form Model based on options
	 * @return FormModel
	 */
	public function FormModel(){
		$opt=$this->Options();
		if ($opt==false) return false;
		$c=new FormModel;
		foreach ($opt as $val){
			$c->$val='';
		}
		return $c;
	}
	/**
	 * Get widget option value 
	 * @param string $key
	 * @return string|bool option value if ket exsits O.W. false
	 */
	public function GetOpt($key){
		if (array_key_exists($key,$this->opt)){
			return $this->opt[$key];
		}else return false;
	}
	/**
	 * Create new Widget! 
	 * @return bool
	 */
	public function CreateNew(){
		return true;
	}
	/**
	 * Return Widget HTML code
	 * @return string Widget HTML code 
	 */
	public function Content(){
		return '';
	}
	/**
	 * Return Widget CSS code
	 * @return GCSS Widget CSS code 
	 */
	public function CSS(){
		$GTemp=$this->GTemp;
		$id=$this->block->id;
		$CSS=new GCSS();
		$img_addr=GWTools::BlockImgUrl($id,NULL,$GTemp->id);
		$CSS->Add("#".$GTemp->name."_".$id, array("background" => "url('".$img_addr."') 0px"));
		return $CSS; 	
	}
	/**
	 * Return Widget JavaScript code
	 * @return string Widget JS code 
	 */
	public function JS(){
		return '';
	}
	/**
	 * Return Widget Types as an array
	 * @return array Types
	 */
	public function Types(){
		return array('index');
	}
	/**
	 *  Render and echo Widget options
	 * @param mixed $Arg Arguments
	 */
	public function RenderOptions($Arg){
			echo 'No Options...';
	}
	/**
	 * Get options as an array and serialize it. 
	 * @param array $arr
	 * @return string serialized options
	 */
	public function AnalizeOptions($arr){
		return serialize($arr);
	}
	/**
	 * Render init!
	 * @return bool
	 */
	public function RenderInit(){return true;}
	//@TODO Complete comment description
}
/**
 * CFormModel of Widget options.
 * @author Mohammad hosein saadatfar
 *
 */
class FormModel extends CFormModel{
	/**
	 * All attributes will saves as array 
	 * @var array
	 */
	public $attributes=array();
	/**
	 * (non-PHPdoc)
	 * @see CComponent::__get()
	 */
	public function __get($name){
		return $this->attributes[$name];
	}
	/**
	 * (non-PHPdoc)
	 * @see CComponent::__set()
	 */
	public function __set($name, $value){
		$this->attributes[$name]=$value;
	}
}

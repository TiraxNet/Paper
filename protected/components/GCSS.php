<?php
/**
 * provide all we need to work with CSS.
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GCSS{
	/**
	 * All CSS data stores in this array.
	 * @var array
	 */
	public $CSS=array();
	/**
	 * Add or complete or change an element in CSS list. 
	 * @param string $Element
	 * @param array $CSS
	 */
	public function Add($Element,$CSS){
		foreach ($CSS as $key=>$val){
			if (array_key_exists($Element,$this->CSS)){
				$this->CSS[$Element][$key]=$val;
			}else{
				$this->CSS[$Element]=array();
				$this->CSS[$Element][$key]=$val;
			}
		}
	}
	/**
	 * Merge another CSS class in corrent CSS Class.
	 * @param GCSS $CSS
	 */
	public function merge($CSS){
		foreach ($CSS->CSS as $Element=>$val){
			$this->Add($Element, $val);
		}
	}
	/**
	 * Returns CSS Standard code
	 * @return string CSS standard code
	 */
	public function Render(){
		$txt='';
		foreach($this->CSS as $name => $body){
			$txt.=$name."{\n";
			foreach ($body as $index => $val){
				$txt.="\t".$index.": ".$val.";\n";
			}
			$txt.="}\n";
		}
		return $txt;
	}
}
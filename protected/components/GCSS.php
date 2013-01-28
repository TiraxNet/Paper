<?php
/**
 * * This Class provides all we need to work with CSS.
 * @author Mohammad hosein saadatfar
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
}
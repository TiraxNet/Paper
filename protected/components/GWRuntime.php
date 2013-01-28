<?php
/**
 * GWRuntime
 * @author Mohammad hosein Saadatfar
 *
 */
class GWRuntime{
	/**
	 * List
	 * @var array
	 */
	public $List=array();
	/**
	 * init
	 */
	function init(){
		$this->RenderList();
	}
	/**
	 * RenderList
	 */
	public function RenderList(){
		$db=widgets::model()->findAll('1');
		foreach ($db as $key=>$val){
			array_push($this->List,array('PathName'=>$val->pathname,'Name'=>$val->name));
		}
	}
	/**
	 * Get an xml file location and return XML Element
	 * @param string $xml xml file location
	 * @return SimpleXMLElement
	 */
	public function xml($xml){
		$xml_body=file_get_contents($xml);
        return new SimpleXMLElement($xml_body);
	}
	/**
	 * Convert SimpleXMLElement to array
	 * @param SimpleXMLElement $xml
	 * @return array
	 */
	public function xml2array($xml) {
	   if (get_class($xml) == 'SimpleXMLElement') {
		   $attributes = $xml->attributes();
		   foreach($attributes as $k=>$v) {
			   if ($v) $a[$k] = (string) $v;
		   }
		   $x = $xml;
		   $xml = get_object_vars($xml);
	   }
	   if (is_array($xml)) {
		   if (count($xml) == 0) return (string) $x;
		   foreach($xml as $key=>$value) {
			   $r[$key] = $this->xml2array($value);
		   }
		   if (isset($a)) $r['@'] = $a;
		   return $r;
	   }
	   return (string) $xml;
	}
}
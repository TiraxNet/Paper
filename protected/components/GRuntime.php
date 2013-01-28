<?php
/**
 * This class runs at start and creates proper GClass 
 * @author Mohammad hosein saadatfar
 *
 */
class GRuntime{
	/**
	 * Runtime GClass
	 * @var GClass
	 */
	public $GC;
	/**
	 * Get template id from request, create and save it in $this->GC 
	 */
	function init(){
		$tmp=yii::app()->getRequest()->getQuery("tmp","1");
		$this->GC=new GClass($tmp);
	}
	/**
	 * Return GClass
	 * @return GClass Current GC 
	 */
	function getGC(){
		return $this->GC;
	}
		
	
}
<?php
/**
 * This class runs at start and creates proper GClass
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GRuntime{
	/**
	 * Runtime GTemplate
	 * @var GTemplate
	 */
	public $GTemp;
	/**
	 * Get template id from request, create and save it in $this->GTemp 
	 */
	function init(){
		$id=yii::app()->getRequest()->getQuery("id","1");
		$this->GTemp=GTemplate::FindById($id);
		if ($this->GTemp==null) throw new CHttpException('10001','Template not found');
	}
	/**
	 * Return GTemplate
	 * @return GTemplate Current GTemplate 
	 */
	function getTemp(){
		return $this->GTemp;
	}
		
	
}
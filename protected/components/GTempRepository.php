<?php
/**
 * A copy of all loaded templates will be stored here
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @package 
 * @copyright Copyright &copy; 2012, TiraxNet Software Group
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GTempRepository extends CApplicationComponent{
	/**
	 * Template repository array
	 * @var GTemplate[]
	 */
	private $_TmpRep=array();
	/**
	 * Insert template to repository
	 * @param GTemplate $GTemp
	 */
	public function Insert($GTemp){
		$this->_TmpRep[$GTemp->id]=$GTemp;
	}
	/**
	 * Get template from repository by id
	 * @param string $id
	 * @return GTemplate[]|NULL
	 */
	public function GetById($id){
		if (array_key_exists($id, $this->_TmpRep)) return $this->_TmpRep[$id];
		return null;
	}
}
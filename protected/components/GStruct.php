<?php
/**
 * This Class Gernerates and Stores Template table structure
 * @package Paper.core
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * 
 * @property int[] $XPoints Array of columns break points
 * @property int[] $YPoints Array of rows break points
 */
class GStruct extends CComponent{
	/**
	 * Array of columns break points
	 * @varstructure int[]
	 */
	private $_XPoints=null;
	/**
	 * Array of rows break points
	 * @var int[]
	 */
	private $_YPoints=null;
	/**
	 * Template table Structure 2-dimensional array
	 * @var string[][]
	 */
	private $TableStruct=null;
	/**
	 * Return array of columns break points
	 * @return array
	 */
	protected function getXPoints(){
		return $this->_XPoints;
	}
	/**
	 * Return array of rows break points
	 * @return array
	 */
	protected function getYPoints() {
		return $this->_YPoints;
	}
	/**
	 * Return given row->column block id
	 * @param int $row Row number starting from 0
	 * @param int $col Cell number starting from 0
	 * @return GBlock
	 */
	public function GetCellBlockId($row,$col){
		$id=$this->TableStruct[$row][$col];
		return $id;
	}
	/**
	 * Return given row->column block id
	 * @param int $row Row number starting from 0
	 * @param int $col Cell number starting from 0
	 * @return string
	 */
	public function GetCellId($row,$col) {
		return $this->TableStruct[$row][$col];
	}
	/**
	 * Return given row structure
	 * @param int $num Row number starting from 0
	 * @return string[]
	 */
	public function GetRowIds($num) {
		return $this->TableStruct[$num];
	}
	/**
	 * Count and return number of rows in Template table
	 * @return int
	 */
	public function CountRows() {
		return count($this->TableStruct);
	}
	/**
	 * Count and return number of cells in given row
	 * @param int $row Row number startin from 0
	 * @return int
	 */
	public function CountCells($row) {
		return count($this->TableStruct[$row]);
	}
	/**
	 * Return template table Structure 2-dimensional array
	 * @return string[][]
	 */
	public function GetTableStruct(){
		return $this->TableStruct;
	}
	public function setXPoints($value){
		$this->_XPoints=$value;
	}
	public function setYPoints($value){
		$this->_YPoints=$value;
	}
	public function setTableStruct($value){
		$this->TableStruct=$value;
	}
	
}
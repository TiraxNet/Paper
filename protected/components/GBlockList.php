<?php
/**
 * It's a block repository
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GBlockList{
	/**
	 * It's our block repository!
	 * @var GBlock[]
	 */
	private $BlockList=null;
	/**
	 * Template class
	 * @var GTemplate
	 */
	public $GTemp;
	/**
	 * GBlock list Contructor!
	 * @param GTemplate $GTemp Template object
	 */
	public function __construct($GTemp) {
		$this->GTemp=$GTemp;
	}
	public function Initialize() {
		
	}
	/**
	 * Return block which has given id
	 * @param string $id Block id
	 * @return GBlock|NULL Block object if found, else null
	 */
	public function GetById($id){
		if ($this->BlockList==null) $this->GTemp->RenderStructure();
		if (array_key_exists($id, $this->BlockList)) return $this->BlockList[$id];
		return null;	
	}
	/**
	 * Return block which has given attributes
	 * @param array $attr attribues array. ex: array('x1'=>100,'x2'=>50)
	 * @return GBlock|NULL Block object if found, else null
	 */
	public function GetByAttr($attr) {
		if ($this->BlockList==null) $this->GTemp->RenderStructure();
		foreach($this->BlockList as $id => $block) {
			$found=true;
			foreach ($attr as $key=>$val) {
				if ($block->$key != $val) {
					$found=false;
					break;
				}		
			}
			if ($found==true) {
				return $block;
			}
		}
		return null;
	}
	/**
	 * Insert new block object in block list
	 * @param GBlock $Block Block object to insert
	 */
	public function Insert($Block){
		$this->BlockList[$Block->id]=$Block;
	}
	/**
	 * Insert one or an array of Blocks based on given active record(s).
	 * @param CActiveRecord|CActiveRecord[] $dbblocks Block active record object or an array of records
	 * @param array $attr Function applies these attributes on GBlock object before insert. ex: array('auto'=>true)
	 */
	public function InsertFromDb($dbblocks,$attr=array()){
		if (!is_array($dbblocks)) $dbblocks=array($dbblocks);
		foreach ($dbblocks as $record){
			$block=new GBlock($this->GTemp);
			$block->SetFromDB($record);
			foreach ($attr as $key=>$val){
				$block->$key=$val;
			}
			$this->Insert($block);
		}
	}
	/**
	 * Return all blocks in an array.
	 * @return GBlock[] All blocks array.
	 */
	public function GetAll() {
		if ($this->BlockList==null) $this->GTemp->RenderStructure();
		return $this->BlockList;
	}
}
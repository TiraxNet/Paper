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
	 * Structure Template object
	 * @var GTemplate
	 */
	private $GTemp;
	/**
	 * Construct GStruct
	 * @param GTemplate $GTemp Structure Template object
	 */
	public function __construct($GTemp) {
		$this->GTemp=$GTemp;
	}
	/**
	 * Return array of columns break points
	 * @return array
	 */
	protected function getXPoints(){
		if ($this->_XPoints==null) {
			$this->RenderPoints();
		}
		return $this->_XPoints;
	}
	/**
	 * Return array of rows break points
	 * @return array
	 */
	protected function getYPoints() {
		if ($this->_YPoints==null) {
			$this->RenderPoints();
		}
		return $this->_YPoints;
	}
	/**
	 * Return given row->column block object
	 * @param int $row Row number starting from 0
	 * @param int $col Cell number starting from 0
	 * @return GBlock
	 */
	public function GetCellBlock($row,$col){
		if ($this->TableStruct==false) {
			$this->GTemp->RenderStructure();
		}
		$id=$this->TableStruct[$row][$col];
		return $this->GTemp->blocks->GetById($id);
	}
	/**
	 * Return given row->column block id
	 * @param int $row Row number starting from 0
	 * @param int $col Cell number starting from 0
	 * @return string
	 */
	public function GetCellId($row,$col) {
		if ($this->TableStruct==false) {
			$this->GTemp->RenderStructure();
		}
		return $this->TableStruct[$row][$col];
	}
	/**
	 * Return given row structure
	 * @param int $num Row number starting from 0
	 * @return string[]
	 */
	public function GetRowIds($num) {
		if ($this->TableStruct==false) {
			$this->GTemp->RenderStructure();
		}
		return $this->TableStruct[$num];
	}
	/**
	 * Count and return number of rows in Template table
	 * @return int
	 */
	public function CountRows() {
		if ($this->TableStruct==false) {
			$this->GTemp->RenderStructure();
		}
		return count($this->TableStruct);
	}
	/**
	 * Count and return number of cells in given row
	 * @param int $row Row number startin from 0
	 * @return int
	 */
	public function CountCells($row) {
		if ($this->TableStruct==false) {
			$this->GTemp->RenderStructure();
		}
		return count($this->TableStruct[$row]);
	}
	/**
	 * Return template table Structure 2-dimensional array
	 * @return string[][]
	 */
	public function GetTableStruct(){
		if ($this->TableStruct==false) {
			$this->GTemp->RenderStructure();
		}
		return $this->TableStruct;
	}
	/**
	 * Render Template Structures, this rendering should be done before any other template rendering
	 */
	public function RenderStructure(){
		$dbblocks=blocks::model()->findAll('tmp='.$this->GTemp->id);
		$this->GTemp->blocks->InsertFromDb($dbblocks,array('auto'=>false));
		
		$x_points=$this->XPoints;
		$y_points=$this->YPoints;
		
	
		$MHelp=array_fill(0, sizeof($x_points),
				array_fill(0, sizeof($y_points,0), 0)
		);
		foreach ($this->GTemp->blocks->GetAll() as $block){
			$x=0;
			while($x_points[$x]!=$block->x1) $x++;
			$y=0;
			while($y_points[$y]!=$block->y1) $y++;
			for ($i=0;$i<$block->colspan;$i++){
				for ($j=0;$j<$block->rowspan;$j++){
					$MHelp[$x+$i][$y+$j]=1;
				}
			}
		}
		$table_struct=array();
		for ($row=0;$row<sizeof($y_points)-1;$row++){
			$table_row=array();
			for ($col=0;$col<sizeof($x_points)-1;$col++){
				if ($MHelp[$col][$row]==0){
					$i=0;
					if ($row==sizeof($y_points)-2){
						$MHelp[$col][$row]=1;
						$i=1;
					}else{
						while($MHelp[$col+$i][$row]==0 && ($col+$i)<(sizeof($x_points)-1)){
							$MHelp[$col+$i][$row]=1;
							$i++;
						}
					}
					$j=1;
					$block=new GBlock($this->GTemp);
					$block->name=$row.'_'.$col;
					$block->id='A_'.$block->name;
					$block->x1=$x_points[$col];
					$block->y1=$y_points[$row];
					$block->x2=$x_points[$col+$i];
					$block->y2=$y_points[$row+$j];
					$block->widget="none";
					$block->auto=true;
					$this->GTemp->blocks->Insert($block);
					array_push($table_row,$block->id);
				}else{
					$inMap=$this->GTemp->blocks->GetByAttr(array(
							'x1'=>$x_points[$col],
							'y1'=>$y_points[$row]
					));
					if ($inMap!=null) array_push($table_row,$inMap->id);
				}
			}
			array_push($table_struct,$table_row);
		}
		$this->TableStruct=$table_struct;
	}
	/**
	 * Render columns and rows  points
	 */
	public function RenderPoints(){
		$XPoints=array(0,$this->GTemp->width);
		$YPoints=array(0,$this->GTemp->height);
		foreach ($this->GTemp->blocks->GetAll() as $Mobject){
			array_push($XPoints,$Mobject->x1);
			array_push($XPoints,$Mobject->x2);
			array_push($YPoints,$Mobject->y1);
			array_push($YPoints,$Mobject->y2);
		}
		sort($XPoints,SORT_NUMERIC);
		sort($YPoints,SORT_NUMERIC);
		$XPoints=array_values(array_unique($XPoints,SORT_NUMERIC));
		$YPoints=array_values(array_unique($YPoints,SORT_NUMERIC));
		$this->_XPoints=$XPoints;
		$this->_YPoints=$YPoints;
	}
	
}
<?php
/**
 * This Class is used to render a Template
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GRender{
	/**
	 * GTemplate to render
	 * @var GTemplate
	 */
	private $GTemp;
	/**
	 * Table structure array
	 * @var string[][]
	 */
	private $structure=null;
	/**
	 * GRender Constructor
	 * @param GTemplate $GTemp
	 */
	function __construct($GTemp){
		$this->GTemp=$GTemp;
	}
	/**
	 * Render Template Structures, this rendering should be done before any other template rendering
	 */
	public function RenderStructure(){
		$dbblocks=blocks::model()->findAll('tmp='.$this->GTemp->id);
		$this->GTemp->blocks->InsertFromDb($dbblocks,array('auto'=>false));
		$break_points=array('x'=>array(0,$this->GTemp->width),'y'=>array(0,$this->GTemp->height));
		foreach ($this->GTemp->blocks->GetAll() as $Mobject){
			array_push($break_points['x'],$Mobject->x1);
			array_push($break_points['x'],$Mobject->x2);
			array_push($break_points['y'],$Mobject->y1);
			array_push($break_points['y'],$Mobject->y2);
		}
		sort($break_points['x'],SORT_NUMERIC);
		sort($break_points['y'],SORT_NUMERIC);
		
		$break_points['x']=array_values(array_unique($break_points['x'],SORT_NUMERIC));
		$break_points['y']=array_values(array_unique($break_points['y'],SORT_NUMERIC));
		foreach($this->GTemp->blocks->GetAll() as $index => $Mobject){
			$i=0;
			$j=0;
			while($break_points['x'][$i]!=$Mobject->x1) $i++;
			while($break_points['x'][$i+$j]!=$Mobject->x2) $j++;
			$this->GTemp->blocks->GetById($index)->colspan=$j;
			$i=0;
			$j=0;
			while($break_points['y'][$i]!=$Mobject->y1) $i++;
			while($break_points['y'][$i+$j]!=$Mobject->y2) $j++;
			$this->GTemp->blocks->GetById($index)->rowspan=$j;
		}
		$MHelp=array_fill(0, sizeof($break_points['x']),
				array_fill(0, sizeof($break_points['y'],0), 0)
		);
		foreach ($this->GTemp->blocks->GetAll() as $block){
			$x=0;
			while($break_points['x'][$x]!=$block->x1) $x++;
			$y=0;
			while($break_points['y'][$y]!=$block->y1) $y++;
			for ($i=0;$i<$block->colspan;$i++){
				for ($j=0;$j<$block->rowspan;$j++){
					$MHelp[$x+$i][$y+$j]=1;
				}
			}
		}
		$table_struct=array();
		for ($row=0;$row<sizeof($break_points['y'])-1;$row++){
			$table_row=array();
			for ($col=0;$col<sizeof($break_points['x'])-1;$col++){
				if ($MHelp[$col][$row]==0){
					$i=0;
					if ($row==sizeof($break_points['y'])-2){
						$MHelp[$col][$row]=1;
						$i=1;
					}else{
						while($MHelp[$col+$i][$row]==0 && ($col+$i)<(sizeof($break_points['x'])-1)){
							$MHelp[$col+$i][$row]=1;
							$i++;
						}
					}
					$j=1;
					$block=new GBlock($this->GTemp);
					$block->name=$row.'_'.$col;
					$block->id='A_'.$block->name;
					$block->x1=$break_points['x'][$col];
					$block->y1=$break_points['y'][$row];
					$block->x2=$break_points['x'][$col+$i];
					$block->y2=$break_points['y'][$row+$j];
					$block->colspan=$i;
					$block->rowspan=$j;
					$block->widget="none";
					$block->auto=true;
					$this->GTemp->blocks->Insert($block);
					array_push($table_row,$block->id);
				}else{
					$inMap=$this->GTemp->blocks->GetByAttr(array(
															'x1'=>$break_points['x'][$col],
															'y1'=>$break_points['y'][$row]
														   ));
					if ($inMap!=null) array_push($table_row,$inMap->id);
				}
			}
			array_push($table_struct,$table_row);
		}
		$this->structure=$table_struct;
	}
	/**
	 * Search for a block that starts from given locations
	 * @return int|false
	 */
	private function findBlockFromStart($x,$y){
		foreach($this->GTemp->blocks->GetAll() as $index => $Mobject){
			if ( $Mobject->x1==$x && $Mobject->y1==$y){
				return $index;
			}
		}
		return null;
	}
	/**
	 * Render HTML code 
	 * @return string Rendered HTML code
	 */
	public function HTML(){
		if ($this->structure==null) $this->RenderStructure();
		$GTemp=$this->GTemp;
		$HTML='<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="';
		$HTML.=$GTemp->width.'">'."\n";
		$table_struct=$this->structure;
		$srow=$table_struct[0];
		foreach ($table_struct as $index => $tr){
			$HTML.="<tr>\n";
			foreach ($tr as $td){
				$width=$GTemp->blocks->GetById($td)->width;
				$height=$GTemp->blocks->GetById($td)->height;
				$colspan=$GTemp->blocks->GetById($td)->colspan;
				$rowspan=$GTemp->blocks->GetById($td)->rowspan;
				$HTML.='<td id="'.$GTemp->name.'_'.$td.'" colspan="'.$colspan.'" rowspan="'.$rowspan;
				$HTML.='" width="'.$width.'" height="'.$height.'">'."\n";
				$HTML.=$this->GTemp->blocks->GetById($td)->WidgetClass()->Render->Content();
				$HTML.="</td>\n";
			}
			$HTML.="</tr>\n";
		}
		$HTML.="</table>"."\n";
		return $HTML;
	}
	 /**
	 * Render CSS code 
	 * @return string Rendered CSS code
	 */
	public function CSS(){
		if ($this->structure==null) $this->RenderStructure();
		$CSS=new GCSS();
		foreach ($this->GTemp->blocks->GetAll() as $id => $block){
			$new_css=$block->WidgetClass()->Render->CSS();
			$CSS->merge($new_css);
		}
		return $CSS;
	}
	/**
	 * Render JavaScript code 
	 * @return string Rendered JS code
	 */
	public function JS(){
		if ($this->structure==null) $this->RenderStructure();
		$js='';
		foreach ($this->GTemp->blocks->GetAll() as $block){
			$widget=$block->WidgetClass();
			$js.=$widget->Render->JS()."\n";
		}
		return $js;
	}	
}
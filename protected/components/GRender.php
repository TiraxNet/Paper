<?php
/**
 * This Class is used to render a Template
 * @package Paper.core
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GRender{
	/**
	 * Render HTML code 
	 * @param GTemplate $GTemp Template object to render
	 * @return string Rendered HTML code
	 */
	public static function HTML($GTemp){
		$GTemp=$GTemp;
		$HTML='<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="';
		$HTML.=$GTemp->width.'">'."\n";
		for ($row=0;$row<$GTemp->struct->CountRows();$row++){
			$HTML.="<tr>\n";
			for ($col=0;$col<$GTemp->struct->CountCells($row);$col++){
				$blockid=$GTemp->struct->GetCellBlockId($row, $col);
				$block=$GTemp->blocks->GetById($blockid);
				$width=$block->width;
				$height=$block->height;
				$colspan=$block->colspan;
				$rowspan=$block->rowspan;
				$HTML.='<td id="'.$GTemp->name.'_'.$block->id.'" colspan="'.$colspan.'" rowspan="'.$rowspan;
				$HTML.='" width="'.$width.'" height="'.$height.'">'."\n";
				$HTML.=$block->WidgetClass()->Render->Content();
				$HTML.="</td>\n";
			}
			$HTML.="</tr>\n";
		}
		$HTML.="</table>"."\n";
		return $HTML;
	}
	 /**
	  * Render CSS code 
	  * @param GTemplate $GTemp Template object to render
	  * @return GCSS
	  */
	public static function CSS($GTemp){
		$CSS=new GCSS();
		foreach ($GTemp->blocks->GetAll() as $id => $block){
			$new_css=$block->WidgetClass()->Render->CSS();
			$CSS->merge($new_css);
		}
		return $CSS;
	}
	/**
	 * Render JavaScript code 
	 * @param GTemplate $GTemp Template object to render
	 * @return string Rendered JS code
	 */
	public static function JS($GTemp){
		$js='';
		foreach ($GTemp->blocks->GetAll() as $block){
			$widget=$block->WidgetClass();
			$js.=$widget->Render->JS()."\n";
		}
		return $js;
	}
	/**
	 * Render Template Structures, this rendering should be done before any other template rendering
	 * @param GTemplate $GTemp Template object to render
	 * @param GTemplate $GTemp
	 */
	public static function RenderStructure($GTemp){
		$dbblocks=blocks::model()->findAll('tmp='.$GTemp->id);
		$GTemp->blocks->InsertFromDb($dbblocks,array('auto'=>false));
		
		$XPoints=array(0,$GTemp->width);
		$YPoints=array(0,$GTemp->height);
		$block_list=$GTemp->blocks->GetAll();
		if ($block_list!=Null)
		foreach ($block_list as $Mobject){
			array_push($XPoints,$Mobject->x1);
			array_push($XPoints,$Mobject->x2);
			array_push($YPoints,$Mobject->y1);
			array_push($YPoints,$Mobject->y2);
		}
		sort($XPoints,SORT_NUMERIC);
		sort($YPoints,SORT_NUMERIC);
		$XPoints=array_values(array_unique($XPoints,SORT_NUMERIC));
		$YPoints=array_values(array_unique($YPoints,SORT_NUMERIC));
	
		$MHelp=array_fill(0, sizeof($XPoints),
				array_fill(0, sizeof($YPoints,0), 0)
		);
		if ($block_list!=Null)
		foreach ($GTemp->blocks->GetAll() as $block){
			$x=0;
			while($XPoints[$x]!=$block->x1) $x++;
			$y=0;
			while($YPoints[$y]!=$block->y1) $y++;
			$colspan=array_search($block->x2, $XPoints)-array_search($block->x1, $XPoints);
			$rowspan=array_search($block->y2, $YPoints)-array_search($block->y1, $YPoints);
			for ($i=0;$i<$colspan;$i++){
				for ($j=0;$j<$rowspan;$j++){
					$MHelp[$x+$i][$y+$j]=1;
				}
			}
		}
		$table_struct=array();
		for ($row=0;$row<sizeof($YPoints)-1;$row++){
			$table_row=array();
			for ($col=0;$col<sizeof($XPoints)-1;$col++){
				if ($MHelp[$col][$row]==0){
					$i=0;
					if ($row==sizeof($YPoints)-2){
						$MHelp[$col][$row]=1;
						$i=1;
					}else{
						while($MHelp[$col+$i][$row]==0 && ($col+$i)<(sizeof($XPoints)-1)){
							$MHelp[$col+$i][$row]=1;
							$i++;
						}
					}
					$j=1;
					$block=new GBlock();
					$block->name=$row.'_'.$col;
					$block->id='A_'.$block->name;
					$block->x1=$XPoints[$col];
					$block->y1=$YPoints[$row];
					$block->x2=$XPoints[$col+$i];
					$block->y2=$YPoints[$row+$j];
					$block->tmp=$GTemp->id;
					$block->widget="none";
					$block->auto=true;
					$GTemp->blocks->Insert($block);
					array_push($table_row,$block->id);
				}else{
					$inMap=$GTemp->blocks->GetByAttr(array(
							'x1'=>$XPoints[$col],
							'y1'=>$YPoints[$row]
					));
					if ($inMap!=null) array_push($table_row,$inMap->id);
				}
			}
			array_push($table_struct,$table_row);
		}
		
		$struct=new GStruct();
		$struct->setXPoints($XPoints);
		$struct->setYPoints($YPoints);
		$struct->setTableStruct($table_struct);
		return $struct;
	}	
}
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
	 * GTemplate to render
	 * @var GTemplate
	 */
	private $GTemp;
	/**
	 * GRender Constructor
	 * @param GTemplate $GTemp
	 */
	function __construct($GTemp){
		$this->GTemp=$GTemp;
	}
	/**
	 * Render HTML code 
	 * @return string Rendered HTML code
	 */
	public function HTML(){
		$GTemp=$this->GTemp;
		$HTML='<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="';
		$HTML.=$GTemp->width.'">'."\n";
		for ($row=0;$row<$this->GTemp->struct->CountRows();$row++){
			$HTML.="<tr>\n";
			for ($col=0;$col<$this->GTemp->struct->CountCells($row);$col++){
				$block=$this->GTemp->struct->GetCellBlock($row, $col);
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
	 * @return string Rendered CSS code
	 */
	public function CSS(){
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
		$js='';
		foreach ($this->GTemp->blocks->GetAll() as $block){
			$widget=$block->WidgetClass();
			$js.=$widget->Render->JS()."\n";
		}
		return $js;
	}	
}
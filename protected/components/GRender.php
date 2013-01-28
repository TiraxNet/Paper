<?php
/**
 * This Class is used to render a GClass
 * @author Mohammad hosein saadatfar
 *
 */
class GRender{
	/**
	 * GClass to render
	 * @var GClass
	 */
	private $GC;
	/**
	 * GRender Constructor
	 * @param GClass $GC
	 */
	function __construct($GC){
		$this->GC=$GC;
	}
	/**
	 * Render HTML code 
	 * @return string Rendered HTML code
	 */
	public function HTML(){
		$GC=$this->GC;
		$HTML='<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="';
		$HTML.=$GC->Pic->Width.'">'."\n";
		$table_struct=$GC->table_struct;
		$srow=$table_struct[0];
		foreach ($table_struct as $index => $tr){
			$HTML.="<tr>\n";
			foreach ($tr as $td){
				$width=$GC->blocks[$td]->width;
				$height=$GC->blocks[$td]->height;
				$colspan=$GC->blocks[$td]->colspan;
				$rowspan=$GC->blocks[$td]->rowspan;
				$HTML.='<td id="'.$GC->name.'_'.$td.'" colspan="'.$colspan.'" rowspan="'.$rowspan;
				$HTML.='" width="'.$width.'" height="'.$height.'">'."\n";
				$HTML.=$this->HTMLWidget($td);
				$HTML.="</td>\n";
			}
			$HTML.="</tr>\n";
		}
		$HTML.="</table>"."\n";
		return $HTML;
	}
	/**
	 * Get a Widget ID,Render HTML Part and return it
	 * @param string $id Widget id
	 */
	private function HTMLWidget($id){
		return $this->GC->blocks[$id]->WidgetClass()->Render->Content();
	}
	 /**
	 * Render CSS code 
	 * @return string Rendered CSS code
	 */
	public function CSS(){
		$CSS=new GCSS();
		foreach ($this->GC->blocks as $id => $block){
			$widget=$this->GC->blocks[$id]->WidgetClass();
			$new_css=$widget->Render->CSS();
			$CSS->merge($new_css);
		}
		return $CSS;
	}
	/**
	 * Convert CSS class to text 
	 * @param GCSS $CSSObject
	 * @return string CSS code
	 */
	public static function CSStoText($CSSObject){
		$CSS=$CSSObject->CSS;
		$txt='';
		foreach($CSS as $name => $body){
			$txt.=$name."{\n";
			foreach ($body as $index => $val){
				$txt.="\t".$index.": ".$val.";\n";
			}
			$txt.="}\n";
		}
		return $txt;
	}
	/**
	 * Render JavaScript code 
	 * @return string Rendered JS code
	 */
	public function JS(){
		$js='';
		foreach ($this->GC->blocks as $block){
			$widget=$block->WidgetClass();
			$js.=$widget->Render->JS()."\n";
		}
		return $js;
	}	
}
<?php
/**
 * This Controller shows dynamic Java Script pages
 * @author Mohammad hosein Saadatfar
 *
 */
class JavascriptController extends CController{
	/**
	 * Show template java script
	 * @param string $tmp Get template id from request
	 */
	public function actionIndex($tmp){
		$GC=new GClass($tmp);
		echo $GC->Render->JS();
	}
}
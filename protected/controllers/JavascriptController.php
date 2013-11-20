<?php
/**
 * This Controller shows dynamic Java Script pages
 * @package Paper.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class JavascriptController extends CController{
	/**
	 * Show template java script
	 * @param string $tmp Get template id from request
	 */
	public function actionIndex($id){
		header("Content-type: text/javascript;");
		echo GTemplate::FindById($id)->GetJS();
	}
}
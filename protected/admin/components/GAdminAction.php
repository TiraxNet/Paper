<?php

/**
 * A class who contains some commons in admin actions and used as extended class other than CAction
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GAdminAction extends CAction{
	/**
	 * init action
	 */
	public function init(){
		$this->controller->Action=$this;
	}
}
?>
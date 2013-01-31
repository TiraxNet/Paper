<?php
/**
 * Admin component is main component of admin panel
 * This component returns/run other admin component classes/methods by its static functions
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Admin{
	/**
	 * Echo admin menu
	 * @param string $c Html code to add in menu
	 */
	public static function Menu($c){
		return AdminMenu::Render($c);
	}
}
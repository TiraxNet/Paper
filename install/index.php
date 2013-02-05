<?php
/**
 * Paper! isntaller
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
define( 'DS', DIRECTORY_SEPARATOR );
define( 'BASE_PATH', dirname(__FILE__).DS.'..' );
define( 'INSTALL_PATH', dirname(__FILE__));
include 'Render.php';
include 'SQL.php';
$Rnd=new Render();
$Rnd->CheckFilePermissions();
$Rnd->CheckForPost();
include 'View.php';
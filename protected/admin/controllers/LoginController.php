<?php
/**
 * Admin login controller
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class LoginController extends CController
{
	
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Administratot Login';
	/**
	 * Use default layout; Readonly!
	 * @var string
	 */
	public $layout='//layouts/main';
	/**
	 * (non-PHPdoc)
	 * @see CController::actions()
	 */
	public function actions()
    {
        return array(
            'login'=>array(
                'class'=>'application.admin.actions.Login.LoginAction',
			),
			'logout'=>array(
				'class'=>'application.admin.actions.Login.LogoutAction',
            ),
        );
    }
}
<?php

class LoginController extends GAdminController
{
	
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Administratot Login';
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
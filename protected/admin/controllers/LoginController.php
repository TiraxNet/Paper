<?php

class LoginController extends GAdminController
{
	
	
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
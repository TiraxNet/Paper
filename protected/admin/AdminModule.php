<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'admin.models.*',
			'application.admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}

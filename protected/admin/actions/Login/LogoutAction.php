<?php

class LogoutAction extends GAdminAction{
	public function run(){
		Yii::app()->user->logout();
		$this->controller->redirect('index.php');
	}
}
<?php

class DefaultController extends CController
{
	public $Title;
	public function actionIndex()
	{
		if (Yii::app()->user->id=='admin'){
			$this->redirect(array('Tmp/list'));
		}else{
			$this->redirect(array('login/login'));
		}
	}
}
<?php

class DefaultController extends CController
{
	public $Title;
	public function actionIndex()
	{
		$this->render('index');
	}
}
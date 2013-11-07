<?php

class GUrlManager extends CUrlManager {

	public function createUrl($route,$params=array(),$ampersand='&')
	{
		if (Yii::app()->request->getQuery('u',null)!=null){
			$params['u']=Yii::app()->request->getQuery('u');
		}
		return parent::createUrl($route, $params, $ampersand);
	}

}
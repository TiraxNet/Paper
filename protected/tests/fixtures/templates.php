<?php
functions::rrmdir(Yii::getPathOfAlias('application.GTemplates'),true);
functions::recurse_copy(dirname(__FILE__).DS.'templates', Yii::getPathOfAlias('application.GTemplates'));
return array(
		'1'=>array('id'=>'1',
					'name'=>'Home_Page',
					'version'=>'1',
					'title'=>'Paper! Home Page',
					'parent'=>'0',
					'css'=>''
		
				),
	);
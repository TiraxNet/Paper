<?php 
return CMap::mergeArray(
    require(dirname(__FILE__).DS.'main.php'),
    array(
        'components'=>array(
            'fixture'=>array(
                'class'=>'system.test.CDbFixtureManager',
            ),
        	/*'log'=>array(
        		'class'=>'CLogRouter',
        		'routes'=>array(
  					array(
      					'class'=>'CFileLogRoute',
        				'levels'=>'error, warning, trace, info',
        				'categories'=>'application.*',
       				),
        		
        		),
        	),*/
        ),
    )
);
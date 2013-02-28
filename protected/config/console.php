<?php

return CMap::mergeArray(
		require('main.php'),
		array(
			'preload'=>array('log'),
			'components'=>array(
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
							array(
								'class'=>'CFileLogRoute',
								'levels'=>'error, warning',
							),
					),
				),
			),
		)
);

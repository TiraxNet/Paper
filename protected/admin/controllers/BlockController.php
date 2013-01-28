<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class BlockController extends GAdminController
{

	public function actions()
    {
        return array(
            'edit'=>array(
                'class'=>'application.admin.actions..Block.EditAction',
            ),
			'SaveEdit'=>array(
                'class'=>'application.admin.actions.Block.SaveEditAction',
            ),
			'new'=>array(
                'class'=>'application.admin.actions..Block.NewAction',
            ),
			'SaveNew'=>array(
                'class'=>'application.admin.actions.Block.SaveNewAction',
            ),

        );
    }

	
}


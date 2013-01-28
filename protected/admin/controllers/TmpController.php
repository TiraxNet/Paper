<?php

class TmpController extends GAdminController
{
	
	
	public function actions()
    {
        return array(
        	/* Creating new template */
            'new'=>array(
                'class'=>'application.admin.actions.Tmp.NewAction',
            ),
            /* Edit an exiting template */
			'edit'=>array(
				'class'=>'application.admin.actions.Tmp.EditAction',
			),
			/* Delete an exiting template */
			'delete'=>array(
				'class'=>'application.admin.actions.Tmp.DeleteAction'
			),
			/* Shows a list of templates to edit */
			'list'=>array(
                'class'=>'application.admin.actions.Tmp.ListAction',
            ),
        );
    }
}
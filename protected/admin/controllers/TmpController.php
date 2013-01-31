<?php
/**
 * Template managment controller
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */

class TmpController extends GAdminController
{
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Template Managment';
	/**
	 * (non-PHPdoc)
	 * @see CController::actions()
	 */
	public function actions()
    {
        return array(
        	/* Creating new template */
            'new'=>array(
                'class'=>'application.admin.actions.Tmp.NewAction',
            ),
            /* Edit an exiting template */
			'update'=>array(
				'class'=>'application.admin.actions.Tmp.UpdateAction',
			),
			/* Delete an exiting template */
			'delete'=>array(
				'class'=>'application.admin.actions.Tmp.DeleteAction'
			),
			/* Shows a list of templates to edit */
			'list'=>array(
                'class'=>'application.admin.actions.Tmp.ListAction',
            ),
        	/* Upload template image */
        	'uploadimg'=>array(
        		'class'=>'application.admin.actions.Tmp.UploadIMGAction',
        	)
        );
    }
}
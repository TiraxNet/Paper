<?php
/**
 * Template managment controller
 * @package Paper.admin.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */

class TmpController extends CController
{
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Template Managment';
	/**
	 * Control will be added to Menu by layout
	 * @var string
	 */
	public $control='';
	/**
	 * (non-PHPdoc)
	 * @see CController::actions()
	 */
	public function actions()
    {
        return array(
        	/* Creating new template */
            'new'=>array(
                'class'=>'application.admin.actions.Tmp.TmpNewAction',
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
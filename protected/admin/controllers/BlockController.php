<?php
/**
 * Admin Block managment controller
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class BlockController extends GAdminController
{
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Block Managment';
	/**
	 * (non-PHPdoc)
	 * @see CController::actions()
	 */
	public function actions()
    {
        return array(
            'edit'=>array(
                'class'=>'application.admin.actions.Block.EditAction',
            ),
			'SaveEdit'=>array(
                'class'=>'application.admin.actions.Block.SaveEditAction',
            ),
			'new'=>array(
                'class'=>'application.admin.actions.Block.NewAction',
            ),
			'SaveNew'=>array(
                'class'=>'application.admin.actions.Block.SaveNewAction',
            ),

        );
    }

	
}


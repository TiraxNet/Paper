<?php
/**
 * Admin Block managment controller
 * @package Paper.admin.controllers
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensources.org/licenses/bsd-license.php New BSD License
 *
 */
class BlockController extends CController
{
	/**
	 * Page Title
	 * @var string
	 */
	public $Title='Block Managment';
	/**
	 * Control will be added to Menu by layout
	 * @var string
	 */
	public $control='';
	/**
	 * Make sure that current user is admin
	 * @see CController::init()
	 */
	public function init(){
		Yii::app()->getModule('admin')->AdminAuth->check();
	}
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


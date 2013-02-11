<?php
/**
 * Admin module initializer
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class AdminModule extends CWebModule
{
	private $_assetsUrl;
	
	public function init()
	{
		$this->setImport(array(
			'admin.models.*',
			'application.admin.components.*',
		));
	}
	
	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(
					Yii::getPathOfAlias('admin.assets') );
		return $this->_assetsUrl;
	}
	
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}

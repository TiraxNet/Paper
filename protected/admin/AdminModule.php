<?php
/**
 * Admin module initializer
 * @package Paper.admin.core
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class AdminModule extends CWebModule
{
	/**
	 * Assets url will be stored here
	 * @var string
	 */
	private $_assetsUrl;
	/**
	 * (non-PHPdoc)
	 * @see CModule::init()
	 */
	public function init()
	{
		$this->layoutPath="protected/admin/views/layouts";
		$this->layout="main";
		$this->setImport(array(
			'admin.models.*',
			'application.admin.components.*',
		));
	}
	/**
	 * Publish assets and return url
	 * @return string
	 */
	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(
					Yii::getPathOfAlias('admin.assets') );
		return $this->_assetsUrl;
	}
	/**
	 * (non-PHPdoc)
	 * @see CWebModule::beforeControllerAction()
	 */
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

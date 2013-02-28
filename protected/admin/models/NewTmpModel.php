<?php
/**
 * New template form model
 * @package Paper.admin.models
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class NewTmpModel extends CFormModel
{
	/**
	 * Template name
	 * @var string
	 */
    public $name;
    /**
     * Template title
     * @var string
     */
	public $title;
	/**
	 * Template CSS
	 * @var string
	 */
	public $css;
	
	/**
	 * (non-PHPdoc)
	 * @see CModel::rules()
	 */
	public function rules()
	{
		return array(
				array('name', 'required'),
		);
	}
}
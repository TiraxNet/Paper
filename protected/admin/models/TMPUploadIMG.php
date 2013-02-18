<?php
/**
 * Admin, Upload template image form model
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class TMPUploadIMG extends CFormModel
{
	/**
	 * Image File
	 * @var CUploadedFile
	 */
	public $file;
	/**
	 * Image type
	 * @var string
	 */
	public $type;
	/**
	 * Template id
	 * @var string
	 */
	public $id;
	
	/**
	 * (non-PHPdoc)
	 * @see CModel::rules()
	 */
	public function rules()
	{
		return array(
				array('id, type', 'required'),
				array('file', 'file',  'allowEmpty' => FALSE,'types' => 'jpg')
		);
	}
}
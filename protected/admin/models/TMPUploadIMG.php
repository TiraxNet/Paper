<?php
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
	public $template;
	
	/**
	 * (non-PHPdoc)
	 * @see CModel::rules()
	 */
	public function rules()
	{
		return array(
				array('template, type', 'required'),
				array('file', 'file',  'allowEmpty' => FALSE,'types' => 'jpg')
		);
	}
}
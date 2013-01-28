<?php
/**
 * This Class provides all we need to work with Templates
 * @author Mohammad Hosein Saadatfar 
 *
 */
class GTemplate{
	/**
	 * Template id
	 * @var string
	 */
	public $id;
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
	 * Template css
	 * @var string
	 */
	public $css;
	/**
	 * Template parent template id
	 * @var string
	 */
	public $parent;
	/**
	 * Saves current parameters as new template.
	 */
	public function SaveNew(){
		$db= new templates();
		$db->name=$this->name;
		$db->title=$this->title;
		$db->css=$this->css;
		$db->parent=$this->parent;
		$db->save();
		mkdir(Yii::getPathOfAlias('application.templates.'.$db->id));
		return $db->id;
	}
	/**
	 * Delete template by current "id" parameter
	 */
	public function delete(){
		$db=templates::model()->findByPk($this->id);
		$db->delete();
		$dir=Yii::getPathOfAlias('application.templates.'.$db->id);
		Yii::app()->functions->rrmdir($dir);
	}
	/**
	 * Fill Parameters from an array.
	 * @param array $arr parameters array
	 */
	public function SetFromArray($arr){
		foreach (get_class_vars('GTemplate') as $var=>$val){
			if (array_key_exists($var,$arr)){
						$this->$var=$arr[$var];
			}
		}
	}
	/**
	 * Fill parameters from database active record
	 * @param CActiveRecord $db
	 */
	public function SetFromDB($db){
		$this->SetFromArray($db->getAttributes());
	}
	/**
	 * Search and fill parameters from database.
	 * @param string $id Block id 
	 */
	public static function FindById($id){
		$template=new GTemplate();
		$db=templates::model()->findByPk($id);
		$template->SetFromDB($db);
		return $template;
	}
}
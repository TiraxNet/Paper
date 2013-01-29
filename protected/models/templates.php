<?php
/**
 * Database "templates" table CActive Record
 * 
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * 
 * @property string $id Template id
 * @property string $name Template name
 * @property string $title Template title
 * @property strign $css Template CSS
 * @property int 	$version Template version
 *
 */
class templates extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::primaryKey()
	 */
	public function primaryKey()
	{
	    return 'id';
	}
	
	
}
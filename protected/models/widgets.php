<?php
/**
 * Database "widgets" table CActive Record
 * @package Paper.models
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */ 
class widgets extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	
	public function primaryKey()
	{
	    return 'id';
	}
	
	
}






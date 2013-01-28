<?php
/**
 * Database "templates" table CActive Record
 * @author Mohammad hosein Saadatfar
 *
 */
class templates extends CActiveRecord
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
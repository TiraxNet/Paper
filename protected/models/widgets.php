<?php
/**
 * Database "widgets" table CActive Record
 * @author Mohammad hosein Saadatfar
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






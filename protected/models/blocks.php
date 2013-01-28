<?php
/**
 * Database "blocks" table CActive Record
 * @author Mohammad hosein Saadatfar
 *
 */
class blocks extends CActiveRecord
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
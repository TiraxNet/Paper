<?php
/**
 * TEST!
 * @author Mohammad hosein Saadatfar
 *
 */
class TestController extends CController{
	/**
	 * TEST
	 */
	public function actionIndex(){
		$a=new ooo;
		echo $a->salam();
	}
}
/**
 * TEST!
 * @author Mohammad hosein Saadatfar
 *
 */
class ooo extends CComponent{
	/**
	 * TEST
	 */
	public function salam(){
		$x=90;
		print_r(eval('return array(1,$x);'));
	}
}
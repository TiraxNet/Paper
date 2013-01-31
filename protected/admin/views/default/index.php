<?php
/**
 * Admin site/main action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>
<?php 
if (Yii::app()->user->id=='admin'){
	$this->redirect('index.php');
}else{
	$this->redirect(array('login/login'));
}
?>
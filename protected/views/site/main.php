<?php
/**
 * User site main view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>

<?php
Yii::app() -> clientScript -> registerCSSFile($css_addr);
Yii::app() -> clientScript -> registerScriptFile($js_addr);
if (Yii::app()->user->id=='admin'){
	Admin::Menu('');
}
?>

<div id="PapaDIV">
<?php echo $this->body; ?>
</div>
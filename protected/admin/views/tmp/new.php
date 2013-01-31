<?php
/**
 * Admin new template action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>

<?php Admin::Menu('');?>
<div class="well" style="margin:50px auto; width:700px">
<?php
if ($msg!=''){
	echo "<div class=\"alert alert-success\">$msg</div>";
}
$model=new NewTmpModel;
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'NewBlockForm',
	'type'=>'horizontal',
));
?>
<?php
echo $form->textFieldRow($model, 'name');
echo $form->textFieldRow($model, 'title');
echo $form->textAreaRow($model, 'css', array('rows'=>5));
?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
</div>

<?php $this->endWidget(); ?> 
</div>
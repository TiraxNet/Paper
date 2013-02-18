<?php
/**
 * Admin template image upload action view
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
	echo "<div class=\"alert alert-error\">$msg</div>";
}
$model=new TMPUploadIMG();
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'NewBlockForm',
	'type'=>'horizontal',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
$model->template=$tmp;
$model->type=$type;
?>
<?php
echo $form->hiddenField($model, 'template');
echo $form->uneditableRow($model, 'template');
echo $form->textFieldRow($model, 'type');
echo $form->fileFieldRow($model, 'file');
?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('label'=>'Back','url'=>$this->createUrl('Tmp/update',array('id'=>$tmp)))); ?>
</div>

<?php $this->endWidget(); ?> 
</div>
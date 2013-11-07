<?php
/**
 * User site main view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>


<div class="well" style="margin: 50px auto; width: 700px">
	<legend>Paper! Installer</legend>
	<?php if ($msg!=null): ?> 
	<div class="alert alert-error"><?php echo $msg; ?></div>
	<?php endif; ?>
	
	<div class="row">
		<div class="span5">
	<?php
	$model=new OptionsModel;
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'OptionsForm',
		'type'=>'horizontal'
	) );
	if ($type == 'multi') {
		echo $form->textFieldRow ( $model, 'UserName' );
		echo $form->textFieldRow ( $model, 'UrlExpression' );
	}
	echo $form->textFieldRow ( $model, 'WebsiteName' );
	echo $form->textFieldRow ( $model, 'SqlHost' );
	echo $form->textFieldRow ( $model, 'SqlUsername' );
	echo $form->textFieldRow ( $model, 'SqlPassword' );
	echo $form->textFieldRow ( $model, 'SqlDatabase' );
	?>
	<div class="form-actions">
		<button name="Submit" type="submit" class="btn btn-primary">Submit</button>
		<button name="Reset" type="reset" class="btn">Reset</button>
	</div>	
	<?php $this->endWidget(); ?>
		
	</div>
		<div class="span4" style="text-align: center;">
			<img src="assets/Logo.png" style="width: 150px;" />
		</div>
	</div>
</div>

<?php

?>

<div class="well" style="margin:50px auto; width:700px">
<?php
$model=new LoginModel;
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'LoginForm',
	'type'=>'horizontal',
));
?>
<legend>Paper! Login</legend>
<?php
echo $form->textFieldRow($model, 'username');
echo $form->passwordFieldRow($model, 'password');
?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Login')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
</div>
<?php
$this->endWidget();
?>
</div>
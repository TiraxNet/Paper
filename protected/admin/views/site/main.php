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
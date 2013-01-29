<?php

$this->InsertAsset('edit.js','script');
$this->InsertAsset('imgareaselect.js','script');
$this->Insert($script,'script');
$this->InsertAsset('imgareaselect-animated.css','CSS');
$this->Insert('#PapaDIV{text-align:center}#PapaDIV img{ border:1px dashed #666; margin-bottom:20px;}','CSS');

$c='<a href="#SaveDialog" class="btn btn-primary pull-right" data-toggle="modal">Save</a>';
Admin::Menu($c);

echo '<div id="PapaDIV"><img src="'.$ImgURL.'" id="MainIMG"/></div>';


$model=new NewBlockModel;
$WList=array();
foreach (Yii::app()->GWidget->List as $w){
	$WList[$w['PathName']]=$w['Name'];
}
?>

<div id="SaveDialog" class="modal fade" style="display: none;">
<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'NewBlockForm',
	'type'=>'horizontal',
	'action' => $this->createUrl("block/SaveNew"),
));
?>
<div class="modal-header"> 
	<a class="close" data-dismiss="modal">&times;</a>
	<h3>One Step to Save...</h3>
</div>

<div class="modal-body">
<?php echo $form->textFieldRow($model, 'name'); ?>
<?php echo $form->dropDownListRow($model, 'widget', $WList); ?>
<input type="hidden" name="NewBlockModel[x1]" id="x1" value=""/>
<input type="hidden" name="NewBlockModel[y1]" id="y1" value=""/>
<input type="hidden" name="NewBlockModel[x2]" id="x2" value=""/>
<input type="hidden" name="NewBlockModel[y2]" id="y2" value=""/>
<input type="hidden" name="NewBlockModel[parent]" id="parent" value="0"/>
<input type="hidden" name="NewBlockModel[tmp]" id="tmp" value="<?php echo $this->Action->tmp;?>"/>
</div>

<div class="modal-footer">
	<input type="submit" class="btn btn-primary" value="Save" />
	<?php $this->widget('bootstrap.widgets.BootButton', array(
		'label'=>'Close',
		'url'=>'#',
		'htmlOptions'=>array('data-dismiss'=>'modal'),
	)); ?>
</div>
<?php $this->endWidget(); ?> 
</div> 
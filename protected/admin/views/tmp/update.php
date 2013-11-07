<?php
/**
 * Admin update template action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */

$CAction=Yii::app()->getController()->getAction();

Yii::app()->clientScript->registerScript(uniqid(), $script);
Yii::app()->clientScript->registerCss(uniqid(), '#PapaDIV{text-align:center}#PapaDIV canvas{ border:1px dashed #666; margin-bottom:20px;}');
Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().'/jCanvaScript.js');
Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().'/GCanva.js');

$urls="var URLs={}\n";
$urls.="URLs.JsonList = '".$this->createUrl("block/JsonList")."';";
$urls.="URLs.SavePos = '".$this->createUrl("block/savePos")."';";
$urls.="URLs.blockOptions = '".$this->createUrl("block/blockOptions")."';";
$urls.="URLs.saveNew = '".$this->createUrl("block/saveNew")."';";
$urls.="URLs.SavePos = '".$this->createUrl("block/savePos")."';";
$urls.="URLs.base = '".Yii::app()->baseUrl."';";

Yii::app()->clientScript->registerScript(uniqid(), $urls, CClientScript::POS_HEAD);

?>
<div id="PapaDIV">

	<canvas height="<?php echo $gtemp->height ?>"
		width="<?php echo ($gtemp->width+30) ?>" id="mainCanvas"></canvas>
	<br />
	<div id="msg" style="text-align: center"></div>
	<br />
<?
if ($CAction->type != 'index'){
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Delete type',
			'type'=>'primary',
			'size'=>'mini',
			'icon'=>'ban-circle white',
			'url'=>$this->createUrl("Tmp/delete",array('id'=>$CAction->tmp,'type'=>$CAction->type)),
	));
}
$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'Edit Picture',
		'type'=>'primary',
		'size'=>'mini',
		'icon'=>'pencil white',
		'url'=>$this->createUrl("Tmp/uploadimg",array('id'=>$CAction->tmp,'type'=>$CAction->type)),
));
foreach ($types as $type){
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>$type,
			'type'=>'inverse',
			'size'=>'mini',
			'url'=>$this->createUrl("Tmp/update",array('id'=>$CAction->tmp,'type'=>$type)),
	));
}
$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'New Type ...',
		'type'=>'inverse',
		'size'=>'mini',
		'url'=>$this->createUrl("Tmp/uploadimg",array('id'=>$CAction->tmp,'type'=>'NEW')),
));
?>

</div>

<div id="OptionsDialog" class="modal fade" style="display: none;">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>One Step to Save...</h3>
	</div>
	<div class="modal-body" id="blockOptions"></div>
</div>



<?php
$model=new NewBlockModel;
$WList=array();
$db=widgets::model()->findAll('1');
foreach ($db as $w){
	$WList[$w->pathname]=$w->name;
}
?>
<div id="newBlockDialog" class="modal fade" style="display: none;">
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'newBlock',
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

<div class="modal-footer">
	<input type="button" class="btn btn-primary" value="Save" id="newBlockSaveBtn"/>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'Close',
		'url'=>'#',
		'htmlOptions'=>array('data-dismiss'=>'modal'),
	)); ?>
</div>
<?php $this->endWidget(); ?> 
</div> 
</div>
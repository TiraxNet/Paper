<?php
/**
 * Admin new block action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>

<?php

Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().DS.'imageSelect'.DS.'imgareaselect.js');
Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().DS.'imageSelect'.DS.'imgareaselect.css');

Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().DS.'block'.DS.'BlockEdit.js');
Yii::app()->clientScript->registerScript(uniqid(), $script, CClientScript::POS_BEGIN);
Yii::app()->clientScript->registerCss(uniqid(), '#PapaDIV{text-align:center}#PapaDIV img{ border:1px dashed #666; margin-bottom:20px;}');

$c='<a href="#SaveDialog" class="btn btn-primary pull-right" data-toggle="modal">Save</a>';
$c.='<a class="btn pull-right" onclick="FixBlockPosition();">Fix it!</a>';
Admin::Menu($c);

echo '<div id="PapaDIV"><img src="'.$ImgURL.'" id="MainIMG"/></div>';


$model=new NewBlockModel;
$WList=array();
$db=widgets::model()->findAll('1');
foreach ($db as $w){
	$WList[$w->pathname]=$w->name;
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
<input type="hidden" name="NewBlockModel[tmp]" id="tmp" value="<?php echo Yii::app()->getController()->getAction()->tmp;?>"/>
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
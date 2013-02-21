<?php
/**
 * Admin update template action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>

<?php

$CAction=Yii::app()->getController()->getAction();
$c='<a href="'.$this->createUrl("block/new",array('tmp'=>$CAction->tmp))
	.'" class="btn btn-primary pull-right">New Block</a>';
$this->control=$c;

Yii::app()->clientScript->registerScript(uniqid(), $script);
Yii::app()->clientScript->registerCss(uniqid(), '#PapaDIV{text-align:center}#PapaDIV img{ border:1px dashed #666; margin-bottom:20px;}');

echo '<div id="PapaDIV"><img src="'.$ImgURL.'" id="MainIMG"/><br/>';
if ($CAction->type!='index'){
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
echo '</div></div>';
?>
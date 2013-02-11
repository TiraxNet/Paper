<?php
/**
 * Admin edit block action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>

<?php
$CAction=Yii::app()->getController()->getAction();

Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().DS.'imageSelect'.DS.'imgareaselect.js');
Yii::app()->clientScript->registerCssFile($this->module->getAssetsUrl().DS.'imageSelect'.DS.'imgareaselect.css');

Yii::app()->clientScript->registerScriptFile($this->module->getAssetsUrl().DS.'block'.DS.'BlockEdit.js');
Yii::app()->clientScript->registerScript(uniqid(), $script,CClientScript::POS_BEGIN);
Yii::app()->clientScript->registerCss(uniqid(), '#PapaDIV{text-align:center}#PapaDIV img{ border:1px dashed #666; margin-bottom:20px;}');

$c='<a href="#" class="btn btn-primary  pull-right" id="EditBlockPosSave">Save</a>';
$c.='<a href="#OptionsDialog" class="btn btn-primary  pull-right" data-toggle="modal">Options</a>';
$c.='<a href="index.php?r=admin/Tmp/update&id='.$CAction->tmp.'" class="btn btn-primary pull-right">Close</a>';
Admin::Menu($c);

echo '<div id="PapaDIV"><img src="'.$ImgURL.'" id="MainIMG"/></div>';
?>

<?php
$spblock=$CAction->spblock;
$action=$this->createUrl("block/SaveEdit",array('block'=>$CAction->spblock->id));
?>
<form method="post" id="EditBlockPosForm" action="<?php echo $action; ?>">
 	<input type="hidden" name="EditBlockPos[block]" value="<?php echo $spblock->id ?>"/>
    <input type="hidden" name="EditBlockPos[x1]" id="x1" value="<?php echo $spblock->x1 ?>"/>
    <input type="hidden" name="EditBlockPos[y1]" id="y1" value="<?php echo $spblock->y1 ?>"/>
    <input type="hidden" name="EditBlockPos[x2]" id="x2" value="<?php echo $spblock->x2 ?>"/>
    <input type="hidden" name="EditBlockPos[y2]" id="y2" value="<?php echo $spblock->y2 ?>"/>
</form>
<?php $CAction->OptionsDialog(); ?>
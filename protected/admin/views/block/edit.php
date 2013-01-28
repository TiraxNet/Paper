<?php

$this->InsertAsset('edit.js','script');
$this->InsertAsset('imgareaselect.js','script');
$this->InsertAsset('imgareaselect-animated.css','CSS');
$this->Insert($script,'script');
$this->Insert('#PapaDIV{text-align:center}#PapaDIV img{ border:1px dashed #666; margin-bottom:20px;}','CSS');

$c='<a href="#" class="btn btn-primary  pull-right" id="EditBlockPosSave">Save</a>';
$c.='<a href="#OptionsDialog" class="btn btn-primary  pull-right" data-toggle="modal">Options</a>';
$c.='<a href="index.php?r=admin/Tmp/update&id='.$this->Action->tmp.'" class="btn btn-primary pull-right">Close</a>';
Admin::Menu($c);

echo '<div id="PapaDIV"><img src="'.$ImgURL.'" id="MainIMG"/></div>';
?>

<?php
$spblock=$this->Action->spblock;
$action=$this->createUrl("block/SaveEdit",array('block'=>$this->Action->spblock->id));
?>
<form method="post" id="EditBlockPosForm" action="<?php echo $action; ?>">
 	<input type="hidden" name="EditBlockPos[block]" value="<?php echo $spblock->id ?>"/>
    <input type="hidden" name="EditBlockPos[x1]" id="x1" value="<?php echo $spblock->x1 ?>"/>
    <input type="hidden" name="EditBlockPos[y1]" id="y1" value="<?php echo $spblock->y1 ?>"/>
    <input type="hidden" name="EditBlockPos[x2]" id="x2" value="<?php echo $spblock->x2 ?>"/>
    <input type="hidden" name="EditBlockPos[y2]" id="y2" value="<?php echo $spblock->y2 ?>"/>
</form>
<?php $this->Action->OptionsDialog(); ?>
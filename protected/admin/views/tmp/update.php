<?php
$c='<a href="'.$this->createUrl("block/new",array('tmp'=>$this->Action->tmp))
	.'" class="btn btn-primary pull-right">New Block</a>';
Admin::Menu($c);
$this->Insert($script,'script');
$this->Insert('#PapaDIV{text-align:center}#PapaDIV img{ border:1px dashed #666; margin-bottom:20px;}','CSS');
echo '<div id="PapaDIV"><img src="'.$ImgURL.'" id="MainIMG"/></div>';
?>
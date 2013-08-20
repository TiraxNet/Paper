<?php
/**
 * Admin template list action view
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
?>
<div class="well" style="margin:50px auto; width:700px">
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$Tlist,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'id', 'header'=>'#'),
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'title', 'header'=>'Title'),
        array('name'=>'version', 'header'=>'Version'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        	'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 40px'),
        )
    ),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'New Template',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // null, 'large', 'small' or 'mini'
    'url'=>$this->createUrl('Tmp/new'),
	'icon'=>'file'
)); ?>

</div>
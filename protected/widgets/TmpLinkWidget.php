<?php
/**
 *  Show a Template list links in order to linking pages 
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class TmpLinkWidget extends CWidget
{
	
	public $size='small';
	public $type='inverse';
	public $InputId;
	
	/**
	 * (non-PHPdoc)
	 * @see CWidget::run()
	 */
	public function run()
	{
		$this->RegisterJS();
		$this->Render_Modal();
		$this->widget('bootstrap.widgets.BootButton', array(
				'label'=>'Templates',
				'type'=>$this->type,
				'size'=>$this->size,
				'htmlOptions'=>array(
						'data-toggle'=>'modal',
						'data-target'=>'#tmplinklist',
				),
		));
	}
	/**
	 * Echo modal body of widget
	 */
	public function Render_Modal()
	{
	
		$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'tmplinklist')); ?>
		<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Template link</h4>
		</div>
		
		<div class="modal-body">
		<?php
		$DList=templates::model()->findAll('parent=0');
		$AList=array();
		foreach ($DList as $tmp)
		{
			$url=$this->getController()->createUrl('/site/index',array('tmp'=>$tmp->id));
			$name='<a onclick="FillTMPURL(\''.$url.'\')" href="#">'.$tmp->name.'</a>';
			$item=array('id'=>$tmp->id,'name'=>$name,'title'=>$tmp->title);
			array_push($AList, $item);
		}
		$gridDataProvider = new CArrayDataProvider($AList);
		$this->widget('bootstrap.widgets.BootGridView', array(
				'type'=>'striped bordered condensed',
				'dataProvider'=>$gridDataProvider,
				'template'=>"{items}",
				'columns'=>array(
						array('name'=>'id', 'header'=>'#'),
						array('name'=>'name', 'header'=>'Name', 'type'=>'raw'),
						array('name'=>'title', 'header'=>'Title'),
				),
		));
 		?>
		</div>
		
		<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
		        'label'=>'Close',
		        'url'=>'#',
		        'htmlOptions'=>array('onclick'=>'$(\'#tmplinklist\').modal(\'hide\');'),
		    )); ?>
		</div>
		 
		<?php $this->endWidget();
	}
	/**
	 * Register JavaScript function Code of widget
	 */
	public function RegisterJS()
	{
		$script="	function FillTMPURL(url){
 						document.getElementById('".$this->InputId."').value=url;
 						$('#tmplinklist').modal('hide');
 					}
 				";
		echo $this->getController()->Insert($script,'script');		
	}
}
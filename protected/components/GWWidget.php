<?php
/**
 * This class is used to insert Widgets in paper widgets
 * @package Paper.core
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class GWWidget
{
	/**
	 * CWidget is used in endWidget()
	 * @var CWidget
	 */
	private $CWidget=null;
	/**
	 * GWidget
	 * @var GWidget
	 */
	private $GW;
	/**
	 * This is used in Begin->end widget to remember sths
	 * @var mixed
	 */
	private $arg;
	/**
	 * GWWidget Constructor
	 * @param GWidget $GW
	 */
	public function __construct($GW)
	{
		$this->GW=$GW;
	}
	/**
	 * This function is used to set CWidget
	 * @param CWidget $CWidget
	 */
	public function SetCWidget($CWidget){
		$this->CWidget=$CWidget;
	}
	/**
	 * This function is used to set arg
	 * @param CWidget $CWidget
	 */
	public function SetArg($arg)
	{
		$this->arg=$arg;
	}
	/**
	 * Get a widget type and return its class
	 * @param strin $type Widget type
	 * @return string Widget Class
	 */
	private function GetClass($type){
		switch ($type)
		{
			case 'Form':
				return 'bootstrap.widgets.TbActiveForm';
			case 'Button':
				return 'bootstrap.widgets.TbButton';
			case 'TmpLinkWidget':
				return 'admin.widgets.TmpLinkWidget';
			default:
				throw new Exception($type.' is not a valid type');
		}
	}
	 /**
	  * Get a widget type and return its initial widget
	  * @param string $type Widget type
	  * @return array Initial properties array
	  */
	private function GetInitialProperties($type)
	{
		switch ($type)
		{
			default:
					return array();
		}
	}
	/**
	 * Get a widget type properties and combine it with initial properties
	 * @param string $type Widget type
	 * @param array $properties properties
	 * @return array Merged properties array
	 */
	private function MergeWithInitialProperties($type,$properties)
	{
		$ip=$this->GetInitialProperties($type);
		foreach ($ip as $key=>$val)
		{
			if (!array_key_exists($key, $properties)) $properties[$key]=$ip[$key];
		}
		return $properties;
	}
	/**
	 * Get a widget type properties and initialize it
	 * @param string $type
	 * @param string $properties
	 * @return array Initialized properties
	 */
	private function initProperties($type,$properties)
	{
		switch ($type)
		{
			case 'Form':
				$this->arg=$properties['model'];
				unset($properties['model']);
				break;
		}
		return $this->MergeWithInitialProperties($type, $properties);
	}
	/**
	 * 
	 * @param string $type
	 * @param string $properties
	 * @return array
	 */
	private function CreateSubWidgetInitialProperties($type,$properties)
	{
		switch ($type)
		{
			case 'textFieldRow':
			case 'checkBoxRow':
				return array(
					$this->arg,
					$properties[0],
					$properties[1]
				);
			default:
				throw new Exception($type.' is not a valid type');
		}
	}
	/**
	 * Creates a widget and executes it.
	 * This method is similar to widget() except that it is expecting a endWidget() call to end the execution. 
	 * @param string $type widget type, eg. 'form'
	 * @param array $properties the widget created to runlist of initial property values for the widget (Property Name => Property Value)
	 * @return GWWidget this class is used to show SubWidgets and endWidget 
	 */
	public function beginWidget($type,$properties){
		$properties=$this->initProperties($type, $properties);
		$CW=Yii::app()->controller->beginWidget($this->GetClass($type),$properties);
		$Ender=new GWWidget($this->GW);
		$Ender->SetCWidget($CW);
		$Ender->SetArg($this->arg);
		return $Ender;
	}
	/**
	 * Ends the execution of the named widget.
	 * This method is used together with beginWidget().
	 */
	public function endWidget()
	{
		if ($this->CWidget==null) throw new CHttpException('CWidget not found, Use beginWidget before');
		Yii::app()->controller->endWidget($this->CWidget->id);
	}
	/**
	 * Creates a widget and executes it.
	 * This method is similar to widget() except that it is not expecting a endWidget()
	 * @param string $type widget type
	 * @param array $properties the widget created to runlist of initial property values for the widget (Property Name => Property Value)
	 */
	public function widget()
	{
		if ($this->CWidget!=null)
		{
			$type=func_get_arg(0);
			$properties=func_get_args();
			array_shift($properties);
			$properties=$this->CreateSubWidgetInitialProperties($type,$properties);
			if (!method_exists($this->CWidget, $type)) throw new CHttpException($type.' is not a valid type');
			echo call_user_func_array(array($this->CWidget,$type),$properties);
		}
		else
		{
			$type=func_get_arg(0);
			$properties=func_get_arg(1);
			$properties=$this->initProperties($type, $properties);
			Yii::app()->controller->widget($this->GetClass($type),$properties);
		}
	}
}
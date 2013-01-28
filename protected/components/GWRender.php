<?php
/**
 * This class is used to render a widget
 * @author Mohammad hosein Saadatfar
 *
 */
class GWRender{
	/**
	 * GWidget to render
	 * @var GWidget
	 */
	public $widget;
	
	/**
	 * GRender constructor
	 * @param GWidget $widget
	 */
	public function __construct($widget){
		$this->widget=$widget;
	}
	/**
	 * Run GWidget RendetInit
	 */
	public function RenderInit(){
		$this->widget->RenderInit();
	}
	/**
	 * Return Widget HTML code
	 * @return string
	 */
	public function Content(){
		$this->RenderInit();
		return $this->widget->Content();
	}
	/**
	 * Return Widget CSS code
	 * @return string
	 */
	public function CSS(){
		$this->RenderInit();
		return $this->widget->CSS();
	}
	/**
	 * Return Widget Java script code
	 * @return string
	 */
	public function JS(){
		$this->RenderInit();
		return $this->widget->JS();
	}
}
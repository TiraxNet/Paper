<?php

class ImgCache extends CComponent
{
	public $cachePath;
	public $cacheUrl;
	
	public function init(){
		$this->cachePath=BASE_PATH.DS.'assets'.DS.'cache'.DS.USER.DS.'ImgCache';
		$this->cacheUrl=yii::app()->baseUrl.'/assets/cache/'.USER.'/ImgCache/';
		if(!is_dir($this->cachePath))
			mkdir($this->cachePath,0777,true);
	}
	
	public function addValue($key,$value)
	{
		$cacheFile=$this->getCacheFile($key);
		if(@imagejpeg($value,$cacheFile,100)!==false)
		{
			@chmod($cacheFile,0777);
			return $this->getUrl($key);
		}else{
			return false;
		}
	}
	
	public function getValue($key)
	{
		$cacheFile=$this->getCacheFile($key);
		if(file_exists($cacheFile))
			return $this->getUrl($key);
		else return false;
	}
	
	protected function getUrl($key){
		return $this->cacheUrl.$key.'.jpg';
	}
	
	protected function getCacheFile($key)
	{
		return $this->cachePath.DIRECTORY_SEPARATOR.$key.'.jpg';
	}
	
}
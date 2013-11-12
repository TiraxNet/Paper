<?php

class ImgCache extends CCache
{
	public $cachePath;
	
	public $serializer=false;
	
	public function init(){
		$this->serializer=false;
		$this->cachePath=USER_PATH.DS.'cache';
		if(!is_dir($this->cachePath))
			mkdir($this->cachePath,0777,true);
	}
	
	protected function addValue($key,$value,$expire)
	{
		$cacheFile=$this->getCacheFile($key);
		if(@filemtime($cacheFile)>time())
			return false;
		return $this->setValue($key,$value,$expire);
	}
	
	protected function setValue($key,$value,$expire)
	{
		if($expire<=0)
			$expire=31536000; // 1 year
		$expire+=time();
		
		$cacheFile=$this->getCacheFile($key);
		if(@imagejpeg($value,$cacheFile,75)!==false)
		{
			@chmod($cacheFile,0777);
			return @touch($cacheFile,$expire);
		}
		else
			return false;
	}
	
	protected function getValue($key)
	{
		$cacheFile=$this->getCacheFile($key);
		if(($time=@filemtime($cacheFile))>time())
			return @imagecreatefromjpeg($cacheFile);
		else if($time>0)
			@unlink($cacheFile);
		return false;
	}
	
	
	protected function getCacheFile($key)
	{
			return $this->cachePath.DIRECTORY_SEPARATOR.$key.'.jpg';
	}
	
	public function get($id){
		$id=serialize($id);
		return parent::get($id);
	}
	
	public function set($id,$value,$expire=0,$dependency=null){
		$id=serialize($id);
		return parent::set($id,$value,$expire,$dependency);
	}
	
}
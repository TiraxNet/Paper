<?php

class NewTmpTest extends WebTestCase
{
	public $fixtures=array(
			'templates'=>'templates',
	);
	
	public function testSimpleNew() {
		$this->Login();
		$this->open("?r=admin/Tmp/list");
		$this->clickAndWait("link=New Template");
		$this->type("id=NewTmpModel_name", "Test");
		$this->clickAndWait("name=yt0");
		$this->type("id=TMPUploadIMG_file", dirname(__FILE__).DS.'SampleTmpPic.jpg');
		$this->clickAndWait("name=yt0");
		$this->assertEquals("", $this->getText("id=MainIMG"));
	}
}
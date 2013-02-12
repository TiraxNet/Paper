<?php 
class LoginTest extends WebTestCase{
	
	public function testLogin() {
		$this->open("?r=admin/login/login");
		$this->type("id=LoginModel_username", "admin");
		$this->type("id=LoginModel_password", "13721372");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
		$this->assertTrue($this->isTextPresent("Logout"));
		$this->open("?r=admin/login/logout");
		$this->assertFalse($this->isTextPresent("Logout"));
	}
}
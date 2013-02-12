<?php

/**
 * Change the following URL based on your server configuration
 * Make sure the URL ends with a slash so that we can use relative URLs in test cases
 */
define('TEST_BASE_URL','http://localhost/paper/index-test.php/');
define('SCREEN_SHOTS_BASE_PATH','/home/mhs/Desktop/www/ScreenShots');
define('SCREEN_SHOTS_BASE_URL','http://localhost/ScreenShots');

/**
 * The base class for functional test cases.
 * In this class, we set the base URL for the test application.
 * We also provide some common methods to be used by concrete test classes.
 */
class WebTestCase extends CWebTestCase
{
	
	public $captureScreenshotOnFailure = TRUE;
	public $screenshotPath = SCREEN_SHOTS_BASE_PATH;
	public $screenshotUrl = SCREEN_SHOTS_BASE_URL;

	/**
	 * Sets up before each test method runs.
	 * This mainly sets the base URL for the test application.
	 */
	protected function setUp()
	{
		parent::setUp();
		$this->setBrowserUrl(TEST_BASE_URL);
	}
	protected function Login()
	{
		$this->open("?r=admin/login/login");
		$this->type("id=LoginModel_username", "admin");
		$this->type("id=LoginModel_password", "13721372");
		$this->click("name=yt0");
		$this->waitForPageToLoad("30000");
	
	}
}

<?php
/**
 * Render Install request
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Render{
	/**
	 * Message stored here will be presented to user 
	 * @var string
	 */
	public $MSG=null;
	/**
	 * Check if user Clicked submit
	 */
	public function CheckForPost()
	{
		if (array_key_exists('IForm',$_POST)) $this->Render_Request($_POST['IForm']);
	}
	/**
	 * Render user install request
	 * @param unknown_type $data
	 * @return boolean
	 */
	public function Render_Request($data)
	{
		if (!$this->InstallSQLStructure($data)) return false;
		if (!$this->CopySample()) return false;
		mysql_close();
		header('Location: ../index.php');
		die;
	}
	/**
	 * Install tables on database
	 * @param string[] $data User POST request array
	 * @return boolean return true if tables installed currectly
	 */
	public function InstallSQLStructure($data)
	{
		$con=@mysql_connect($data['SQLHost'],$data['SQLUsername'],$data['SQLPassword']);
		if (!$con)
		{
			$this->MSG='Could not connect to Mysql.';
			return false;
		}
		if (!@mysql_select_db($data['SQLName']))
		{
			$this->MSG='Could not connect to mysql Database.';
			return false;
		}
		
		$str=file_get_contents(BASE_PATH.DS.'protected'.DS.'config'.DS.'User_config_template.php');
		$str=str_replace('_DB_HOST_',$data['SQLHost'],$str);
		$str=str_replace('_DB_USERNAME_',$data['SQLUsername'],$str);
		$str=str_replace('_DB_PASS_',$data['SQLPassword'],$str);
		$str=str_replace('_DB_NAME_',$data['SQLName'],$str);
		$str=str_replace('_WEBSITE_NAME_',$data['WebsiteName'],$str);
		file_put_contents(BASE_PATH.DS.'protected'.DS.'config'.DS.'User_config.php', $str);
		
		if (!SQL::RunSQLFile('Tables_SQL.sql')){
			$this->MSG='Could not Create Tables Structre';
			return false;
		}
		return true;
	}
	/**
	 * Copy samples data
	 * @return boolean
	 */
	public function CopySample() {
		if (!SQL::RunSQLFile('sample'.DS.'sample.sql')){
			$this->MSG='Could not Install Sample SQL Data.';
			return false;
		}
		self::recurse_copy(INSTALL_PATH.DS.'sample'.DS.'GTemplates',BASE_PATH.DS.'protected'.DS.'GTemplates');
		return true;
	}
	/**
	 * Copy source folder to destination folde 
	 * @param string $src source
	 * @param string $dst destination
	 */
	public static function recurse_copy($src,$dst)
	{
		$dir = opendir($src);
		//@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					self::recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
}


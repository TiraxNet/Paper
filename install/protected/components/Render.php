<?php
/**
 * Render Install request
 * @author Mohammad Hosein Saadatfar <mh.saadatfar@gmail.com>
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class Render extends CComponent{
	private $model;
	private $replaceList=array();
	private $userPath;
	public $MSG;
	
	public function init(){
		$this->model=new OptionsModel();
	} 
	/**
	 * Render user install request
	 * @param unknown_type $data
	 * @return boolean
	 */
	public function Render_Request()
	{	
		$this->model->setAttributes($_POST['OptionsModel'],false);
		if (!$this->creatFileNames()) return false;
		if (!$this->CheckFilePermissions()) return false;
		if (!$this->InstallSQLStructure()) return false;
		if (!$this->CopySample()) return false;
		if ($this->model->UserName!=null){
			if (!$this->addUser()) return false;
		}
		mysql_close();
		header('Location: ../index.php');
		die;
	}
	public function creatFileNames(){
		if ($this->model->UserName==null){
			$this->userPath=Yii::getPathOfAlias('parentRoot.user');
		}else{
			$this->userPath=Yii::getPathOfAlias('parentRoot.user.'.$this->model->UserName);
			@mkdir($this->userPath);
		}
		return true;
	}
	/**
	 * Checks if Config & Sample folders are writable
	 * @return boolean
	 */
	public function CheckFilePermissions(){
		if (!is_writable($this->userPath))
		{
			$this->MSG='User folder is not writable!';
			return false;
		}
		return true;
	}
	/**
	 * Install tables on database
	 * @param string[] $data User POST request array
	 * @return boolean return true if tables installed currectly
	 */
	public function InstallSQLStructure()
	{
		$con=@mysql_connect($this->model->SqlHost,$this->model->SqlUsername,$this->model->SqlPassword);
		if (!$con)
		{
			$this->MSG='Could not connect to Mysql.';
			return false;
		}
		if (!@mysql_select_db($this->model->SqlDatabase))
		{
			$this->MSG='Could not connect to mysql Database.';
			return false;
		}
		$this->replaceList['_DB_HOST_']=$this->model->SqlHost;
		$this->replaceList['_DB_USERNAME_']=$this->model->SqlUsername;
		$this->replaceList['_DB_PASS_']=$this->model->SqlPassword;
		$this->replaceList['_DB_NAME_']=$this->model->SqlDatabase;
		
		$this->replaceList['_WEBSITE_NAME_']=$this->model->WebsiteName;
		$this->replaceList['_ADMIN_MAIL_']=$this->model->AdminMail;
		
		
		if (!$this->WriteSettings()){
			return false;
		}
		
		if (!SQL::RunSQLFile(BASE_PATH.DS.'format'.DS.'Tables_SQL.sql')){
			$this->MSG='Could not Create Tables Structre';
			return false;
		}
		
		return true;
	}
	
	public function WriteSettings(){
		$str=file_get_contents(BASE_PATH.DS.'format'.DS.'User_config_template.php');
		foreach ($this->replaceList as $key=>$val){
			$str=str_replace($key,$val,$str);
		}
		$st=@file_put_contents($this->userPath.DS.'config.php', $str);
		if ($st===false)
		{
			$this->MSG='Could not write Config file. Please Check for permission.';
			return false;
		}
		return true;
	}
	/**
	 * Copy samples data
	 * @return boolean
	 */
	public function CopySample() {
		if (!SQL::RunSQLFile(BASE_PATH.DS.'sample'.DS.'sample.sql')){
			$this->MSG='Could not Install Sample SQL Data.';
			return false;
		}
		$st=self::recurse_copy(BASE_PATH.DS.'sample'.DS.'GTemplates',$this->userPath.DS.'GTemplates');
		if ($st===false) return false;
		else return true;
	}
	/**
	 * Copy source folder to destination folde 
	 * @param string $src source
	 * @param string $dst destination
	 */
	public static function recurse_copy($src,$dst)
	{
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					$st=self::recurse_copy($src . '/' . $file,$dst . '/' . $file);
					if ($st===false) return false;
				}
				else {
					$st=@copy($src . '/' . $file,$dst . '/' . $file);
					if ($st===false) return false;
					else return true;
				}
			}
		}
		closedir($dir);
		return true;
	}
	public function addUser(){
		$file=Yii::getPathOfAlias('parentRoot.user').DS.'users.php';
		include($file);
		$USERS[$this->model->UserName]=$this->model->UrlExpression;
		$txt="<?php\n\n\n\$USERS = array(\n";
		foreach ($USERS as $key=>$val){
			$txt=$txt."\t'".$key."' => '".$val."',\n";
		}
		$txt=$txt.");\n\n\n?>";
		
		$st=@file_put_contents($file, $txt);
		if ($st===false)
		{
			$this->MSG='Could not write User data!';
			return false;
		}
		return true;
	}
}


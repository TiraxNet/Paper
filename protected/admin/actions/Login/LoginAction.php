<?php
/**
 * Admin login action
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class LoginAction extends CAction{
	/**
	 * run action
	 */
	public function run(){
		if (array_key_exists('LoginModel',$_POST)){
			$this->login();
		}else $this->controller->render("login",array());
	}
	/**
	 * get login php request and login
	 */
	public function login(){
		$data=$_POST['LoginModel'];
		if ($data['username']==Yii::app()->params['AdminUsername']
			&& $data['password']==Yii::app()->params['AdminPass']){
				$identity=new UserIdentity($data['username'],$data['password']);
				ob_start();
				Yii::app()->user->login($identity);
				$this->controller->redirect('index.php');
		}
			
	}
}

class UserIdentity extends CUserIdentity
{
 
    public function getId()
    {
        return 'admin';
    }
}


<?php 
class DeleteAction extends GAdminAction{
	public function run($tmp){
		$template=GTemplate::FindById($tmp);
		$template->delete();
		$this->controller->redirect('index.php');
	}
}
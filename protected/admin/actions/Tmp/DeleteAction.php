<?php 
class DeleteAction extends GAdminAction{
	public function run($id){
		$template=GTemplate::FindById($id);
		$template->delete();
		echo 'Deleted Successfullt';
		//$this->controller->redirect('index.php');
	}
}
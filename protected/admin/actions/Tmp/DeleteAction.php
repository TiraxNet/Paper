<?php 
class DeleteAction extends GAdminAction{
	public function run($id,$type='index'){
		if ($type=='index')
		{
			$template=GTemplate::FindById($id);
			$template->delete();
			echo 'Deleted Successfullt';
		}
		else
		{
			$file=GTemplate::GetPath($id).DS.$type.'.jpg';
			unlink($file);
			$this->controller->redirect(array('Tmp/update','id'=>$id));
		}
	}
}
<?php 
/**
 * Delete template action
 * @package Paper.admin.actions
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class DeleteAction extends CAction{
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
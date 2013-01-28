<?php
/**
 * This Class provides all we need to work with paper!
 * @author Mohammad Hosein Saadatfar 
 *
 */
class GClass{
	
	/**
	 * Template version
	 * @var integer
	 */
	public $version;
	/**
	 * Template id
	 * @var string
	 */
	public $id;
	/**
	 * Template name
	 * @var string
	 */
	public $name;
	/**
	 * Template Address location
	 * @var string
	 */
	public $address;
	/**
	 * Template CSS array
	 * @var array
	 */
	public $CSS=array();
	/**
	 * Template Blocks array; Filled by "__construct" function.
	 * @var array
	 */
	public $blocks=array();
	/**
	 * Template Table structure; Filled by "render_blocks" function.
	 * @var array
	 */
	public $table_struct=array();
	/**
	 * Template Picture.
	 * @var GPic
	 */
	public $Pic;
	/**
	 * Template Render class.
	 * @var GRender
	 */
	public $Render;
	
	/**
	 * GClass Constructor.
	 * @param string $tmp Template id
	 */
	function __construct($tmp){
		$this->Pic=new GPic;
		$this->Render=new GRender($this);
		
		$tmp_db=templates::model()->findByPk($tmp);
		if ($tmp_db==null) throw new CHttpException('10001','Template not found');
		
		//echo 'Salam';
		//echo 'application.templates.'.$tmp.DS.'index.jpg';
		if (!file_exists(Yii::getPathOfAlias('application.templates.'.$tmp).DS.'index.jpg')) throw new CHttpException('10002','Template Index image not found');
		$this->Pic->Address=Yii::getPathOfAlias('application.templates.'.$tmp);
		
		$this->name=$tmp_db['name'];
		$this->id=$tmp;
		$this->version=$tmp_db['version'];
		$this->CSS=$tmp_db['css'];
			
		$dbblocks=blocks::model()->findAll('tmp=:tmp', array(':tmp'=>$tmp));
		foreach($dbblocks as $block){
			$this->blocks[$block['id']]=new GBlock($this);
			$this->blocks[$block['id']]->SetFromArray($block->getAttributes());
			$this->blocks[$block['id']]->auto=false;
		}
		$this->render_blocks();
	}
	/**
	 * This function render blocks and creates table structue ans store it in "$this-$table_struct";
	 */
	function render_blocks(){
		$picture_size=getimagesize($this->Pic->Address.DS.'index.jpg');
		$this->Pic->Width=$picture_size[0];
		$this->Pic->Height=$picture_size[1];
		unset($picture_size);
		$break_points=array('x'=>array(0,$this->Pic->Width),'y'=>array(0,$this->Pic->Height));
		foreach ($this->blocks as $Mobject){
			array_push($break_points['x'],$Mobject->x1);
			array_push($break_points['x'],$Mobject->x2);
			array_push($break_points['y'],$Mobject->y1);
			array_push($break_points['y'],$Mobject->y2);
		}
		sort($break_points['x'],SORT_NUMERIC);
		sort($break_points['y'],SORT_NUMERIC);
		
		$break_points['x']=array_values(array_unique($break_points['x'],SORT_NUMERIC));
		$break_points['y']=array_values(array_unique($break_points['y'],SORT_NUMERIC));

		foreach($this->blocks as $index => $Mobject){
			$i=0;
			$j=0;
			while($break_points['x'][$i]!=$Mobject->x1) $i++;
			while($break_points['x'][$i+$j]!=$Mobject->x2) $j++;
			$this->blocks[$index]->colspan=$j;
			$i=0;
			$j=0;
			while($break_points['y'][$i]!=$Mobject->y1) $i++;
			while($break_points['y'][$i+$j]!=$Mobject->y2) $j++;
			//echo $i."-".$j.";";
			$this->blocks[$index]->rowspan=$j;
			$this->blocks[$index]->width=$Mobject->x2-$Mobject->x1;
			$this->blocks[$index]->height=$Mobject->y2-$Mobject->y1;	
		}
		$MHelp=array_fill(0, sizeof($break_points['x']),
		   array_fill(0, sizeof($break_points['y'],0), 0)
		   );
		foreach ($this->blocks as $block){
			$x=0;
			while($break_points['x'][$x]!=$block->x1) $x++;
			$y=0;
			while($break_points['y'][$y]!=$block->y1) $y++;
			for ($i=0;$i<$block->colspan;$i++){
				for ($j=0;$j<$block->rowspan;$j++){
					$MHelp[$x+$i][$y+$j]=1;
				}
			}
		}
		//print_r($MHelp);
		$table_struct=array(); 
		for ($row=0;$row<sizeof($break_points['y'])-1;$row++){
			$table_row=array();
			for ($col=0;$col<sizeof($break_points['x'])-1;$col++){
				if ($MHelp[$col][$row]==0){
					$i=0;
					if ($row==sizeof($break_points['y'])-2){
						$MHelp[$col][$row]=1;
						$i=1;
					}else{
						while($MHelp[$col+$i][$row]==0 && ($col+$i)<(sizeof($break_points['x'])-1)){
							$MHelp[$col+$i][$row]=1;
							$i++;
						}
					}
					$j=1;
					$block=new GBlock($this);
					$block->name=$row.'_'.$col;
					$block->id='A_'.$block->name;
					$block->type=0;
					$block->x1=$break_points['x'][$col];
					$block->y1=$break_points['y'][$row];
					$block->x2=$break_points['x'][$col+$i];
					$block->y2=$break_points['y'][$row+$j];
					$block->width=$break_points['x'][$col+$i]-$break_points['x'][$col];
					$block->height=$break_points['y'][$row+$j]-$break_points['y'][$row];
					$block->colspan=$i;
					$block->rowspan=$j;
					$block->widget="none";
					$block->auto=true;
					$this->blocks[$block->id]=$block;
					array_push($table_row,$block->id);					
				}else{
					$inMap=$this->findFromStart($break_points['x'][$col],$break_points['y'][$row]);
					if ($inMap!=false) array_push($table_row,$inMap);
				}
			}
			//print_r($this->blocks);
			array_push($table_struct,$table_row);
		}
		$this->table_struct=$table_struct;
		//print_r($table_struct);
		//print_r($this->blocks);
	}
	/**
	 * This functiond find a block using it's start position.
	 * @param integer $x Start X
	 * @param integer $y Start Y
	 */
	function findFromStart($x,$y){
		foreach($this->blocks as $index => $Mobject){
			if ( $Mobject->x1==$x
			  && $Mobject->y1==$y){
				  return $index;
			}
		}
		return false;
	}
	
}
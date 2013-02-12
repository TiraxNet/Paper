<?php
/**
 * Some useful functions as an extension
 * @author Mohammad Hosein Saadatfar
 * @copyright Copyright &copy; Mohammad Hosein Saadatfar 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class functions{
	/**
	 * Do nothing!
	 */
	public function init(){}
	
	/**
	 * Remove empty|non-empty directory
	 * @param strin $dir directory location
	 */
	public static function rrmdir($dir,$just_inside=false) {
	   if (is_dir($dir)) {
	     $objects = scandir($dir);
	     foreach ($objects as $object) {
	       if ($object != "." && $object != "..") {
	         if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
	       }
	     }
	     reset($objects);
	     if (!$just_inside) rmdir($dir);
	   }
	 }
	 /**
	  * Copy Source directory content to Destination
	  * @param string $src source
	  * @param string $dst destination
	  * @return boolean
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
	
}
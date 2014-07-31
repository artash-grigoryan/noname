<?php
abstract class FileUploadAjaxView{
	
	function  __construct(){}
	
	static function display( $action, $content = false ){
		
		try {
			require_once(FILEUPLOADAJAX_ABS_PATH."view/".$action."/".$action.".php");
		}
		catch (Exception $e){
			echo $e->getMessage();
		}
		return ;
	}
}
?>
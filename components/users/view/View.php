<?php
abstract class UsersView extends View {
	
    function  __construct(){
        parent::__construct();
    }
/*
    static function display( $action, $content ){

        try 
        {
            require_once(HOME_REL_PATH."view/".$action."/".$action.".php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
        return ;
    }
 */
}
?>
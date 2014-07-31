<?php

class IndexController  extends Controller  {

    function index()
    {
        $this->_View->setTitle('Bienvenue dans votre espace');
        self::initComponent('forum2', 'form');
        self::initComponent('forum2', 'display');
        self::loadComponent('forum2', 'index');
    }
    
    function exception() {}
}
?>
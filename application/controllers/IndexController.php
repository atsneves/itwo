<?php

class IndexController extends Zend_Controller_Action
{
    public function preDispatch() {
        parent::preDispatch();
        
        $auth = Zend_Auth::getInstance();
        
        if(!$auth->hasIdentity()){
            $this->_helper->FlashMessenger(array('erro'=>'Acesso Negado'));
            
            $this->_redirect('/login');
        }
    }
    
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }
    

}
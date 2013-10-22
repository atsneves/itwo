<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        //$this->_helper->layout->setLayout('login');
    }

    public function indexAction()
    {
        $form = new Application_Form_Login();
        $request = $this->_request;
        
        if($request->isPost()){
            $data = $request->getPost();
            
            if($form->isValid($data)){
                
                $filtro = new Zend_Filter_StringTrim('\'');
               
                $data['login'] = $filtro->filter($form->getValue('login'));
                $data['senha'] = $filtro->filter($form->getValue('senha'));
                
                $data = $form->getValues();
                
                $login = Application_Model_Login::login($data['login'], $data['senha']);
                
                if($login === true){
                    $this->_redirect('/');
                }else{
                    $this->_helper->FlashMessenger(array('erro'=>$login));
                    $form->populate($data);
                }
            }
        }
        
        $this->view->form = $form;
        $this->view->login = true;
    }
    
    public function sairAction(){
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/login');
    }


}
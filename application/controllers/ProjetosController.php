<?php

class ProjetosController extends Zend_Controller_Action
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
        $this->view->pag = 'projetos';
    }

    public function indexAction()
    {
        $model = new Application_Model_Projetos();
        $this->view->projetos = $model->listar();
    }
    
    public function formAction()
    {
        $form = new Application_Form_Projetos();
        $model = new Application_Model_Projetos();
        
        $id = $this->_getParam('id');
        $data = array();
        if($this->_request->isPost()){
            
            if($form->isValid($this->_request->getPost())){
                $data['nome'] = $form->getValue('nome');
                $data['login'] = $form->getValue('login');
                $data['senha'] = $form->getValue('senha');
                $data['textofixo'] = $form->getValue('textofixo');
                $data['texto'] = $form->getValue('texto');
                $data['fanpage'] = $form->getValue('fanpage');
                $data['fanpage_id'] = $form->getValue('fanpage_id');
				$data['pesquisa_id'] = $form->getValue('pesquisa_id');
				$data["votacao"] =  $form->getValue('votacao');
				$data["link_votacao"] =  $form->getValue('link_votacao');
				
                if(!$data['senha']){
                    unset($data['senha']);
                }else{
                    $data['senha'] = md5($data['senha']);
                }
                    
                if($id){
                    $model->atualizar($id, $data);
                    $this->_redirect('/projetos');
                }else{
                    $id = $model->inserir($data);
                    $this->_redirect('/projetos/molduras/id/'. $id);
                }
            }
        }elseif($id){
            $data = $model->editar($id);
            if(is_array($data)){
            	$form->populate($data);
            }
            
            $this->view->editar = true;
        }
        
        $this->view->form = $form;
    }
    
    public function moldurasAction()
    {
        $modelPrjetos = new Application_Model_Projetos();
        $modelMolduras = new Application_Model_Molduras();
        $id = $this->_getParam('id',0);
        
        $projeto = $modelPrjetos->buscaPorId($id);
        
        if($projeto){
            $molduras = $modelMolduras->listar($id);
            $this->view->projeto = $projeto;
            $this->view->molduras = $molduras;
        }else{
            $this->_redirect('/projetos');
        }
    }
    
    public function uploadAction()
    {
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        if($this->getRequest()->isPost()){
            $caminho = APPLICATION_PATH . "/../public/molduras/";
            
            $adapter = new Zend_File_Transfer_Adapter_Http();
            $adapter->setDestination($caminho);
            $adapter->addValidator('Extension', false, 'jpeg,jpg,png,gif,bmp');
            $adapter->addValidator('Size',false,array('max' => 5242880));

            $nm	 = $adapter->getFileName('moldura',false);
            
            $ext = substr($nm,-3);

            if($ext == 'peg'){
                $ext = 'jpeg';	
            }
            
            $dtHora = date("Y-m-d H:i:s");
            $nme    = md5($nm.$_SERVER['HTTP_HOST'].$dtHora);
            $nome   = $nme . '.' . $ext;
            $adapter->addFilter('Rename',array('target' => $nome));
            
            if($adapter->isValid()){
                $adapter->receive();
                
                $projeto = $this->_getParam('projeto',0);
                
                if($projeto){
                    $data = array('moldura'=>$nome,'projeto_id'=>$projeto);
                    $modelMolduras = new Application_Model_Molduras();
                    $id = $modelMolduras->inserir($data);
                    echo $id . '##' . $nome;
                }
            }
        }
    }
    
    public function verificaloginAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Projetos();
        $login = $this->_getParam('login',0);
        $verifica = $model->verificalogin($login);
        
        if($verifica){
            echo 'existe';
        }
    }
    
    public function deletemolduraAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Molduras();
        $id = $this->_getParam('id',0);
        $model->excluir($id);
    }
    
    public function deleteprojetoAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Projetos();
        $id = $this->_getParam('id',0);
        $model->excluir($id);
        $this->_redirect('/projetos');
    }

}
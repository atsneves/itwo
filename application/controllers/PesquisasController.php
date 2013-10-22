<?php

class PesquisasController extends Zend_Controller_Action
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
        $this->view->pag = 'pesquisas';
    }

    public function indexAction()
    {
        $model = new Application_Model_Pesquisas();
        $this->view->pesquisas = $model->listar();
    }
    
    public function formAction()
    {
        $form = new Application_Form_Pesquisas();
        $model = new Application_Model_Pesquisas();
        
        $id = $this->_getParam('id');
        $data = array();
        if($this->_request->isPost()){
            
            if($form->isValid($this->_request->getPost())){
                $data['nome'] = $form->getValue('nome');
                $data['login'] = $form->getValue('login');
                $data['senha'] = $form->getValue('senha');
		
                if(!$data['senha']){
                    unset($data['senha']);
                }else{
                    $data['senha'] = md5($data['senha']);
                }
                
                if($id){
                    $model->atualizar($id, $data);
                    $this->_redirect('/pesquisas');
                }else{
                    $id = $model->inserir($data);
                    $this->_redirect('/pesquisas/perguntas/id/'. $id);
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
    
    public function verificaloginAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Pesquisas();
        $login = $this->_getParam('login',0);
        $verifica = $model->verificalogin($login);
        
        if($verifica){
            echo 'existe';
        }else{
            $model = new Application_Model_Projetos();
            $verifica = $model->verificalogin($login);
            if($verifica){
                echo 'existe';
            }
        }
    }
    
    public function deleteAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Pesquisas();
        $id = $this->_getParam('id',0);
        $model->excluir($id);
        $this->_redirect('/pesquisas');
    }
    
    public function perguntasAction()
    {
        $model = new Application_Model_Perguntas();
        $modelPesquisas = new Application_Model_Pesquisas();
        $id = $this->_getParam('id');
        $pesquisa = $modelPesquisas->buscaPorId($id);
        
        $this->view->pesquisa = $pesquisa;
        $this->view->perguntas = $model->listar($id);
    }
    
    public function formperguntaAction()
    {
        $form = new Application_Form_Perguntas();
        $model = new Application_Model_Perguntas();
        
        $id = $this->_getParam('id');
        $idPesquisa = $this->_getParam('idpesquisa',0);
        $data = array();
        if($this->_request->isPost()){
            
            if($form->isValid($this->_request->getPost())){
                $data['pergunta'] = $form->getValue('pergunta');
                $data['pesquisa_id'] = $form->getValue('pesquisa_id');
                
                if(!$data['pesquisa_id']){
                   $data['pesquisa_id'] = $idPesquisa;
                }else{
                    $idPesquisa = $data['pesquisa_id'];
                }
                
                if($id){
                    $model->atualizar($id, $data);
                    $this->_redirect('/pesquisas/perguntas/id/' . $idPesquisa);
                }else{
                    $id = $model->inserir($data);
                    $this->_redirect('/pesquisas/respostas/id/'. $id);
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
    
    public function deleteperguntaAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Perguntas();
        $idPesquisa = $this->_getParam('idpesquisa',0);
        $id = $this->_getParam('id',0);
        $model->excluir($id);
        $this->_redirect('/pesquisas/perguntas/id/' . $idPesquisa);
    }
    
    public function respostasAction()
    {
        $model = new Application_Model_Respostas();
        $modelPerguntas = new Application_Model_Perguntas();
        $id = $this->_getParam('id');
        $pergunta = $modelPerguntas->buscaPorId($id);
        
        $this->view->pergunta = $pergunta;
        $this->view->respostas = $model->listar($id);
    }
    
    public function formrespostaAction()
    {
        $form = new Application_Form_Respostas();
        $model = new Application_Model_Respostas();
        
        $id = $this->_getParam('id');
        $idpergunta = $this->_getParam('idpergunta',0);
        $data = array();
        if($this->_request->isPost()){
            
            if($form->isValid($this->_request->getPost())){
                $data['resposta'] = $form->getValue('resposta');
                $data['pergunta_id'] = $form->getValue('pergunta_id');
                
                if(!$data['pergunta_id']){
                   $data['pergunta_id'] = $idpergunta;
                }else{
                    $idpergunta = $data['pergunta_id'];
                }
                
                if($id){
                    $model->atualizar($id, $data);
                    $this->_redirect('/pesquisas/respostas/id/' . $idpergunta);
                }else{
                    $id = $model->inserir($data);
                    $this->_redirect('/pesquisas/respostas/id/' . $idpergunta);
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
    
    public function deleterespostaaAction(){
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
        $model = new Application_Model_Respostas();
        $idpergunta = $this->_getParam('idpergunta',0);
        $id = $this->_getParam('id',0);
        $model->excluir($id);
        $this->_redirect('/pesquisas/respostas/id/' . $idpergunta);
    }

}
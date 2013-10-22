<?php

class Application_Model_Login extends Zend_Db_Table_Abstract
{
    public static function login($login, $senha){
        $model = new self;
        
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'sistema',
                'login',
                'senha'
        );
        
        $adapter->setIdentity($login);
        $adapter->setCredential($senha);
        
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        
        if($result->isValid()){
            $data = $adapter->getResultRowObject(null,'senha');
            $auth->getStorage()->write($data);
            
            return true;
        }else{
            return $model->getMessages($result);
        }
    }
    
    public function getMessages(Zend_Auth_Result $result){
        switch ($result->getCode()){
            case $result:FAILURE_IDENTITY_NOT_FOUND;
                $msg = 'Login não encontrado';
            break;
            
            case $result:FAILURE_IDENTITY_AMBIGUOUS;
                $msg = 'Login duplicado';
            break;
        
            case $result:FAILURE_CREDENTIAL_INVALID;
                $msg = 'Senha incorreta';
            break;
        
            default:
                $msg = 'Login e/ou Senha não encontrados';
        
        }
        
        return $msg;
    }


}


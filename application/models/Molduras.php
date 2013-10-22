<?php

class Application_Model_Molduras extends Zend_Db_Table
{
    protected $_name = 'molduras';
    
    public function listar($id){
        try{
            $sql = $this->select()
                        ->where('projeto_id = ?',$id);
            
            return $this->fetchAll($sql);
       }catch (Exception $e){
            return $e->getMessage();
       }
    }
    
    public function inserir($data){
        try{
            $id = $this->insert($data);
            return $id; 
        }  catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function excluir($id){
        try{
            $where = $this->getAdapter()->quoteInto('id = ?',$id);
            
            $this->delete($where);
            
        }  catch (Exception $e){
            return $e->getMessage();
        }
    }


}
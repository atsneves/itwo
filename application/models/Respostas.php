<?php

class Application_Model_Respostas extends Zend_Db_Table
{
    protected $_name = 'respostas';
    
    public function listar($id){
        try{
            return $this->fetchAll('pergunta_id = ' . $id);
       }catch (Exception $e){
            return $e->getMessage();
       }
    }
    
    public function editar($id){
        try{
            $sql = $this->select()
                        ->where('id = ?',$id);
            $row = $this->fetchRow($sql);
            
            if($row !== null)
                return $row->toArray ();
            
        }  catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function buscaPorId($id){
        try{
            $sql = $this->select()
                        ->where('id = ?',$id);
            return $this->fetchRow($sql);
            
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function atualizar($id, $data){
        try{
            $where = $this->getAdapter()->quoteInto('id = ?',$id);
            $this->update($data, $where);
                   
        }  catch (Exception $e){
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
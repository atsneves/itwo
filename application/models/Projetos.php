<?php

class Application_Model_Projetos extends Zend_Db_Table
{
    protected $_name = 'projetos';
    
    public function listar(){
        try{
            return $this->fetchAll();
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
    
    public function login($login, $senha){
        try{
            $sql = $this->select()
                        ->where('login = ?',$login)
                        ->where('senha = ?',md5($senha));
            return $this->fetchRow($sql);
            
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function verificalogin($login){
        try{
            $sql = $this->select()
                        ->where('login = ?',$login);
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
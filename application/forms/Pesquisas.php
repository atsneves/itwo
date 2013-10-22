<?php

class Application_Form_Pesquisas extends Zend_Form
{

    public function init()
    {
        $this->setName('pesquisas');
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite o Nome da Pesquisa'
              ));
	    
	$login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite o Login da Pesquisa'
              ));
        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha:')
              ->setAttrib('class', 'span4')
              ->addFilter('StripTags')
              ->addFilter('StringTrim');
        
        $salvar = new Zend_Form_Element_Submit('salvar');
        $salvar->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($nome, $login, $senha, $salvar));
        
        $this->setElementDecorators(array(
                   'ViewHelper',
                   'Errors',
                   'Description',
               ));
        
       $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
    }
}
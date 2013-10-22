<?php

class Application_Form_Projetos extends Zend_Form
{

    public function init()
    {
        $this->setName('projetos');
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite o Nome do Projeto'
              ));
	    
	$login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite o Login do Projeto'
              ));
        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha:')
              ->setAttrib('class', 'span4')
              ->addFilter('StripTags')
              ->addFilter('StringTrim');
        
        $textofixo = new Zend_Form_Element_Checkbox('textofixo');
        $textofixo->setLabel('Texto Fixo:')
                  ->setAttrib('value', '1');
        
        $texto = new Zend_Form_Element_Text('texto');
        $texto->setLabel('Texto:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite o Texto do Projeto'
              ));
			  
			  
		$textofixovota = new Zend_Form_Element_Checkbox('votacao');
        $textofixovota->setLabel('Vai ter votação:')
                  ->setAttrib('value', '1');
        
        $textovotalink = new Zend_Form_Element_Text('link_votacao');
        $textovotalink->setLabel('Link votação:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite o Link da votação'
              ));	  
			  
        
        $fanpage = new Zend_Form_Element_Text('fanpage');
        $fanpage->setLabel('Fanpage:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite a Fanpage do Projeto'
              ));
        
        $fanpage_id = new Zend_Form_Element_Text('fanpage_id');
        $fanpage_id->setLabel('Fanpage ID:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite a Fanpage Id do Projeto'
              ));
			  
			  
		$model = new Application_Model_Pesquisas();	  
		
		
		$select_pesquisa = new Zend_Form_Element_Select("pesquisa_id");
		$select_pesquisa->setLabel('Pesquisa:')
                  ->setAttrib('value', '1')
				  ->addMultiOption("","----");
	
		foreach ($model->listar() as $data): 
			$select_pesquisa->addMultiOption($data["id"],$data['nome']);
		endforeach;
	
        
        $salvar = new Zend_Form_Element_Submit('salvar');
        $salvar->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($nome, $login, $senha, $textofixo, $texto,$textofixovota,$textovotalink, $fanpage, $fanpage_id,$select_pesquisa,  $salvar));
        
        $this->setElementDecorators(array(
                   'ViewHelper',
                   'Errors',
                   'Description',
               ));
        
       $this->setDecorators(array(
            'FormElements',
            'Form',
            
        ));
    }


}
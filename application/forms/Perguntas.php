<?php

class Application_Form_Perguntas extends Zend_Form
{

    public function init()
    {
        $this->setName('perguntas');
        
        $pergunta = new Zend_Form_Element_Text('pergunta');
        $pergunta->setLabel('Pergunta:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite a Pergunta'
              ));
	    
	$pesquisa_id = new Zend_Form_Element_Hidden('pesquisa_id');
        
        $salvar = new Zend_Form_Element_Submit('salvar');
        $salvar->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($pergunta, $pesquisa_id, $salvar));
        
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
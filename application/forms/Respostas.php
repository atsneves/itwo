<?php

class Application_Form_Respostas extends Zend_Form
{

    public function init()
    {
        $this->setName('perguntas');
        
        $resposta = new Zend_Form_Element_Text('resposta');
        $resposta->setLabel('Resposta:')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttribs(array(
                  'class'=>'span4',
                  'placeholder'=>'Digite a Resposta'
              ));
	    
	$pergunta_id = new Zend_Form_Element_Hidden('pergunta_id');
        
        $salvar = new Zend_Form_Element_Submit('salvar');
        $salvar->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($resposta, $pergunta_id, $salvar));
        
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
<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setName('login');

        $email = new Zend_Form_Element_Text('login');
        $email->setLabel('Login:')
              ->setAttrib('class', 'span3')
              ->addFilter('StripTags')
              ->addFilter('StringTrim');

        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha:')
              ->setAttrib('class', 'span3')
              ->addFilter('StripTags')
              ->addFilter('StringTrim');

        $entrar = new Zend_Form_Element_Submit('Entrar');
        $entrar->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($email, $senha, $entrar));
        
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
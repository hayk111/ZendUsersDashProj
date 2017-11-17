<?php

class Application_Form_Adduser extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	$this->setAttrib('action', 'save');

    	$name = new Zend_Form_Element_Text('firstname');
    	$name->setLabel('First name')
    		->addFilter('StripTags')
    		->setRequired(true);

    	$lname = new Zend_Form_Element_Text('lastname');
    	$lname->setLabel('Last name')
    		->addFilter('StripTags')
    		->setRequired(true);

    	$email = new Zend_Form_Element_Text('email');
    	$email->setLabel('Email')
    		->addFilter('StripTags')
    		->addValidator('EmailAddress')
    		->setRequired(true);

    	$mobile = new Zend_Form_Element_Text('mobile');
    	$mobile->setLabel('Mobile')
    		->addFilter('StripTags')
    		->setRequired(true);
 		
    	$password = new Zend_Form_Element_Password('password');
    	$password->setLabel('Password')
    		->addFilter('StripTags')
    		->setRequired(true);

    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Save');

        $this->addElements(array($name, $lname, $email, $mobile, $password, $submit));
    }


}


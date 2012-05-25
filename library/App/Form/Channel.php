<?php

class App_Form_Channel  extends \Zend_Form
{
    public function init ()
    {
        /* Form Elements & Other Definitions Here ... */
        //initialize form
        //$this->setAction('/Admin/customer/edit')
        $this->setMethod('post');
        //create text input for e-mail address
        $name = new \Zend_Form_Element_Text('name');
        $name->setLabel('Customer Name')
            ->setOptions(array('size' => '50'))
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addFilter('HtmlEntities');


        $id = new \Zend_Form_Element_Hidden('id');
        $id->addFilter('StringTrim')->addFilter('HtmlEntities');
        $submit = new \Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit Changes')->setOptions(
        array('class' => 'btn btn-primary'));
        //Attach elements to the form
        $this->addElement($id)
            ->addElement($name)
            ->addElement($submit);
    }
    public function setSubmitLabel ($label)
    {
        $this->submit->setLabel($label);
    }
}
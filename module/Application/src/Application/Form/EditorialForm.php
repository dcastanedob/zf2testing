<?php

namespace Application\Form;

use Zend\Form\Form;

class EditorialForm extends Form
{
    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('EditorialForm');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'editorial_nombre',
            'type' => 'Text',
            
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
            ),
        ));

    }
}
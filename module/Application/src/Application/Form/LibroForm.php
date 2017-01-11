<?php

namespace Application\Form;

use Zend\Form\Form;

class LibroForm extends Form
{
    public function __construct($autor_array = array(), $editorial_array = array())
    {
        // we want to ignore the name passed
        parent::__construct('LibroForm');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'libro_nombre',
            'type' => 'Text',
            
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
            ),
        ));


        $this->add(array(
            'name' => 'idautor',
            'type' => 'Select',
            'options' => array(
                'empty_option' => 'Seleccione un autor',
                'value_options' => $autor_array,
            ),
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
            ),
        ));


        $this->add(array(
            'name' => 'ideditorial',
            'type' => 'Select',
            'options' => array(
                'empty_option' => 'Seleccione una editorial',
                'value_options' => $editorial_array,
            ),
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
            ),
        ));
        
       
        
        
        
    }
}
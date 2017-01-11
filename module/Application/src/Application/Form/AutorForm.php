<?php

namespace Application\Form;

use Zend\Form\Form;

class AutorForm extends Form
{
    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('AutorForm');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'autor_nombre',
            'type' => 'Text',
            
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
            ),
        ));


        $this->add(array(
            'name' => 'autor_pais',
            'type' => 'Select',
            'options' => array(
                'empty_option' => 'Seleccione un país',
                'value_options' => array(
	                	"Mexico" => "Mexico",
	                	"EUA" => "EUA",
	                	"Colombia" => "Colombia"
	              	),
            ),
            'attributes' => array(
                'required' => true,
                'class' => 'form-control',
            ),
        ));
        
       
        
        
        
        
        

    }
}
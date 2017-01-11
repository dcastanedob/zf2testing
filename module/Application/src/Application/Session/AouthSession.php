<?php 

namespace Application\Session;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;


class AouthSession extends AbstractActionController {

    /**
     * 
     * @param array $session
     * @param type $expirationTime
     */
    public function Create( array $session=null) {
        
            
            $session["idusuario"] = array_key_exists( "idusuario", $session ) ? $session["idusuario"] : null;
            $session["usuario_nickname"] = array_key_exists( "usuario_nickname", $session ) ? $session["usuario_nickname"] : null;
            $session["usuario_nombre"] = array_key_exists( "usuario_nombre", $session ) ? $session["usuario_nombre"] : null;

            $session_data = new Container('session_data');
            $session_data->idusuario        = $session["idusuario"];
            $session_data->usuario_nickname = $session["usuario_nickname"];
            $session_data->usuario_nombre   = $session["usuario_nombre"];

    }
    
    /**
     * 
     * @return boolean
     */
    public function Close() {
        
        $session_data = new Container('session_data');
        $session_data->idusuario            = null;
        $session_data->usuario_nickname     = null;
        $session_data->usuario_nombre       = null;

        $session_data->getManager()->getStorage()->clear('session_data');
        
        return true;  
    }
    
    /**
     * 
     * @return boolean
     */
    public function isActive() {    
        $session_data = new Container('session_data');
        if( $session_data->idusuario != null){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 
     * @return array
     */
    public function getData() {
        
        $session_data = new Container('session_data');
        
        return array(
            "idusuario"                 => $session_data->idusuario,
            "usuario_nickname"           => $session_data->usuario_nickname,
            "usuario_nombre"            => $session_data->usuario_nombre,

        );
    }
    

}

?>
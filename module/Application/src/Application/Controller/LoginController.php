<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Session\AouthSession;

class LoginController extends AbstractActionController
{
    public function indexAction()
    {
        
        $this->layout('layout/layout_login');
        
        return new ViewModel();
    }
    
    public function inAction(){
        
        $request = $this->getRequest();
        
        if($request->isPost()){
            
            $post_data = $request->getPost();
            
            $is_valid = \UsuarioQuery::create()->filterByUsuarioNickname($post_data['usuario_nickname'])->filterByUsarioPassword(md5($post_data['usuario_password']))->exists();
            
            if($is_valid){
                
                $usuario = \UsuarioQuery::create()->filterByUsuarioNickname($post_data['usuario_nickname'])->filterByUsarioPassword(md5($post_data['usuario_password']))->findOne();
 
                $session = new AouthSession();
                $session->Create($usuario->toArray(\BasePeer::TYPE_FIELDNAME));

                return $this->redirect()->toUrl('/libro');
            }else{
                return $this->redirect()->toUrl('/login');
            }

        }

    }
    
    public function outAction(){
        
          $session = new AouthSession();
           $session->Close();
        
         return $this->redirect()->toUrl('/login');
    }
}

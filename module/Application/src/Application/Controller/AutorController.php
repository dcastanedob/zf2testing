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
use Application\Form\AutorForm;

class AutorController extends AbstractActionController
{
    public function indexAction()
    {
    	$autores =  \AutorQuery::create()->find();

        return new ViewModel(array(
        	'autores'=>$autores
        ));
    }

    public function nuevoAction(){

    	$post_request = $this->getRequest();

    	if($post_request->isPost()){
    		$post_data = $post_request->getPost();

    		$autor = new \Autor();
    		
    		/*
    		$autor->setAutorNombre($post_data['autor_nombre']);
    		$autor->setAutorPais($post_data['autor_pais']);
			*/

			foreach ($post_data as $key => $value) {
				if(\AutorPeer::getTableMap()->hasColumn($key)){
					$autor->setByName($key,$value, \BasePeer::TYPE_FIELDNAME);
				}
			}

    		$autor->save();

    		return $this->redirect()->toUrl("/autor");

    		
    	}

    	$form  = new AutorForm();


    	return new ViewModel(array(
    		'form' => $form,
    	));
    }


    public function editarAction(){

    	$id = $this->params()->fromRoute('id');

    	$exist = \AutorQuery::create()->filterByIdautor($id)->exists();

    	if($exist){
    		$autor = \AutorQuery::create()->findPk($id);

    		$post_request = $this->getRequest();

	    	if($post_request->isPost()){
	    		$post_data = $post_request->getPost();


				foreach ($post_data as $key => $value) {
					if(\AutorPeer::getTableMap()->hasColumn($key)){
						$autor->setByName($key,$value, \BasePeer::TYPE_FIELDNAME);
					}
				}

	    		$autor->save();

	    		return $this->redirect()->toUrl("/autor");
	    	}

    	}else{
    		return $this->redirect()->toUrl("/autor");
    	}

    	$form  = new AutorForm();
    	$form->setData($autor->toArray(\BasePeer::TYPE_FIELDNAME));

    	return new ViewModel(array(
    		'autor' =>$autor,
    		'form' => $form,
    	));
    }


    public function eliminarAction(){

    	$id = $this->params()->fromRoute('id');

    	$exist = \AutorQuery::create()->filterByIdautor($id)->exists();

    	if($exist){
    		$autor = \AutorQuery::create()->findPk($id);

    		$post_request = $this->getRequest();

	    	if($post_request->isPost()){
	    		$autor->delete();


	    		return $this->redirect()->toUrl("/autor");
	    	}

    	}else{
    		return $this->redirect()->toUrl("/autor");
    	}

    	return new ViewModel(array(
    		'autor'=> $autor,
    	));
    }
}

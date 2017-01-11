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
use Application\Form\LibroForm;

class LibroController extends AbstractActionController
{
    public function indexAction()
    {
        

    	$libros =  \LibroQuery::create()->find();

        return new ViewModel(array(
        	'libros'=>$libros
        ));
    }

    public function nuevoAction(){

    	$post_request = $this->getRequest();

    	if($post_request->isPost()){
    		$post_data = $post_request->getPost();

    		$libro = new \Libro();
    		
    		

			foreach ($post_data as $key => $value) {
				if(\LibroPeer::getTableMap()->hasColumn($key)){
					$libro->setByName($key,$value, \BasePeer::TYPE_FIELDNAME);
				}
			}

    		$libro->save();

    		return $this->redirect()->toUrl("/libro");

    		
    	}

        $autor_array = \AutorQuery::create()->select(array('idautor','autor_nombre'))->find()->toKeyValue('idautor','autor_nombre');

        $editorial_array = \EditorialQuery::create()->select(array('ideditorial','editorial_nombre'))->find()->toKeyValue('ideditorial','editorial_nombre');
        

    	$form  = new LibroForm($autor_array,$editorial_array);


    	return new ViewModel(array(
    		'form' => $form,
    	));
    }


    public function editarAction(){

    	$id = $this->params()->fromRoute('id');

    	$exist = \LibroQuery::create()->filterByIdlibro($id)->exists();

    	if($exist){
    		$libro = \LibroQuery::create()->findPk($id);

    		$post_request = $this->getRequest();

	    	if($post_request->isPost()){
	    		$post_data = $post_request->getPost();


				foreach ($post_data as $key => $value) {
					if(\LibroPeer::getTableMap()->hasColumn($key)){
						$libro->setByName($key,$value, \BasePeer::TYPE_FIELDNAME);
					}
				}

	    		$libro->save();

	    		return $this->redirect()->toUrl("/libro");
	    	}

    	}else{
    		return $this->redirect()->toUrl("/libro");
    	}

    	$autor_array = \AutorQuery::create()->select(array('idautor','autor_nombre'))->find()->toKeyValue('idautor','autor_nombre');

        $editorial_array = \EditorialQuery::create()->select(array('ideditorial','editorial_nombre'))->find()->toKeyValue('ideditorial','editorial_nombre');
        

        $form  = new LibroForm($autor_array,$editorial_array);
        
    	$form->setData($libro->toArray(\BasePeer::TYPE_FIELDNAME));

    	return new ViewModel(array(
    		'libro' =>$libro,
    		'form' => $form,
    	));
    }


    public function eliminarAction(){

    	$id = $this->params()->fromRoute('id');

    	$exist = \LibroQuery::create()->filterByIdlibro($id)->exists();

    	if($exist){
    		$libro = \LibroQuery::create()->findPk($id);

    		$post_request = $this->getRequest();

	    	if($post_request->isPost()){
	    		$libro->delete();


	    		return $this->redirect()->toUrl("/libro");
	    	}

    	}else{
    		return $this->redirect()->toUrl("/libro");
    	}

    	return new ViewModel(array(
    		'libro'=> $libro,
    	));
    }
}

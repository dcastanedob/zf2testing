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
use Application\Form\EditorialForm;

class EditorialController extends AbstractActionController
{
    public function indexAction()
    {
    	$editoriales =  \EditorialQuery::create()->find();

        return new ViewModel(array(
        	'editoriales'=>$editoriales
        ));
    }

    public function nuevoAction(){

        $post_request = $this->getRequest();
        if($post_request->isPost()){
            $post_data = $post_request->getPost();

            $editorial = new \Editorial();
            

            foreach ($post_data as $key => $value) {
                if(\EditorialPeer::getTableMap()->hasColumn($key)){
                    $editorial->setByName($key,$value, \BasePeer::TYPE_FIELDNAME);
                }
            }

            $editorial->save();

            return $this->redirect()->toUrl("/editorial");

            
        }

        $form  = new EditorialForm();


        return new ViewModel(array(
            'form' => $form,
        ));
    }
    

    public function editarAction(){

        $id = $this->params()->fromRoute('id');

        $exist = \EditorialQuery::create()->filterByIdeditorial($id)->exists();

        if($exist){
            $editorial = \EditorialQuery::create()->findPk($id);

            $post_request = $this->getRequest();

            if($post_request->isPost()){
                $post_data = $post_request->getPost();


                foreach ($post_data as $key => $value) {
                    if(\EditorialPeer::getTableMap()->hasColumn($key)){
                        $editorial->setByName($key,$value, \BasePeer::TYPE_FIELDNAME);
                    }
                }

                $editorial->save();

                return $this->redirect()->toUrl("/editorial");
            }

        }else{
            return $this->redirect()->toUrl("/editorial");
        }

        $form  = new EditorialForm();
        $form->setData($editorial->toArray(\BasePeer::TYPE_FIELDNAME));

        return new ViewModel(array(
            'editorial' =>$editorial,
            'form' => $form,
        ));
    }


    public function eliminarAction(){

        $id = $this->params()->fromRoute('id');

        $exist = \EditorialQuery::create()->filterByIdeditorial($id)->exists();

        if($exist){
            $editorial = \EditorialQuery::create()->findPk($id);

            $post_request = $this->getRequest();

            if($post_request->isPost()){
                $editorial->delete();


                return $this->redirect()->toUrl("/editorial");
            }

        }else{
            return $this->redirect()->toUrl("/editorial");
        }

        return new ViewModel(array(
            'editorial'=> $editorial,
        ));
    }
}

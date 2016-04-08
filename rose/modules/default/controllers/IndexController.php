<?php
class IndexController extends Zend_Controller_Action
{
    public function init()
    {
      //Layout
      $this->layout = Zend_Layout::getMvcInstance();
      $this->apply_form_service = new Rose_Service_Form_Application();
    }

    public function indexAction()
    {
        $this->view->title = 'Rose Main Page';
    }

    public function applyAction()
    {
        $form = $this->apply_form_service->generateForm();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                try {
                    $apply = $this->apply_form_service->processForm($form);
                    $this->_redirect('/default/index/submit/?apply='.$apply);
                } catch (Exception $e) {
                    echo '<b>Error</b> Submission failed.';
                }
            }
        }
        $this->view->form = $form;
        $this->view->title = 'Rose Application Submission';

    }
    public function submitAction()
    {
        $this->view->apply = $this->getRequest()->getParam('apply');
    }
}

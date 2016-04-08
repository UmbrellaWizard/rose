<?php

class Rose_Service_Form_Application implements Rose_Interface_FormServiceInterface
{
    public function generateForm($identifier = null)
    {
        $form = new Rose_Form_Application();
        return $form;
    }

    public function processForm($form)
    {
        $return_value = "fail";
        try {
            $form_values = $form->getValues();
            if (file_exists(ROOT_DIR . '/public_html/applications/' . $form_values['name'])) {
                $return_value = $form_values['name'];
            } else {
                $formatter = new Zend_Log_Formatter_Simple('%message%' . PHP_EOL);
                $writer = new Zend_Log_Writer_Stream(ROOT_DIR . '/public_html/applications/' . $form_values['name']);
                $writer->setFormatter($formatter);

                $logger = new Zend_Log();
                $logger->addWriter($writer);
                $logger->info("Name: " . $form_values['name']);
                $logger->info("Race: " . $form_values['race']);
                $logger->info("Gender: " . $form_values['gender']);
                $logger->info("Ability: " . $form_values['ability']);
                $logger->info("Personality: " . $form_values['personality']);
                $logger->info("Description: " . $form_values['description']);
                $logger->info("History: " . $form_values['history']);
                $logger->info("Original Character: " . $form_values['oc']);
                $return_value = "success";
            }
        } catch (Exception $e) {
        }
        return $return_value;
    }
}

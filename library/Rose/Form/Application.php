<?php

class Rose_Form_Application extends Zend_Form
{
    function __construct()
    {
        parent::__construct();

        return $this->buildForm();
    }

    private function buildForm()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name');
        $name->addValidator('StringLength', false, array(3, 80));
        $name->setErrorMessages(array('Your name should be between 3 and 80 characters long'));
        $name->setRequired(true);
        $name->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );
        $race = new Zend_Form_Element_Text('race');
        $race->setLabel('Race');
        $race->addValidator('StringLength', false, array(3, 80));
        $race->setErrorMessages(array('Your race should be between 3 and 80 characters long'));
        $race->setRequired(true);
        $race->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );
        $gender = new Zend_Form_Element_Select('gender');
        $gender->setLabel('Gender');
        $gender->setMultiOptions(array('male'=>'male', 'female'=>'female'));
        $gender->setRequired(true);
        $gender->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );
        $ability = new Zend_Form_Element_Text('ability');
        $ability->setLabel('Ability');
        $ability->addValidator('StringLength', false, array(3, 200));
        $ability->setErrorMessages(array('Your ability should be between 3 and 200 characters long'));
        $ability->setRequired(true);
        $ability->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );
        $personality = new Zend_Form_Element_Text('personality');
        $personality->setLabel('Personality');
        $personality->addValidator('StringLength', false, array(3, 200));
        $personality->setErrorMessages(array('Your personality should be between 3 and 200 characters long'));
        $personality->setRequired(true);
        $personality->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description');
        $description->addValidator('StringLength', false, array(3, 200));
        $description->setErrorMessages(array('Your description should be between 3 and 200 characters long'));
        $description->setRequired(true);
        $description->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );
        $history = new Zend_Form_Element_Text('history');
        $history->setLabel('History');
        $history->addValidator('StringLength', false, array(3, 200));
        $history->setErrorMessages(array('Your history should be between 3 and 200 characters long'));
        $history->setRequired(true);
        $history->setAttribs(
            array(
                'class' => 'form-control',
                'placeholder' => ''
            )
        );

        $oc = new Zend_Form_Element_Checkbox('oc');
        $oc->setLabel('Original Character');
        $oc->setCheckedValue("yes");
        $oc->setunCheckedValue("no");

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submit-button')
               ->setAttrib('class', 'button')
               ->setLabel('APPLY');

        $this->addElements(array($name, $race, $gender, $ability, $personality, $description, $history, $oc, $submit));

        return $this;
    }
}

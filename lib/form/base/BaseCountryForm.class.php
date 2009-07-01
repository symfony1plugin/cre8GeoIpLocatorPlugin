<?php

/**
 * Country form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'iso'            => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
      'printable_name' => new sfWidgetFormInput(),
      'iso3'           => new sfWidgetFormInput(),
      'numcode'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'iso'            => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'iso', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 80)),
      'printable_name' => new sfValidatorString(array('max_length' => 80)),
      'iso3'           => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'numcode'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Country', 'column' => array('name'))),
        new sfValidatorPropelUnique(array('model' => 'Country', 'column' => array('printable_name'))),
      ))
    );

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }


}

<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Country filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(),
      'printable_name' => new sfWidgetFormFilterInput(),
      'iso3'           => new sfWidgetFormFilterInput(),
      'numcode'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'printable_name' => new sfValidatorPass(array('required' => false)),
      'iso3'           => new sfValidatorPass(array('required' => false)),
      'numcode'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getFields()
  {
    return array(
      'iso'            => 'Text',
      'name'           => 'Text',
      'printable_name' => 'Text',
      'iso3'           => 'Text',
      'numcode'        => 'Number',
    );
  }
}

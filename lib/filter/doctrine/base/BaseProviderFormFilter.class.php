<?php

/**
 * Provider filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProviderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'        => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('provider_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Provider';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'code'        => 'Text',
      'description' => 'Text',
    );
  }
}
